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

namespace Solid\App\BlogPost\Application\Search;

use Solid\App\BlogPost\Domain\Storage\Storage;

class SearchHandler
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function handle(): array
    {
        return $this->storage->findAll();
    }
}