<?php

namespace Solid\App\BlogPost\Domain\Model;

interface Storage
{
    public function get(int $id): BlogPost;

    /**
     * @return iterable<int, BlogPost>
     */
    public function getAll(): iterable;

    public function save(BlogPost $blogPost): void;
}
