<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Find\FindHandler;
use Solid\App\BlogPost\Domain\Serializer\ObjectSerializer;
use Solid\App\BlogPost\Infrastructure\Hydration\ObjectHydrator;
use Solid\App\BlogPost\Infrastructure\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\ShowAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;
use Solid\App\BlogPost\Presentation\Renderer\JsonRenderer;
use Solid\App\BlogPost\Presentation\Renderer\RendererStrategy;
use Solid\App\BlogPost\Presentation\Renderer\XmlRenderer;

require __DIR__.'/../../../vendor/autoload.php';

try {
    $renderer = (new RendererStrategy([
        'html' => new HtmlRenderer(),
        'json' => new JsonRenderer(new ObjectSerializer()),
        'xml' => new XmlRenderer(new ObjectSerializer()),
    ]))->find($_GET['format'] ?? 'html');
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();

    return;
}

$storage = new FileStorage(
    __DIR__.'/../../../var/data/blog_post.dat',
    new ObjectHydrator(),
    new ObjectSerializer(),
);

$controller = new ShowAction(
    new FindHandler($storage),
    $renderer,
);
$response = $controller(intval($_GET['id'] ?? 0));
$response->send();
