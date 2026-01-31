<?php

namespace App\Factory;

use App\Entity\Product;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

final class ProductFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'designation' => self::faker()->sentence(3),
        ];
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}