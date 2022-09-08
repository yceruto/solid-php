<?php

namespace Solid\App\BlogPost\Application\UseCase;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Storage;

final class FindBlogPostUseCase
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function execute(int $id): BlogPost
    {
        return $this->storage->get($id);
    }
}
