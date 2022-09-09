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

use Solid\App\BlogPost\Application\Find\FindHandler;
use Solid\App\BlogPost\Presentation\Http\Response;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

class ShowAction
{
    public function __construct(
        private readonly FindHandler $findHandler,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(int $id): Response
    {
        $blogPost = $this->findHandler->handle($id);

        return new Response($this->renderer->render($blogPost), $this->renderer->contentType());
    }
}
