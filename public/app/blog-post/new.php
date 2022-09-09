<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Create\CreateHandler;
use Solid\App\BlogPost\Domain\Serializer\ObjectSerializer;
use Solid\App\BlogPost\Infrastructure\Hydration\ObjectHydrator;
use Solid\App\BlogPost\Infrastructure\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\CreateAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;

require __DIR__.'/../../../vendor/autoload.php';

$storage = new FileStorage(
    __DIR__.'/../../../var/data/blog_post.dat',
    new ObjectHydrator(),
    new ObjectSerializer(),
);

$controller = new CreateAction(
    new CreateHandler($storage),
    new HtmlRenderer(),
);
$response = $controller(intval($_GET['id'] ?? 0));
$response->send();
