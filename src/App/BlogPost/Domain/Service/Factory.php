<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Domain\Service;

use Solid\App\BlogPost\Domain\Model\BlogPost;

class Factory
{
    public function create(): BlogPost
    {
        $loripsum = explode("\n", file_get_contents('https://loripsum.net/api/1/long/headers'));

        return BlogPost::create(
            id: random_int(1, 1000),
            author: 'John Doe',
            title: strip_tags($loripsum[0]),
            content: strip_tags($loripsum[2]),
        );
    }
}
