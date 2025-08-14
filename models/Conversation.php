<?php

class Conversation
{
    private ?int $id = null;
    private int $user1Id;
    private int $user2Id;
    private ?string $startDate = null;

    // facul. pour listes : autre participant
    private ?int $otherId = null;
    private ?string $otherUsername = null;
    private ?string $otherAvatarUrl = null;

    public static function fromArray(array $row): self
    {
        $c = new self();
        $c->id            = isset($row['id']) ? (int)$row['id'] : null;
        $c->user1Id       = (int)($row['user1Id'] ?? $row['user1_id'] ?? 0);
        $c->user2Id       = (int)($row['user2Id'] ?? $row['user2_id'] ?? 0);
        $c->startDate     = $row['startDate'] ?? $row['start_date'] ?? null;
        $c->otherId       = isset($row['otherId']) ? (int)$row['otherId'] : null;
        $c->otherUsername = $row['otherUsername'] ?? null;
        $c->otherAvatarUrl = $row['otherAvatarUrl'] ?? $row['avatarUrl'] ?? null;
        return $c;
    }

    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'user1Id'       => $this->user1Id,
            'user2Id'       => $this->user2Id,
            'startDate'     => $this->startDate,
            'otherId'       => $this->otherId,
            'otherUsername' => $this->otherUsername,
        ];
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUser1Id(): int { return $this->user1Id; }
    public function getUser2Id(): int { return $this->user2Id; }
    public function getStartDate(): ?string { return $this->startDate; }
    public function getOtherId(): ?int { return $this->otherId; }
    public function getOtherUsername(): ?string { return $this->otherUsername; }

    // Setters
    public function setUser1Id(int $v): self { $this->user1Id = $v; return $this; }
    public function setUser2Id(int $v): self { $this->user2Id = $v; return $this; }
    public function setStartDate(?string $v): self { $this->startDate = $v; return $this; }
    public function setOther(int $id, ?string $name): self { $this->otherId = $id; $this->otherUsername = $name; return $this; }
}
