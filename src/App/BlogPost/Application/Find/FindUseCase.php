<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Application\Find;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\BlogPostNotFound;
use Solid\App\BlogPost\Domain\Model\Storage;

class FindUseCase
{
    public function __construct(
        private readonly Storage $storage,
    ) {
    }

    public function execute(int $id): BlogPost
    {
        $blogPost = $this->storage->findOne($id);

        if (null === $blogPost) {
            throw BlogPostNotFound::create();
        }

        return $blogPost;
    }
}
