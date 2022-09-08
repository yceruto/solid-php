<?php

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\UseCase\FindBlogPostUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

final class ShowAction
{
    public function __construct(
        private readonly FindBlogPostUseCase $useCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(int $id, string $format = 'html'): void
    {
        $blogPost = $this->useCase->execute($id);

        if ('json' === $format) {
            header('Content-type: application/json');
        } else {
            echo '<h1>Blog post</h1>';
        }

        echo $this->renderer->render($blogPost);
    }
}
