<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\UseCase\FindBlogPostUseCase;
use Solid\App\BlogPost\Domain\Model\BlogPostNormalizer;
use Solid\App\BlogPost\Infrastructure\Persistence\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\ShowAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;
use Solid\App\BlogPost\Presentation\Renderer\JsonRenderer;
use Solid\App\BlogPost\Presentation\Renderer\RenderContainer;

require __DIR__.'/../../vendor/autoload.php';

$normalizer = new BlogPostNormalizer();
$storage = new FileStorage($normalizer, __DIR__.'/../../var/data/blog_post.dat');
$useCase = new FindBlogPostUseCase($storage);
$renderContainer = new RenderContainer([
    'html' => new HtmlRenderer(),
    'json' => new JsonRenderer($normalizer),
]);
$format = $_GET['format'] ?? 'html';

$action = new ShowAction($useCase, $renderContainer->get($format));
$action((int) ($_GET['id'] ?? 0), $format);
