<?php

class MessageManager extends AbstractManager
{
    private string $table = 'messages';

    /** @return array[] messages avec senderName */
    public function findByConversation(int $convId): array
    {
        $stmt = $this->db->prepare(
            "SELECT m.*, u.username AS senderName, u.avatar_url AS senderAvatar
         FROM {$this->table} m
         LEFT JOIN users u ON u.id = m.senderId
         WHERE m.conversationId = :cid
         ORDER BY m.timestamp ASC"
        );
        $stmt->execute(['cid'=>$convId]);
        $rows = $stmt->fetchAll();
        return array_map(fn($r)=>Message::fromArray($r)->toArray(), $rows);
    }

    public function sendMessage(int $convId, int $sender, int $recipient, string $content): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table}
             (conversationId, senderId, recipientId, content, timestamp, isRead)
             VALUES (:c, :s, :r, :t, NOW(), 0)"
        );
        return $stmt->execute([
            'c' => $convId,
            's' => $sender,
            'r' => $recipient,
            't' => $content
        ]);
    }

    public function markAsRead(int $convId, int $userId): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table}
             SET isRead = 1
             WHERE conversationId = :cid AND recipientId = :uid"
        );
        return $stmt->execute(['cid'=>$convId, 'uid'=>$userId]);
    }
}
