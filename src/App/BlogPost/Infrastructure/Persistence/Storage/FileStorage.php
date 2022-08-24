<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Infrastructure\Persistence\Storage;

use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Normalizer;
use Solid\App\BlogPost\Domain\Model\Storage;

class FileStorage implements Storage
{
    /**
     * @var array<int, BlogPost>
     */
    private array $collection;
    private string $filename;

    public function __construct(
        private readonly Normalizer $normalizer,
        private readonly string $targetDir,
    ) {
        $this->filename = $this->targetDir.'/blog_post.dat';
        $this->load();
    }

    public function findOne(int $id): ?BlogPost
    {
        return $this->collection[$id] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): iterable
    {
        return array_values($this->collection);
    }

    public function persist(BlogPost $blogPost): void
    {
        $this->collection[$blogPost->id()] = $blogPost;
    }

    public function flush(): void
    {
        $dataCollection = [];
        foreach ($this->collection as $id => $blogPost) {
            $dataCollection[$id] = $this->normalizer->normalize($blogPost);
        }

        file_put_contents($this->filename, serialize($dataCollection));
    }

    private function load(): void
    {
        $this->collection = [];

        if (!file_exists($this->filename)) {
            return;
        }

        $content = file_get_contents($this->filename);

        if ('' === $content) {
            return;
        }

        $dataCollection = unserialize($content, ['allowed_class' => false]);

        foreach ($dataCollection as $id => $data) {
            $this->collection[$id] = $this->normalizer->denormalize($data);
        }
    }
}
