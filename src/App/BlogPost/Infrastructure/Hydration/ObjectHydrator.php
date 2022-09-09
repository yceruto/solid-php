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

namespace Solid\App\BlogPost\Infrastructure\Hydration;

use DateTimeImmutable;
use ReflectionClass;

class ObjectHydrator implements Hydrator
{
    public function hydrate(string $className, array $data): object
    {
        $reflectionClass = new ReflectionClass($className);
        $object = $reflectionClass->newInstanceWithoutConstructor();

        foreach ($data as $key => $value) {
            $property = $reflectionClass->getProperty($key);

            $value = match ($property->getType()->getName()) {
                'DateTimeImmutable' => $value ? new DateTimeImmutable($value) : null,
                default => $value,
            };

            $property->setValue($object, $value);
        }

        return $object;
    }
}
