<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Domain\Model;

use RuntimeException;

final class BlogPostNotFound extends RuntimeException
{
    public static function create(string $message = 'Blog post not found.'): self
    {
        return new self($message);
    }
}
