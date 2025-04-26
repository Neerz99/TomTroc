<?php

class UserModel extends Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all users (without password).
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT 
                  id, 
                  username, 
                  email, 
                  avatar_url AS avatarUrl, 
                  bio, 
                  created_at AS createdAt 
                FROM {$this->table}
                ORDER BY created_at DESC";
        return $this->getDb()->query($sql)->fetchAll();
    }

    /**
     * Get a user by its ID.
     *
     * @param int $id
     * @return array|false
     */
    public function find(int $id)
    {
        $stmt = $this->getDb()->prepare(
            "SELECT 
               id, 
               username, 
               email, 
               avatar_url AS avatarUrl, 
               bio, 
               created_at AS createdAt 
             FROM {$this->table}
             WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Create a new user.
     * Created_at field is automatically set to NOW().
     *
     * @param array $data  [username, email, password, avatar_url?, bio?]
     * @return bool
     */
    public function create(array $data): bool
    {
        // Hash the password before storing it
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $this->getDb()->prepare(
            "INSERT INTO {$this->table}
               (username, email, password, avatar_url, bio)
             VALUES
               (:u, :e, :p, :a, :b)"
        );

        return $stmt->execute([
            'u' => $data['username'],
            'e' => $data['email'],
            'p' => $hash,
            'a' => $data['avatar_url'] ?? null,
            'b' => $data['bio'] ?? null,
        ]);
    }

    /**
     * Login a user.
     *
     * @param string $email
     * @param string $password
     * @return array|false
     */
    public function login(string $email, string $password)
    {
        $stmt = $this->getDb()->prepare(
            "SELECT id, username, email, password 
             FROM {$this->table} 
             WHERE email = :email"
        );
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // Remove password from the result
            return $user;
        }

        return false;
    }

    /**
     * Delete a user by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $stmt = $this->getDb()->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
