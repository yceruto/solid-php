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

use Solid\App\BlogPost\Application\Search\SearchHandler;
use Solid\App\BlogPost\Presentation\Http\Response;
use Solid\App\BlogPost\Presentation\Renderer\Renderer;

class ListAction
{
    public function __construct(
        private readonly SearchHandler $searchHandler,
        private readonly Renderer $renderer,
    ) {
    }

    public function __invoke(): Response
    {
        $content = '<h1>List of Blog Posts</h1>';

        foreach ($this->searchHandler->handle() as $blogPost) {
            $content .= $this->renderer->render($blogPost);
        }

        return new Response($content);
    }
}
