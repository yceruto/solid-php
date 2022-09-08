<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\UseCase\NewBlogPostUseCase;
use Solid\App\BlogPost\Domain\Model\BlogPostNormalizer;
use Solid\App\BlogPost\Infrastructure\Persistence\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\NewAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;
use Solid\App\BlogPost\Presentation\Renderer\JsonRenderer;
use Solid\App\BlogPost\Presentation\Renderer\RenderContainer;

require __DIR__.'/../../vendor/autoload.php';

$normalizer = new BlogPostNormalizer();
$storage = new FileStorage($normalizer, __DIR__.'/../../var/data/blog_post.dat');
$useCase = new NewBlogPostUseCase($storage);
$renderContainer = new RenderContainer([
    'html' => new HtmlRenderer(),
    'json' => new JsonRenderer($normalizer),
]);
$format = $_GET['format'] ?? 'html';

$action = new NewAction($useCase, $renderContainer->get($format));
$action(random_int(0, 999999), $_GET['author'] ?? null, $_GET['title'] ?? null, $_GET['content'] ?? null, $format);
