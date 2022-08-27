<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Domain\Model;

use DateTimeImmutable;

class BlogPost
{
    private DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt = null;

    public static function create(int $id, string $author, string $title, string $content): self
    {
        $self = new self($id, $author, $title, $content);
        $self->createdAt = new DateTimeImmutable();

        return $self;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function changeTitle(string $title): void
    {
        $this->title = $title;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function content(): string
    {
        return $this->content;
    }

    public function changeContent(string $content): void
    {
        $this->content = $content;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    private function __construct(
        private readonly int $id,
        private readonly string $author,
        private string $title,
        private string $content,
    ) {
    }
}
