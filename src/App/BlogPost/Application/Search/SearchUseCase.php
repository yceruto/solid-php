<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Application\Search;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Storage;

class SearchUseCase
{
    public function __construct(
        private readonly Storage $storage,
    ) {
    }

    /**
     * @return iterable<BlogPost>
     */
    public function execute(): iterable
    {
        return $this->storage->findAll();
    }
}
