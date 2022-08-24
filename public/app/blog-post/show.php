<?php

declare(strict_types=1);

use Solid\App\BlogPost\Application\Find\FindUseCase;
use Solid\App\BlogPost\Infrastructure\Normalizer\ReflectionNormalizer;
use Solid\App\BlogPost\Infrastructure\Persistence\Storage\FileStorage;
use Solid\App\BlogPost\Presentation\Controller\ShowAction;
use Solid\App\BlogPost\Presentation\Renderer\HtmlRenderer;
use Solid\App\BlogPost\Presentation\Renderer\JsonRenderer;
use Solid\App\BlogPost\Presentation\Renderer\FormatRenderer;
use Solid\App\Shared\Domain\Exception\FormatExceptionRenderer;
use Solid\App\Shared\Domain\Exception\HtmlExceptionRenderer;
use Solid\App\Shared\Domain\Exception\JsonExceptionRenderer;

require __DIR__.'/../../../vendor/autoload.php';

$storageDir = __DIR__.'/../../../var/data';
$normalizer = new ReflectionNormalizer();
$storage = new FileStorage(
    $normalizer,
    $storageDir,
);
$action = new ShowAction(
    new FindUseCase(
        $storage,
    ),
    new FormatRenderer([
        'html' => new HtmlRenderer(),
        'json' => new JsonRenderer(
            $normalizer,
        ),
    ]),
);
$formatExceptionRenderer = new FormatExceptionRenderer([
    'html' => new HtmlExceptionRenderer(),
    'json' => new JsonExceptionRenderer(),
]);
$format = $_GET['format'] ?? 'html';

try {
    $action((int) ($_GET['id'] ?? 0), $format);
} catch (RuntimeException $exception) {
    $formatExceptionRenderer->render($exception, $format);
}
