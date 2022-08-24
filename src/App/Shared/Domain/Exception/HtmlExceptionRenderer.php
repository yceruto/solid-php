<?php

declare(strict_types=1);

namespace Solid\App\Shared\Domain\Exception;

use RuntimeException;

class HtmlExceptionRenderer implements ExceptionRenderer
{
    public function render(RuntimeException $exception): void
    {
        echo '<h1>'.$exception->getMessage().'</h1>';
    }
}
