<?php

namespace Solid\App\BlogPost\Application\UseCase;

use Solid\App\BlogPost\Domain\Model\Storage;

final class ListBlogPostUseCase
{
    public function __construct(private readonly Storage $storage)
    {
    }

    public function execute(): iterable
    {
        return $this->storage->getAll();
    }
}
