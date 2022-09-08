<?php

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\UseCase\NewBlogPostUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

final class NewAction
{
    public function __construct(
        private readonly NewBlogPostUseCase $useCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(int $id, ?string $author, ?string $title, ?string $content, string $format = 'html'): void
    {
        $blogPost = $this->useCase->execute($id, $author, $title, $content);

        if ('json' === $format) {
            header('Content-type: application/json');
        } else {
            echo '<h1>New blog post</h1>';
        }

        echo $this->renderer->render($blogPost);
    }
}
