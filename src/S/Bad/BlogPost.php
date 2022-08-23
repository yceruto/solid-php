<?php

declare(strict_types=1);

namespace Solid\S\Bad;

class BlogPost
{
    public function __construct(
        private readonly string $name,
    ) {
    }
}
