<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Renderer;

use Solid\App\BlogPost\Domain\Model\BlogPost;

class FormatRenderer implements Renderer
{
    /**
     * @param array<string, Renderer> $renderers
     */
    public function __construct(private readonly array $renderers)
    {
    }

    public function render(BlogPost $blogPost, string $format = 'html'): void
    {
        $renderer = $this->renderers[$format] ?? null;

        if (null === $renderer) {
            throw UnsupportedRendererFormat::create('Unsupported format.', $format);
        }

        $renderer->render($blogPost);
    }
}
