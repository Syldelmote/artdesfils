<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoriesFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
         $ZeroDechet = new Categories();
         $ZeroDechet->setNom('Zero Dechet');
         $ZeroDechet->setCouleur('green');
         $manager->persist($ZeroDechet);

         $Enfant = new Categories();
         $Enfant->setNom('Enfant');
         $Enfant->setCouleur('blue');
         $manager->persist($Enfant);

         $AccessoireMode = new Categories();
         $AccessoireMode->setNom('Accessoire Mode');
         $AccessoireMode->setCouleur('violet');
         $manager->persist($AccessoireMode);
         $manager->flush(); 
        }

    }

