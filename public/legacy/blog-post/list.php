<?php

declare(strict_types=1);

use Solid\Legacy\BlogPostController;

require __DIR__.'/../../../vendor/autoload.php';

$blogPostController = new BlogPostController();

echo $blogPostController->listBlogPostsAndRender();
