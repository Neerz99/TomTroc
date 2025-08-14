<?php

class UserManager extends AbstractManager
{
    private string $table = 'users';

    private function mapRow(array $row): array
    {
        return User::fromArray($row)->toArray();
    }

    /** @return array[] */
    public function findAll(): array
    {
        $rows = $this->db->query(
            "SELECT id, username, email, avatar_url AS avatarUrl, bio, created_at AS createdAt
             FROM {$this->table}
             ORDER BY created_at DESC"
        )->fetchAll();
        return array_map([$this, 'mapRow'], $rows);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT id, username, email, avatar_url AS avatarUrl, bio, created_at AS createdAt
             FROM {$this->table} WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? $this->mapRow($row) : null;
    }

    public function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT 1 FROM {$this->table} WHERE email = :e LIMIT 1");
        $stmt->execute(['e' => strtolower(trim($email))]);
        return (bool)$stmt->fetchColumn();
    }

    public function create(array $data): bool
    {
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table}
               (username, email, password, avatar_url, bio)
             VALUES (:u, :e, :p, :a, :b)"
        );
        return $stmt->execute([
            'u' => $data['username'],
            'e' => strtolower(trim($data['email'])),
            'p' => $hash,
            'a' => $data['avatar_url'] ?? null,
            'b' => $data['bio'] ?? null,
        ]);
    }

    /** Retourne tableau (id, username, email) pour compat contrôleurs */
    public function login(string $email, string $password)
    {
        $stmt = $this->db->prepare(
            "SELECT id, username, email, password
             FROM {$this->table}
             WHERE email = :e"
        );
        $stmt->execute(['e' => strtolower(trim($email))]);
        $row = $stmt->fetch();

        if ($row && password_verify($password, $row['password'])) {
            if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
                $new = password_hash($password, PASSWORD_DEFAULT);
                $this->db->prepare("UPDATE {$this->table} SET password=:p WHERE id=:id")
                    ->execute(['p'=>$new, 'id'=>$row['id']]);
            }
            unset($row['password']);
            return $row;
        }
        return false;
    }

    public function update(array $data): bool
    {
        $fields = [
            'username = :username',
            'email = :email',
            'bio = :bio',
            'avatar_url = :avatar',
        ];
        $params = [
            'username' => $data['username'],
            'email'    => strtolower(trim($data['email'])),
            'bio'      => $data['bio'],
            'avatar'   => $data['avatar_url'],
            'id'       => $data['id'],
        ];

        if (!empty($data['password'])) {
            $fields[] = 'password = :password';
            $params['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $sql = "UPDATE {$this->table} SET ".implode(', ', $fields)." WHERE id = :id";
        return $this->db->prepare($sql)->execute($params);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM {$this->table} WHERE id = :id")
            ->execute(['id' => $id]);
    }
}
