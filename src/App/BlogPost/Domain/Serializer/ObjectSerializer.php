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

namespace Solid\App\BlogPost\Domain\Serializer;

use Solid\App\BlogPost\Domain\Entity\BlogPost;

class ObjectSerializer implements Serializer
{
    public function serialize(BlogPost $blogPost): array
    {
        return [
            'id' => $blogPost->getId(),
            'author' => $blogPost->getAuthor(),
            'title' => $blogPost->getTitle(),
            'content' => $blogPost->getContent(),
            'created_at' => $blogPost->getCreatedAt()->format('c'),
            'updated_at' => $blogPost->getUpdatedAt()?->format('c'),
        ];
    }
}
