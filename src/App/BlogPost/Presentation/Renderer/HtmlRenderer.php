<?php

namespace Solid\App\BlogPost\Presentation\Renderer;

use DateTimeImmutable;
use Solid\App\BlogPost\Domain\Model\BlogPost;

final class HtmlRenderer implements Renderer
{
    public function render(BlogPost $blogPost): string
    {
        $placeholders = [
            $blogPost->getId(),
            $blogPost->getAuthor(),
            $blogPost->getTitle(),
            $this->format($blogPost->getCreatedAt()),
            $this->format($blogPost->getUpdatedAt()),
            $blogPost->getContent(),
        ];

        return \vsprintf($this->getTemplate(), $placeholders);
    }

    private function format(?DateTimeImmutable $date): string
    {
        return null === $date ? '' : $date->format('Y-m-d H:i:s');
    }

    private function getTemplate(): string
    {
        return <<<'HTML'
            <article>
                <p>ID %s</p>
                <p>Author %s</p>
                <p>Title %s</p>
                <p>Created %s</p>
                <p>Updated %s</p>
                <div>%s</div>
            </article>
        HTML;
    }
}
