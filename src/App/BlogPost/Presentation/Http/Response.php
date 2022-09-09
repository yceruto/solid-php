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

namespace Solid\App\BlogPost\Presentation\Http;

class Response
{
    public function __construct(
        private string $content,
        private string $contentType = 'text/html',
    ) {
    }

    public function send(): void
    {
        header('Content-Type: '.$this->contentType);

        echo $this->content;
    }
}
