<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Application\Modify;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Storage;
use Solid\App\BlogPost\Domain\Service\Factory;

class ModifyUseCase
{
    public function __construct(
        private readonly Factory $factory,
        private readonly Storage $storage,
    ) {
    }

    public function execute(BlogPost $blogPost): void
    {
        $newSample = $this->factory->create();

        $blogPost->changeTitle($newSample->title());
        $blogPost->changeContent($newSample->content());

        $this->storage->flush();
    }
}
