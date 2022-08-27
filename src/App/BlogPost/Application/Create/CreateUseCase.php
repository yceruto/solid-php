<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Application\Create;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Storage;
use Solid\App\BlogPost\Domain\Service\Factory;

class CreateUseCase
{
    public function __construct(
        private readonly Factory $factory,
        private readonly Storage $storage,
    ) {
    }

    public function execute(): BlogPost
    {
        $blogPost = $this->factory->create();

        $this->storage->persist($blogPost);
        $this->storage->flush();

        return $blogPost;
    }
}
