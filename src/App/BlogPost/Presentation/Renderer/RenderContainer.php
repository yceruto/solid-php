<?php

namespace Solid\App\BlogPost\Presentation\Renderer;

use InvalidArgumentException;

final class RenderContainer
{
    /**
     * @param array<string, Renderer> $renderers
     */
    public function __construct(private readonly array $renderers)
    {
    }

    public function get(string $format): Renderer
    {
        if (!isset($this->renderers[$format])) {
            throw new InvalidArgumentException('Unsupported format: '.$format);
        }

        return $this->renderers[$format];
    }
}
