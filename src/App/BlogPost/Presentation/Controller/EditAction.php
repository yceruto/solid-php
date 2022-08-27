<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\Find\FindUseCase;
use Solid\App\BlogPost\Application\Modify\ModifyUseCase;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

class EditAction
{
    public function __construct(
        private readonly FindUseCase $findUseCase,
        private readonly ModifyUseCase $modifyUseCase,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(int $id): void
    {
        echo '<h1>Edit Blog Post</h1>';

        $blogPost = $this->findUseCase->execute($id);
        $this->modifyUseCase->execute($blogPost);

        $this->renderer->render($blogPost);
    }
}
