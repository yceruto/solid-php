<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\Create\CreateUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

class NewAction
{
    public function __construct(
        private readonly CreateUseCase $createUseCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(): void
    {
        echo '<h1>New Blog Post</h1>';

        $blogPost = $this->createUseCase->execute();

        $this->renderer->render($blogPost);
    }
}
