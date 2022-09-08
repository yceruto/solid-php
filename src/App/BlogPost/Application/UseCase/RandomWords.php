<?php

namespace Solid\App\BlogPost\Application\UseCase;

final class RandomWords
{
    public function get(string $size): string
    {
        $times = match ($size) {
            's' => 2,
            'm' => 3,
            'l' => 10,
        };
        $string = '';
        for ($i = 0; $i < $times; ++$i) {
            $string .= $this->randWord().' ';
        }

        return trim($string);
    }

    private function randWord(): string
    {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        $length = random_int(7, 12);

        return substr(implode($word), 0, $length);
    }
}
