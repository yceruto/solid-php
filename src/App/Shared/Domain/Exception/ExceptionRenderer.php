<?php

declare(strict_types=1);

namespace Solid\App\Shared\Domain\Exception;

use RuntimeException;

interface ExceptionRenderer
{
    public function render(RuntimeException $exception): void;
}
