<?php

declare(strict_types=1);

/*
 * This file is part of the Second package.
 *
 * © Second <contact@scnd.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Solid\App\BlogPost\Presentation\Renderer;

use InvalidArgumentException;

class RendererStrategy
{
    public function __construct(private array $rendererCollection)
    {
    }

    public function find(string $format): Renderer
    {
        return $this->rendererCollection[$format]
            ?? throw new InvalidArgumentException('Unsupported format. The Blog Post cannot be renderer in the given format.');
    }
}
