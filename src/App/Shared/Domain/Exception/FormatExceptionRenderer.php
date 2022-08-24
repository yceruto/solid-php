<?php

declare(strict_types=1);

namespace Solid\App\Shared\Domain\Exception;

use RuntimeException;

class FormatExceptionRenderer implements ExceptionRenderer
{
    /**
     * @param array<string, ExceptionRenderer> $renderers
     */
    public function __construct(
        private readonly array $renderers,
    ) {
    }

    public function render(RuntimeException $exception, string $format = 'html'): void
    {
        $renderer = $this->renderers[$format] ?? null;

        if (null === $renderer) {
            $this->render($exception);
        } else {
            $renderer->render($exception);
        }
    }
}
