<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Find\FindUseCase;
use Solid\App\BlogPost\Application\Modify\ModifyUseCase;
use Solid\App\BlogPost\Domain\Service\Factory;
use Solid\App\BlogPost\Infrastructure\Normalizer\ReflectionNormalizer;
use Solid\App\BlogPost\Infrastructure\Persistence\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\EditAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;
use Solid\App\Shared\Domain\Exception\FormatExceptionRenderer;
use Solid\App\Shared\Domain\Exception\HtmlExceptionRenderer;
use Solid\App\Shared\Domain\Exception\JsonExceptionRenderer;

require __DIR__.'/../../../vendor/autoload.php';

$storageDir = __DIR__.'/../../../var/data';
$storage = new FileStorage(
    new ReflectionNormalizer(),
    $storageDir,
);
$action = new EditAction(
    new FindUseCase(
        $storage,
    ),
    new ModifyUseCase(
        new Factory(),
        $storage,
    ),
    new HtmlRenderer(),
);

try {
    $action((int) ($_GET['id'] ?? 0));
} catch (RuntimeException $exception) {
    (new HtmlExceptionRenderer())->render($exception);
}
