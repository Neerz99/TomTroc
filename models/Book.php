<?php

class Book
{
    private ?int $id = null;
    private int $ownerId;
    private string $title;
    private string $author;
    private ?string $imageUrl = null;
    private ?string $description = null;
    private string $status = 'Disponible';
    private ?string $createdAt = null;

    // Champs enrichis facultatifs
    private ?string $ownerName = null;

    public static function fromArray(array $row): self
    {
        $b = new self();
        $b->id          = isset($row['id']) ? (int)$row['id'] : null;
        $b->ownerId     = (int)($row['ownerId'] ?? $row['owner_id'] ?? 0);
        $b->title       = (string)($row['title'] ?? '');
        $b->author      = (string)($row['author'] ?? '');
        $b->imageUrl    = $row['imageUrl'] ?? $row['image_url'] ?? null;
        $b->description = $row['description'] ?? null;
        $b->status      = $row['status'] ?? 'Disponible';
        $b->createdAt   = $row['created_at'] ?? null;
        $b->ownerName   = $row['ownerName'] ?? null;
        return $b;
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'ownerId'     => $this->ownerId,
            'title'       => $this->title,
            'author'      => $this->author,
            'imageUrl'    => $this->imageUrl,
            'description' => $this->description,
            'status'      => $this->status,
            'created_at'  => $this->createdAt,
            'ownerName'   => $this->ownerName,
        ];
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getOwnerId(): int { return $this->ownerId; }
    public function getTitle(): string { return $this->title; }
    public function getAuthor(): string { return $this->author; }
    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function getDescription(): ?string { return $this->description; }
    public function getStatus(): string { return $this->status; }
    public function getCreatedAt(): ?string { return $this->createdAt; }
    public function getOwnerName(): ?string { return $this->ownerName; }

    // Setters
    public function setOwnerId(int $v): self { $this->ownerId = $v; return $this; }
    public function setTitle(string $v): self { $this->title = $v; return $this; }
    public function setAuthor(string $v): self { $this->author = $v; return $this; }
    public function setImageUrl(?string $v): self { $this->imageUrl = $v; return $this; }
    public function setDescription(?string $v): self { $this->description = $v; return $this; }
    public function setStatus(string $v): self { $this->status = $v; return $this; }
    public function setOwnerName(?string $v): self { $this->ownerName = $v; return $this; }
}
