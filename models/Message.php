<?php

class Message
{
    private ?int $id = null;
    private int $conversationId;
    private int $senderId;
    private ?string $senderAvatar = null;
    private int $recipientId;
    private string $content;
    private ?string $timestamp = null;
    private int $isRead = 0;

    // facultatif pour affichage
    private ?string $senderName = null;

    public static function fromArray(array $row): self
    {
        $m = new self();
        $m->id             = isset($row['id']) ? (int)$row['id'] : null;
        $m->conversationId = (int)($row['conversationId'] ?? 0);
        $m->senderId       = (int)($row['senderId'] ?? 0);
        $m->senderAvatar = $row['senderAvatar'] ?? null;
        $m->recipientId    = (int)($row['recipientId'] ?? 0);
        $m->content        = (string)($row['content'] ?? '');
        $m->timestamp      = $row['timestamp'] ?? null;
        $m->isRead         = (int)($row['isRead'] ?? 0);
        $m->senderName     = $row['senderName'] ?? null;
        return $m;
    }

    public function toArray(): array
    {
        return [
            'id'             => $this->id,
            'conversationId' => $this->conversationId,
            'senderId'       => $this->senderId,
            'senderAvatar'      => $this->senderAvatar,
            'recipientId'    => $this->recipientId,
            'content'        => $this->content,
            'timestamp'      => $this->timestamp,
            'isRead'         => $this->isRead,
            'senderName'     => $this->senderName,
        ];
    }
}
