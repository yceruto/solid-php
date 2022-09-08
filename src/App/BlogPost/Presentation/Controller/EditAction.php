<?php

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\UseCase\EditBlogPostUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

final class EditAction
{
    public function __construct(
        private readonly EditBlogPostUseCase $useCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(int $id, ?string $author, ?string $title, ?string $content, string $format = 'html'): void
    {
        $blogPost = $this->useCase->execute($id, $author, $title, $content);

        if ('json' === $format) {
            header('Content-type: application/json');
        } else {
            echo '<h1>Blog post</h1>';
        }

        echo $this->renderer->render($blogPost);
    }
}
