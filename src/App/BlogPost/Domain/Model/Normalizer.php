<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Domain\Model;

interface Normalizer
{
    public function normalize(BlogPost $blogPost): array;

    public function denormalize(array $data): BlogPost;
}
