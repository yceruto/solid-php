<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Search\SearchHandler;
use Solid\App\BlogPost\Domain\Serializer\ObjectSerializer;
use Solid\App\BlogPost\Infrastructure\Hydration\ObjectHydrator;
use Solid\App\BlogPost\Infrastructure\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\ListAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;

require __DIR__.'/../../../vendor/autoload.php';

$storage = new FileStorage(
    __DIR__.'/../../../var/data/blog_post.dat',
    new ObjectHydrator(),
    new ObjectSerializer(),
);

$controller = new ListAction(
    new SearchHandler($storage),
    new HtmlRenderer(),
);
$response = $controller();
$response->send();
