<?php

class ConversationModel extends Model
{
    protected $table = 'conversations';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Start a conversation between two users.
     */
    public function startConversation(int $u1, int $u2): int
    {
        // Check if the conversation already exists
        $sql = "SELECT id FROM {$this->table}
                WHERE (user1Id = :u1 AND user2Id = :u2)
                   OR (user1Id = :u2 AND user2Id = :u1)";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(['u1' => $u1, 'u2' => $u2]);
        $row = $stmt->fetch();
        if ($row) {
            return (int)$row['id'];
        }

        // Otherwise, create a new conversation
        $stmt = $this->getDb()->prepare(
            "INSERT INTO {$this->table} (user1Id, user2Id) VALUES (:u1,:u2)"
        );
        $stmt->execute(['u1' => $u1, 'u2' => $u2]);
        return (int)$this->getDb()->lastInsertId();
    }

    /**
     * List all conversations for a user.
     */
    public function conversationByUser(int $userId): array
    {
        $sql = "
          SELECT 
            c.id,
            c.startDate,
            CASE
              WHEN c.user1Id = :u THEN u2.username
              ELSE u1.username
            END AS otherUsername
          FROM {$this->table} c
          JOIN users u1 ON u1.id = c.user1Id
          JOIN users u2 ON u2.id = c.user2Id
          WHERE c.user1Id = :u OR c.user2Id = :u
          ORDER BY c.startDate DESC
        ";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(['u' => $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Get data of a conversation.
     */
    public function conversationData(int $id)
    {
        $stmt = $this->getDb()->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
