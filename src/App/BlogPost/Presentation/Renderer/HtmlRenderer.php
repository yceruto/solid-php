<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Renderer;

use Solid\App\BlogPost\Domain\Model\BlogPost;

class HtmlRenderer implements Renderer
{
    public function render(BlogPost $blogPost): void
    {
        $date = $blogPost->updatedAt()
            ? $blogPost->updatedAt()->format('Y-m-d H:i')
            : $blogPost->createdAt()->format('Y-m-d H:i');

        echo <<<HTML
<article>
    <h1>{$blogPost->title()}</h1>
    <p>Author: {$blogPost->author()} | Date: {$date} | Id: {$blogPost->id()}</p>
    <p>{$blogPost->content()}</p>
</article>
HTML;
    }
}
