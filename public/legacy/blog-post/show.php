<?php

declare(strict_types=1);

use Solid\Legacy\BlogPostController;

require __DIR__.'/../../../vendor/autoload.php';

$blogPostController = new BlogPostController();

echo $blogPostController->showBlogPostAndRender((int) ($_GET['id'] ?? 0), $_GET['format'] ?? 'html');
