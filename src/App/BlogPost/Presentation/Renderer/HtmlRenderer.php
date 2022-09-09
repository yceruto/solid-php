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

namespace Solid\App\BlogPost\Presentation\Renderer;

use Solid\App\BlogPost\Domain\Entity\BlogPost;

class HtmlRenderer implements Renderer
{
    public function render(?BlogPost $blogPost): string
    {
        if (null === $blogPost) {
            return '<h1>Blog Post not found</h1>';
        }

        $date = ($blogPost->getUpdatedAt() ?? $blogPost->getCreatedAt())->format('Y-m-d H:i');

        return <<<HTML
<article>
    <h1>{$blogPost->getTitle()}</h1>
    <p>Author: {$blogPost->getAuthor()} | Date: {$date} | Id: {$blogPost->getId()}</p>
    <p>{$blogPost->getContent()}</p>
</article>
HTML;
    }

    public function contentType(): string
    {
        return 'text/html';
    }
}
