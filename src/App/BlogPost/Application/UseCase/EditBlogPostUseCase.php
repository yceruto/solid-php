<?php

namespace Solid\App\BlogPost\Application\UseCase;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Storage;

final class EditBlogPostUseCase
{
    public function __construct(
        private readonly Storage $storage,
        private readonly RandomWords $rand = new RandomWords(),
    ) {
    }

    public function execute(int $id, ?string $author, ?string $title, ?string $content): BlogPost
    {
        $blogPost = $this->storage->get($id);
        $blogPost->update(
            $author ?? $this->rand->get('s'),
            $title ?? $this->rand->get('m'),
            $content ?? $this->rand->get('l')
        );
        $this->storage->save($blogPost);

        return $blogPost;
    }

}
