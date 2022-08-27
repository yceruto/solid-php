<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Create\CreateUseCase;
use Solid\App\BlogPost\Domain\Service\Factory;
use Solid\App\BlogPost\Infrastructure\Normalizer\ReflectionNormalizer;
use Solid\App\BlogPost\Infrastructure\Persistence\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\NewAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;

require __DIR__.'/../../../vendor/autoload.php';

$storageDir = __DIR__.'/../../../var/data';
$storage = new FileStorage(
    new ReflectionNormalizer(),
    $storageDir,
);
$action = new NewAction(
    new CreateUseCase(
        new Factory(),
        $storage,
    ),
    new HtmlRenderer(),
);

$action();
