<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\Find\FindUseCase;
use Solid\App\BlogPost\Presentation\Renderer\FormatRenderer;

class ShowAction
{
    public function __construct(
        private readonly FindUseCase $findUseCase,
        private readonly FormatRenderer $renderer,
    ) {
    }

    public function __invoke(int $id, string $format): void
    {
        $blogPost = $this->findUseCase->execute($id);

        $this->renderer->render($blogPost, $format);
    }
}
