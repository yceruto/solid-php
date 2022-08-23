<?php

declare(strict_types=1);

namespace Solid\Legacy;

use DateTime;

class BlogPost
{
    /**
     * @var array<int, BlogPost>
     */
    private static array $collection;

    private int $id;
    private string $author;
    private string $title;
    private string $content;
    private DateTime $createdAt;
    private ?DateTime $updatedAt = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->createdAt->format('c'),
            'updated_at' => $this->updatedAt?->format('c'),
        ];
    }

    public function fromArray(array $data): void
    {
        $this->id = $data['id'];
        $this->author = $data['author'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->createdAt = new DateTime($data['created_at']);
        $this->updatedAt = $data['updated_at'] ? new DateTime($data['updated_at']) : null;
    }

    public static function persist(BlogPost $blogPost): void
    {
        if (!isset(self::$collection)) {
            self::load();
        }

        self::$collection[$blogPost->getId()] = $blogPost;
    }

    public static function find(int $id): ?BlogPost
    {
        if (!isset(self::$collection)) {
            self::load();
        }

        return self::$collection[$id] ?? null;
    }

    public static function save(): void
    {
        $filename = __DIR__.'/../../var/data/blog_post.dat';

        $dataCollection = [];
        foreach (self::$collection as $id => $blogPost) {
            $dataCollection[$id] = $blogPost->toArray();
        }

        file_put_contents($filename, serialize($dataCollection));
    }

    public static function load(): void
    {
        $filename = __DIR__.'/../../var/data/blog_post.dat';

        self::$collection = [];

        if (file_exists($filename)) {
            $content = file_get_contents($filename);

            if ('' !== $content) {
                $dataCollection = unserialize($content, ['allowed_class' => false]);

                foreach ($dataCollection as $id => $data) {
                    $blogPost = new BlogPost();
                    $blogPost->fromArray($data);

                    self::$collection[$id] = $blogPost;
                }
            }
        }
    }

    /**
     * @return list<BlogPost>
     */
    public static function all(): array
    {
        if (!isset(self::$collection)) {
            self::load();
        }

        return array_values(self::$collection);
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function toHtml(): string
    {
        $date = $this->updatedAt
            ? $this->updatedAt->format('Y-m-d H:i')
            : $this->createdAt->format('Y-m-d H:i');

        return <<<HTML
<article>
    {$this->title}
    <p>Author: {$this->author} | Date: {$date} | Id: {$this->id}</p>
    {$this->content}
</article>
HTML;
    }
}
