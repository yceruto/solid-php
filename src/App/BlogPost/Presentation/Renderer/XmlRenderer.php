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

use SimpleXMLElement;
use Solid\App\BlogPost\Domain\Entity\BlogPost;
use Solid\App\BlogPost\Domain\Serializer\Serializer;

class XmlRenderer implements Renderer
{
    public function __construct(private readonly Serializer $serializer)
    {
    }

    public function render(?BlogPost $blogPost): string
    {
        if (null === $blogPost) {
            return '<message>Blog Post not found</message>';
        }

        $xml = new SimpleXMLElement('<blog-post/>');
        foreach ($this->serializer->serialize($blogPost) as $key => $value) {
            $xml->addChild($key, (string) $value);
        }

        return $xml->asXML();
    }

    public function contentType(): string
    {
        return 'text/xml';
    }
}
