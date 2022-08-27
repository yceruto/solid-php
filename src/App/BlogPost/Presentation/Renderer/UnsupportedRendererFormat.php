<?php

declare(strict_types=1);

namespace Solid\App\BlogPost\Presentation\Renderer;

use RuntimeException;

class UnsupportedRendererFormat extends RuntimeException
{
    public readonly string $format;

    public static function create(string $message, string $format): self
    {
        $self = new self($message);
        $self->format = $format;

        return $self;
    }
}
