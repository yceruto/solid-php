<?php

declare(strict_types=1);

/*
 * This file is part of the Second package.
 *
 * © Second <contact@scnd.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Solid\App\BlogPost\Domain\Entity;

use DateTimeImmutable;

class BlogPost
{
    private readonly DateTimeImmutable $created_at;
    private ?DateTimeImmutable $updated_at = null;

    public function __construct(
        private readonly int $id,
        private string $title,
        private string $content,
        private string $author,
    ) {
        $this->created_at = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
        $this->updateAt();
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
        $this->updateAt();
    }

    private function updateAt(): void
    {
        $this->updated_at = new DateTimeImmutable();
    }
}
