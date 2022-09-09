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

namespace Solid\App\BlogPost\Application\Create;

use Solid\App\BlogPost\Domain\Entity\BlogPost;
use Solid\App\BlogPost\Domain\Storage\Storage;

class CreateHandler
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function handle(): BlogPost
    {
        $loripsum = explode("\n", file_get_contents('https://loripsum.net/api/1/long/headers'));

        $blogPost = new BlogPost(random_int(1, 1000), strip_tags($loripsum[0]), $loripsum[2], 'John Doe');

        $this->storage->save($blogPost);

        return $blogPost;
    }
}
