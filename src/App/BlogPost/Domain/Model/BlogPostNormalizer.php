<?php

namespace Solid\App\BlogPost\Domain\Model;

use DateTimeImmutable;

final class BlogPostNormalizer implements Normalizer
{
    public function normalize(BlogPost $blogPost): array
    {
        return [
            'id' => $blogPost->getId(),
            'author' => $blogPost->getAuthor(),
            'title' => $blogPost->getTitle(),
            'content' => $blogPost->getContent(),
            'created_at' => $blogPost->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $blogPost->getUpdatedAt()?->format('Y-m-d H:i:s'),
        ];
    }

    public function denormalize(array $data): BlogPost
    {
        $blogPost = new BlogPost($data['id'], $data['author'], $data['title'], $data['content']);
        $this->setTimestampProperties($blogPost, $data['created_at'], $data['updated_at']);

        return $blogPost;
    }

    private function setTimestampProperties(BlogPost $blogPost, string $created, ?string $updated): void
    {
        $createdAt = new \ReflectionProperty($blogPost, 'createdAt');
        $createdAt->setAccessible(true);
        $createdAt->setValue($blogPost, new DateTimeImmutable($created));
        if (null !== $updated) {
            $updatedAt = new \ReflectionProperty($blogPost, 'updatedAt');
            $updatedAt->setAccessible(true);
            $updatedAt->setValue($blogPost, new DateTimeImmutable($updated));
        }
    }
}
