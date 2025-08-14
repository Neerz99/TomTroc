<?php

class ConversationManager extends AbstractManager
{
    private string $table = 'conversations';

    /** @return array[]  (id, otherId, otherUsername) */
// ...
    public function conversationByUser(int $uid): array
    {
        $sql = "
      SELECT c.id,
             CASE WHEN c.user1Id = :uid THEN c.user2Id ELSE c.user1Id END AS otherId,
             u.username AS otherUsername,
             u.avatar_url AS otherAvatarUrl
      FROM {$this->table} c
      JOIN users u
        ON u.id = CASE WHEN c.user1Id = :uid THEN c.user2Id ELSE c.user1Id END
      WHERE c.user1Id = :uid OR c.user2Id = :uid
      ORDER BY c.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['uid'=>$uid]);
        $rows = $stmt->fetchAll();
        return array_map(fn($r) => Conversation::fromArray($r)->toArray(), $rows);
    }


    /** Données brutes d'une conversation */
    public function conversationData(int $convId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id'=>$convId]);
        $row = $stmt->fetch();
        return $row ? Conversation::fromArray($row)->toArray() : null;
    }

    /** Retourne l'ID de la conversation existante ou nouvellement créée */
    public function startConversation(int $user1, int $user2): int
    {
        // Cherche une conv existante dans les deux sens
        $stmt = $this->db->prepare(
            "SELECT id FROM {$this->table}
             WHERE (user1Id = :a AND user2Id = :b) OR (user1Id = :b AND user2Id = :a)
             LIMIT 1"
        );
        $stmt->execute(['a'=>$user1, 'b'=>$user2]);
        $id = $stmt->fetchColumn();
        if ($id) return (int)$id;

        // Sinon crée
        $ins = $this->db->prepare(
            "INSERT INTO {$this->table} (user1Id, user2Id, startDate)
             VALUES (:a, :b, NOW())"
        );
        $ins->execute(['a'=>$user1, 'b'=>$user2]);
        return (int)$this->db->lastInsertId();
    }
}
