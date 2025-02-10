<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produits;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\CategoriesFixtures;



class ProduitsFixtures extends Fixture implements DependentFixtureInterface
{
    private string $publicDir;

    public function __construct ($publicDir) 
    {
        $this->publicDir = $publicDir;
    }

    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        $csvFile = $this->publicDir. '/catalog_products.csv';
        $csvData = array_map('str_getcsv', file($csvFile));
        $headers = array_shift($csvData);
        // Inverse l'ordre pour avoir l'article le + recent à la fin 
        $csvData = array_reverse($csvData);

        foreach ($csvData as $row) {
            $data = array_combine($headers, $row);
            
            $produit = new Produits();
            $produit->setNom($data['name']);
            $description =  strip_tags(  $data['description']);
            $description = str_replace('&nbsp;', '. ', $description);
            $produit->setDescription($description );
            
            // Gestion des URLs d'images
            // $imageUrls = explode(';', $data['productImageUrl']);
            // if (!empty($imageUrls[0])) $produit->setImageUrl($imageUrls[0]);
            // if (!empty($imageUrls[1])) $produit->setImageUrl2($imageUrls[1]);
            // if (!empty($imageUrls[2])) $produit->setImageUrl3($imageUrls[2]);
            
            $produit->setPrix($data['price']*100);
            $produit->setStock((int)$data['inventory']);
            
            $categoryName = $data['collection'];
            if (stripos($categoryName, 'bébé / enfant') !== false) {
                $categoryName = 'Enfant';
            }
            if (stripos($categoryName, 'zero dechet') !== false) {
                $categoryName = 'Zero Dechet';
            }
            if (stripos($categoryName, 'accessoires mode') !== false) {
                $categoryName = 'Accessoire Mode';
            }

            if (strpos($categoryName, ';') !== false) {
                $categoryName= 'Accessoire Mode';
            }

            $categorie = $manager->getRepository(Categories::class)->findOneBy(['nom' => $categoryName]);
            $produit->setCategorie($categorie);
            
            $produit->setTag($data['ribbon']);
            
            $manager->persist($produit);
        }




        $manager->flush(); 
    }


}
