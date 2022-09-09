<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Edit\EditHandler;
use Solid\App\BlogPost\Application\Find\FindHandler;
use Solid\App\BlogPost\Domain\Serializer\ObjectSerializer;
use Solid\App\BlogPost\Infrastructure\Hydration\ObjectHydrator;
use Solid\App\BlogPost\Infrastructure\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\EditAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;

require __DIR__.'/../../../vendor/autoload.php';

$storage = new FileStorage(
    __DIR__.'/../../../var/data/blog_post.dat',
    new ObjectHydrator(),
    new ObjectSerializer(),
);

$controller = new EditAction(
    new FindHandler($storage),
    new EditHandler($storage),
    new HtmlRenderer(),
);
$response = $controller(intval($_GET['id'] ?? 0));
$response->send();
