<?php

class BookManager extends AbstractManager
{
    private string $table = 'books';

    private function mapRow(array $row): array
    {
        return Book::fromArray($row)->toArray();
    }

    /** @return array[] */
    public function findAll(): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $rows = $this->db->query($sql)->fetchAll();
        return array_map([$this, 'mapRow'], $rows);
    }

    /** @return array[] */
    public function findAllWithOwners(): array
    {
        $sql = "SELECT b.*, u.username AS ownerName
                FROM {$this->table} b
                LEFT JOIN users u ON u.id = b.ownerId
                ORDER BY b.created_at DESC";
        $rows = $this->db->query($sql)->fetchAll();
        return array_map([$this, 'mapRow'], $rows);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? $this->mapRow($row) : null;
    }

    /** @return array[] */
    public function getUserBooks(int $userId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE ownerId = :uid ORDER BY created_at DESC"
        );
        $stmt->execute(['uid' => $userId]);
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRow'], $rows);
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table}
               (ownerId, title, author, imageUrl, description, status)
             VALUES (:o, :t, :a, :i, :d, :s)"
        );
        $stmt->execute([
            'o' => (int)$data['ownerId'],
            't' => $data['title'],
            'a' => $data['author'],
            'i' => $data['imageUrl'] ?? null,
            'd' => $data['description'] ?? null,
            's' => $data['status'] ?? 'Disponible',
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];
        $params = ['id' => $id];
        foreach (['title','author','description','status','imageUrl'] as $k) {
            if (array_key_exists($k, $data)) {
                $fields[] = "$k = :$k";
                $params[$k] = $data[$k];
            }
        }
        if (!$fields) return true;
        $sql = "UPDATE {$this->table} SET ".implode(', ', $fields)." WHERE id = :id";
        return $this->db->prepare($sql)->execute($params);
    }

    public function delete(int $id): bool
    {
        return $this->db
            ->prepare("DELETE FROM {$this->table} WHERE id = :id")
            ->execute(['id' => $id]);
    }

    /** @return array[] */
    public function search(string $q): array
    {
        $stmt = $this->db->prepare(
            "SELECT b.*, u.username AS ownerName
             FROM {$this->table} b
             LEFT JOIN users u ON u.id = b.ownerId
             WHERE b.title LIKE :q OR b.author LIKE :q
             ORDER BY b.created_at DESC"
        );
        $stmt->execute(['q' => "%$q%"]);
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRow'], $rows);
    }

    /** @return array[] */
    public function findLatest(int $limit = 4): array
    {
        $stmt = $this->db->prepare(
            "SELECT b.*, u.username AS ownerName
             FROM {$this->table} b
             LEFT JOIN users u ON u.id = b.ownerId
             ORDER BY b.created_at DESC
             LIMIT :lim"
        );
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRow'], $rows);
    }
}
