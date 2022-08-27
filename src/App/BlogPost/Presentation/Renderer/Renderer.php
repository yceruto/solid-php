<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Renderer;

use Solid\App\BlogPost\Domain\Model\BlogPost;

interface Renderer
{
    public function render(BlogPost $blogPost): void;
}
