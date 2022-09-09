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

interface Serializer
{
    public function serialize(BlogPost $blogPost): array;
}
