<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Domain\Model;

interface Storage
{
    public function findOne(int $id): ?BlogPost;

    /**
     * @return iterable<BlogPost>
     */
    public function findAll(): iterable;

    public function persist(BlogPost $blogPost): void;

    public function flush(): void;
}
