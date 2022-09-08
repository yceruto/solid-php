<?php

namespace Solid\App\BlogPost\Presentation\Renderer;

use Solid\App\BlogPost\Domain\Model\BlogPost;

interface Renderer
{
    public function render(BlogPost $blogPost): string;
}
