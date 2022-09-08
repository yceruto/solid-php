<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\UseCase\ListBlogPostUseCase;
use Solid\App\BlogPost\Domain\Model\BlogPostNormalizer;
use Solid\App\BlogPost\Infrastructure\Persistence\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\ListAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;
use Solid\App\BlogPost\Presentation\Renderer\JsonRenderer;
use Solid\App\BlogPost\Presentation\Renderer\RenderContainer;

require __DIR__.'/../../vendor/autoload.php';

$normalizer = new BlogPostNormalizer();
$storage = new FileStorage($normalizer, __DIR__.'/../../var/data/blog_post.dat');
$useCase = new ListBlogPostUseCase($storage);
$renderContainer = new RenderContainer([
    'html' => new HtmlRenderer(),
    'json' => new JsonRenderer($normalizer),
]);
$format = $_GET['format'] ?? 'html';

$action = new ListAction($useCase, $renderContainer->get($format));
$action($format);
