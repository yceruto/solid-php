<?php

declare(strict_types=1);

/*
 * This file is part of the Second package.
 *
 * © Second <contact@scnd.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Solid\App\BlogPost\Presentation\Controller;

use Solid\App\BlogPost\Application\Edit\EditHandler;
use Solid\App\BlogPost\Application\Find\FindHandler;
use Solid\App\BlogPost\Presentation\Http\Response;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

class EditAction
{
    public function __construct(
        private readonly FindHandler $findHandler,
        private readonly EditHandler $editHandler,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(int $id): Response
    {
        $blogPost = $this->findHandler->handle($id);
        $this->editHandler->handle($blogPost);

        $content = '<h1>Edit Blog Post</h1>';
        $content .= $this->renderer->render($blogPost);

        return new Response($content, $this->renderer->contentType());
    }
}
