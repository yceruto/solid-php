<?php

namespace Solid\App\BlogPost\Domain\Model;

use DateTimeImmutable;

final class BlogPost
{
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt = null;

    public function __construct(
        private int $id,
        private string $author,
        private string $title,
        private string $content,
    ) {
        $this->createdAt = new DateTimeImmutable();
    }

    public function update(
        ?string $author = null,
        ?string $title = null,
        ?string $content = null,
    ): void {
        $this->author = $author ?? $this->author;
        $this->title = $title ?? $this->title;
        $this->content = $content ?? $this->content;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}

