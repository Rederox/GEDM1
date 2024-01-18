<?php

// src/Service/FakerService.php
namespace App\Services;

use App\Entity\Product;
use Faker\Factory;

class FakerService
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function createFakeProduct(): Product
    {
        $product = new Product();
        $product->setProductName($this->faker->words(3, true)); // Génère un nom de produit
        $product->setDescription($this->faker->text());           // Génère une description
        $product->setImageUrl("/assets/images/chemistry" . $this->faker->numberBetween(1, 3) .".jpg");
        
        return $product;
    }
}
