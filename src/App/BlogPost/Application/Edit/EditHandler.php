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

namespace Solid\App\BlogPost\Application\Edit;

use Solid\App\BlogPost\Domain\Entity\BlogPost;
use Solid\App\BlogPost\Domain\Storage\Storage;

class EditHandler
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function handle(BlogPost $blogPost): void
    {
        $loripsum = explode("\n", file_get_contents('https://loripsum.net/api/1/long/headers'));

        $blogPost->setTitle(strip_tags($loripsum[0]));
        $blogPost->setContent($loripsum[2]);

        $this->storage->save($blogPost);
    }
}
