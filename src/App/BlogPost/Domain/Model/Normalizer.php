<?php

namespace Solid\App\BlogPost\Domain\Model;

use DateTimeImmutable;

interface Normalizer
{
    /**
     * @return array{id: int, title: string, content: string, author: string, createdAt: DateTimeImmutable, updatedAt: ?DateTimeImmutable}
     */
    public function normalize(BlogPost $blogPost): array;

    /**
     * @param array{id: int, title: string, content: string, author: string, createdAt: DateTimeImmutable, updatedAt: ?DateTimeImmutable} $data
     */
    public function denormalize(array $data): BlogPost;
}
