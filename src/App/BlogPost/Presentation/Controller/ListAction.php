<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\Search\SearchUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

class ListAction
{
    public function __construct(
        private readonly SearchUseCase $searchUseCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(): void
    {
        echo '<h1>List of Blog Posts</h1>';

        $blogPosts = $this->searchUseCase->execute();

        foreach ($blogPosts as $blogPost) {
            $this->renderer->render($blogPost);
        }
    }
}
