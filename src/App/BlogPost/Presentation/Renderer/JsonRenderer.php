<?php

namespace Solid\App\BlogPost\Presentation\Renderer;

use JsonException;
use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Normalizer;

final class JsonRenderer implements Renderer
{
    public function __construct(private readonly Normalizer $normalizer)
    {
    }

    /**
     * @throws JsonException
     */
    public function render(BlogPost $blogPost): string
    {
        return json_encode($this->normalizer->normalize($blogPost), JSON_THROW_ON_ERROR);
    }
}
