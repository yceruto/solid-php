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

namespace Solid\App\BlogPost\Domain\Storage;

use Solid\App\BlogPost\Domain\Entity\BlogPost;

interface Storage
{
    public function find(int $id): ?BlogPost;

    public function findAll(): array;

    public function save(BlogPost $blogPost): void;
}
