<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Infrastructure\Normalizer;

use DateTimeImmutable;
use ReflectionClass;
use ReflectionException;
use Solid\App\BlogPost\Domain\Model\BlogPost;
use Solid\App\BlogPost\Domain\Model\Normalizer;

class ReflectionNormalizer implements Normalizer
{
    public function normalize(BlogPost $blogPost): array
    {
        return [
            'id' => $blogPost->id(),
            'author' => $blogPost->author(),
            'title' => $blogPost->title(),
            'content' => $blogPost->content(),
            'created_at' => $blogPost->createdAt()->format('c'),
            'updated_at' => $blogPost->updatedAt()?->format('c'),
        ];
    }

    public function denormalize(array $data): BlogPost
    {
        $blogPost = BlogPost::create(
            $data['id'],
            $data['author'],
            $data['title'],
            $data['content'],
        );

        $reflectionClass = new ReflectionClass($blogPost);
        $this->setPropertyValue($reflectionClass, $blogPost, 'createdAt', new DateTimeImmutable($data['created_at']));
        $this->setPropertyValue($reflectionClass, $blogPost, 'updatedAt', $data['updated_at'] ? new DateTimeImmutable($data['updated_at']) : null);

        return $blogPost;
    }

    private function setPropertyValue(ReflectionClass $reflectionClass, BlogPost $blogPost, string $property, $value): void
    {
        try {
            $reflectionProperty = $reflectionClass->getProperty($property);
        } catch (ReflectionException) {
            return;
        }
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($blogPost, $value);
    }
}
