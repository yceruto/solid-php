<?php

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\UseCase\ListBlogPostUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

final class ListAction
{
    public function __construct(
        private readonly ListBlogPostUseCase $useCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(string $format = 'html'): void
    {
        $blogPosts = $this->useCase->execute();

        if ('json' === $format) {
            $count = count($blogPosts);
            header('Content-type: application/json');
            echo '[';
            foreach ($blogPosts as $num => $blogPost) {
                echo $this->renderer->render($blogPost);
                if ($num < $count - 1) {
                    echo ',';
                }
            }
            echo ']';

            return;
        }

        echo '<h1>Blog post list</h1>';
        foreach ($blogPosts as $blogPost) {
            echo $this->renderer->render($blogPost);
        }
    }
}
