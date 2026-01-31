<?php

namespace App\Story;

use App\Factory\CategoryFactory;
use App\Factory\ProductFactory;
use Zenstruck\Foundry\Story;

final class DefaultStory extends Story
{
    public function build(): void
    {
        // Créer 5 catégories
        $categories = CategoryFactory::createMany(5);

        // Créer 10 produits avec des catégories aléatoires
        ProductFactory::createMany(10, function() use ($categories) {
            return [
                'categories' => self::faker()->randomElements($categories, rand(1, 3))
            ];
        });
    }
}