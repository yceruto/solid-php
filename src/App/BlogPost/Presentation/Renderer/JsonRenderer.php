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
use Solid\App\BlogPost\Domain\Serializer\Serializer;

class JsonRenderer implements Renderer
{
    public function __construct(private readonly Serializer $serializer)
    {
    }

    public function render(?BlogPost $blogPost): string
    {
        if (null === $blogPost) {
            return json_encode('Blog Post not found');
        }

        return json_encode($this->serializer->serialize($blogPost));
    }

    public function contentType(): string
    {
        return 'application/json';
    }
}
