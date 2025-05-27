<?php

class BooksModel extends Model
{
    protected $table = 'books';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all books
     *
     * @return array
     */
    public function findAll(): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->getDb()->query($sql)->fetchAll();
    }

    /**
     * Get a book by its ID
     *
     * @param int $id
     * @return array|false
     */
    public function find(int $id)
    {
        $stmt = $this->getDb()->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get all books of a user
     *
     * @param int $userId
     * @return array
     */
    public function getUserBooks(int $userId): array
    {
        $stmt = $this->getDb()->prepare(
            "SELECT * FROM {$this->table} WHERE ownerId = :ownerId ORDER BY created_at DESC"
        );
        $stmt->execute(['ownerId' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get all books of a user with their owner's name
     *
     * @return array
     */
    public function findAllWithOwners(): array
    {
        $sql = "
          SELECT
            b.*, 
            u.username AS ownerName
          FROM {$this->table} b
          LEFT JOIN users u ON b.ownerId = u.id
          ORDER BY b.created_at DESC
        ";
        return $this->getDb()->query($sql)->fetchAll();
    }

    /**
     * Create a new book
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $stmt = $this->getDb()->prepare(
            "INSERT INTO {$this->table}
             (ownerId, title, author, imageUrl, description, status)
             VALUES (:o, :t, :a, :i, :d, :s)"
        );
        return $stmt->execute([
            'o' => $data['ownerId'],
            't' => $data['title'],
            'a' => $data['author'],
            'i' => $data['imageUrl'] ?? null,
            'd' => $data['description'] ?? null,
            's' => $data['status'] ?? 'Disponible',
        ]);
    }

    /**
     * Search for books by title or author
     *
     * @param string $search
     * @return array
     */
    public function search(string $search): array
    {
        $sql = "
        SELECT
            b.*,
            u.username AS ownerName
        FROM {$this->table} AS b
        LEFT JOIN users u ON b.ownerId = u.id
        WHERE b.title  LIKE :term
           OR b.author LIKE :term
        ORDER BY b.created_at DESC
    ";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([
            'term' => '%' . $search . '%'
        ]);

        return $stmt->fetchAll();
    }

    /**
     * Delete a book by its ID
     */
    public function delete(int $id): bool
    {
        $stmt = $this->getDb()->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Update a book
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        $fields = [
            'title       = :title',
            'author      = :author',
            'description = :description',
            'status      = :status',
            'imageUrl    = :imageUrl'
        ];

        $params = [
            'title'       => $data['title'],
            'author'      => $data['author'],
            'description' => $data['description'],
            'status'      => $data['status'],
            'imageUrl'    => $data['imageUrl'],
            'id'          => $data['id'],
        ];

        $sql = "UPDATE {$this->table}
            SET " . implode(', ', $fields) . "
            WHERE id = :id";

        $stmt = $this->getDb()->prepare($sql);
        return $stmt->execute($params);
    }

}
