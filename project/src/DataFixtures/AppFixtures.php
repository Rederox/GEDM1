<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Service\FakerService;

class AppFixtures extends Fixture
{   

    private $fakerService;

    // Injectez FakerService via le constructeur
    public function __construct(FakerService $fakerService)
    {
        $this->fakerService = $fakerService;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 60; $i++) {
            $product = $this->fakerService->createFakeProduct();
            $manager->persist($product);
        }

        $manager->flush();
    }
}
