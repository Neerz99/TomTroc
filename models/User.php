<?php

class User
{
    private ?int $id = null;
    private string $username;
    private string $email;
    private ?string $passwordHash = null;
    private ?string $avatarUrl = null;
    private ?string $bio = null;
    private ?string $createdAt = null;

    public static function fromArray(array $row): self
    {
        $u = new self();
        $u->id           = isset($row['id']) ? (int)$row['id'] : null;
        $u->username     = (string)($row['username'] ?? '');
        $u->email        = (string)($row['email'] ?? '');
        $u->passwordHash = $row['password'] ?? $row['passwordHash'] ?? null;
        $u->avatarUrl    = $row['avatar_url'] ?? $row['avatarUrl'] ?? null;
        $u->bio          = $row['bio'] ?? null;
        $u->createdAt    = $row['created_at'] ?? $row['createdAt'] ?? null;
        return $u;
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'username'  => $this->username,
            'email'     => $this->email,
            'avatarUrl' => $this->avatarUrl,
            'bio'       => $this->bio,
            'createdAt' => $this->createdAt,
        ];
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getAvatarUrl(): ?string { return $this->avatarUrl; }
    public function getBio(): ?string { return $this->bio; }
    public function getCreatedAt(): ?string { return $this->createdAt; }
    public function getPasswordHash(): ?string { return $this->passwordHash; }

    // Setters
    public function setUsername(string $v): self { $this->username = $v; return $this; }
    public function setEmail(string $v): self { $this->email = strtolower(trim($v)); return $this; }
    public function setAvatarUrl(?string $v): self { $this->avatarUrl = $v; return $this; }
    public function setBio(?string $v): self { $this->bio = $v; return $this; }
    public function setPasswordHash(?string $v): self { $this->passwordHash = $v; return $this; }
}
