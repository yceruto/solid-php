<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Renderer;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Normalizer;

class JsonRenderer implements Renderer
{
    public function __construct(
        private readonly Normalizer $normalizer,
    ) {
    }

    public function render(BlogPost $blogPost): void
    {
        header('Content-Type: application/json');

        echo json_encode($this->normalizer->normalize($blogPost), JSON_THROW_ON_ERROR);
    }
}
