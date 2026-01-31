<?php

namespace App\Factory;

use App\Entity\Category;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

final class CategoryFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'designation' => self::faker()->words(2, true),
        ];
    }

    protected static function getClass(): string
    {
        return Category::class;
    }
}