<?php

declare(strict_types=1);

namespace Solid\App\Shared\Domain\Exception;

use RuntimeException;

class JsonExceptionRenderer implements ExceptionRenderer
{
    public function render(RuntimeException $exception): void
    {
        header('Content-Type: application/json');

        echo json_encode(['message' => $exception->getMessage()], JSON_THROW_ON_ERROR);
    }
}
