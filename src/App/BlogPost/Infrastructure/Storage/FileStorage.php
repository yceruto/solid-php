<?php

declare(strict_types=1);

/*
 * This file is part of the Second package.
 *
 * © Second <contact@scnd.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Solid\App\BlogPost\Infrastructure\Storage;

use Solid\App\BlogPost\Domain\Entity\BlogPost;
use Solid\App\BlogPost\Domain\Serializer\Serializer;
use Solid\App\BlogPost\Domain\Storage\Storage;
use Solid\App\BlogPost\Infrastructure\Hydration\Hydrator;

class FileStorage implements Storage
{
    private ?array $collection = null;

    public function __construct(
        private readonly string $filename,
        private readonly Hydrator $hydrator,
        private readonly Serializer $serializer,
    ) {
    }

    public function findAll(): array
    {
        $this->load();

        return array_values($this->collection);
    }

    public function find(int $id): ?BlogPost
    {
        $this->load();

        return $this->collection[$id] ?? null;
    }

    public function save(BlogPost $blogPost): void
    {
        $this->load();

        $this->collection[$blogPost->getId()] = $blogPost;

        $data = [];
        foreach ($this->collection as $id => $blogPost) {
            $data[$id] = $this->serializer->serialize($blogPost);
        }

        file_put_contents($this->filename, serialize($data));
    }

    private function load(): void
    {
        if (null !== $this->collection) {
            return;
        }

        if (!file_exists($this->filename)) {
            throw new \RuntimeException('Invalid database file');
        }

        $this->collection = [];

        $content = file_get_contents($this->filename);
        if ('' === $content) {
            return;
        }

        foreach (unserialize($content, ['allowed_class' => false]) as $id => $data) {
            $this->collection[$id] = $this->hydrator->hydrate(BlogPost::class, $data);
        }
    }
}
