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
     * Create a new book
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
            's' => $data['status'] ?? 'Available'
        ]);
    }
}
