<?php

class MessageModel extends Model
{
    protected $table = 'messages';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Send a message in a conversation.
     */
    public function sendMessage(int $convId, int $senderId, int $recipientId, string $content): bool
    {
        $stmt = $this->getDb()->prepare(
            "INSERT INTO {$this->table}
             (conversationId, senderId, recipientId, content)
             VALUES (:c,:s,:r,:m)"
        );
        return $stmt->execute([
            'c' => $convId,
            's' => $senderId,
            'r' => $recipientId,
            'm' => $content
        ]);
    }

    /**
     * Get all messages of a conversation.
     */
    public function findByConversation(int $convId): array
    {
        $sql = "
          SELECT
            m.*,
            u.username AS senderName
          FROM {$this->table} m
          JOIN users u ON u.id = m.senderId
          WHERE m.conversationId = :c
          ORDER BY m.timestamp ASC
        ";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(['c' => $convId]);
        return $stmt->fetchAll();
    }
}
