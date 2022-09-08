<?php

namespace Solid\App\BlogPost\Infrastructure\Persistence;

use DateTimeImmutable;
use InvalidArgumentException;
use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Normalizer;
use Solid\App\BlogPost\Domain\Model\Storage;

class FileStorage implements Storage
{
    /**
     * @var array<int, array{id: int, title: string, content: string, author: string, createdAt: DateTimeImmutable, updatedAt: ?DateTimeImmutable}>
     */
    private array $collection = [];

    public function __construct(
        private readonly Normalizer $normalizer,
        private readonly string $filePath,
    ) {
        if (!is_readable($filePath)) {
            throw new InvalidArgumentException('Cannot read file '.$filePath);
        }
        $content = file_get_contents($filePath);
        if (empty($content)) {
            $content = serialize([]);
        }
        $this->collection = unserialize($content, ['allowed_classes' => false]);
    }

    public function get(int $id): BlogPost
    {
        foreach ($this->collection as $item) {
            if ($id === $item['id']) {
                return $this->normalizer->denormalize($item);
            }
        }
        throw new InvalidArgumentException('Cannot find blog post with id: '.$id);
    }

    public function getAll(): iterable
    {
        return array_map([$this->normalizer, 'denormalize'], $this->collection);
    }

    public function save(BlogPost $blogPost): void
    {
        $found = false;
        foreach ($this->collection as $key => $item) {
            if ($blogPost->getId() === $item['id']) {
                $this->collection[$key] = $this->normalizer->normalize($blogPost);
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->collection[] = $this->normalizer->normalize($blogPost);
        }
        file_put_contents($this->filePath, serialize($this->collection));
    }
}
