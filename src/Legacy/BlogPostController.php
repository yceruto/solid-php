<?php

declare(strict_types=1);

namespace Solid\Legacy;

use DateTime;

class BlogPostController
{
    public function listBlogPostsAndRender(): string
    {
        $content = '<h1>List of Blog Posts</h1>';
        foreach (BlogPost::all() as $blogPost) {
            $content .= $blogPost->toHtml();
        }

        return $content;
    }

    public function newBlogPostAndRender(): string
    {
        $loripsum = explode("\n", file_get_contents('https://loripsum.net/api/1/long/headers'));

        $blogPost = new BlogPost();
        $blogPost->setId(random_int(1, 1000));
        $blogPost->setTitle($loripsum[0]);
        $blogPost->setAuthor('John Doe');
        $blogPost->setCreatedAt(new DateTime());
        $blogPost->setContent($loripsum[2]);

        BlogPost::persist($blogPost);
        BlogPost::save();

        return '<h1>New Blog Post</h1>'.$blogPost->toHtml();
    }

    public function editBlogPostAndRender(int $id): string
    {
        if ($blogPost = BlogPost::find($id)) {
            $loripsum = explode("\n", file_get_contents('https://loripsum.net/api/1/long/headers'));

            $blogPost->setTitle($loripsum[0]);
            $blogPost->setContent($loripsum[2]);
            $blogPost->setUpdatedAt(new DateTime());

            BlogPost::save();

            return '<h1>Edit Blog Post</h1>'.$blogPost->toHtml();
        }

        return '<h1>Blog Post not found</h1>';
    }

    public function showBlogPostAndRender(int $id, string $format): string
    {
        if ($blogPost = BlogPost::find($id)) {
            switch ($format) {
                case 'json':
                    header('Content-Type: application/json');
                    return $blogPost->toJson();
                case 'html':
                    return $blogPost->toHtml();
                default:
                    return '<h1>Unsupported format. The Blog Post cannot be renderer in the given format.</h1>';
            }
        }

        return '<h1>Blog Post not found</h1>';
    }
}
