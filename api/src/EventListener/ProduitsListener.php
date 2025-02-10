<?php

namespace App\EventListener;
use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Mapping\Entity;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Produits::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Produits::class)]
class ProduitsListener 
{
    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function prePersist(Produits $produits)
    {
        $stock = $produits->getStock();
        if($stock < 1){
            $produits->setVisible(false);
            $this->logger->info(' >>>>>>>>>>>>>logger  PrePersist. Set Visible to False' ) ;

        }

        $this->logger->info(' >>>>>>>>>>>>>logger Pre Persist.'. $stock ) ;
    }

    public function preUpdate(Produits $produits)
    {
        $stock = $produits->getStock();
        if($stock < 1){
            $produits->setVisible(false);
            $this->logger->info(' >>>>>>>>>>>>>logger  Pre Update . Set Visible to False' ) ;

        }

        $this->logger->info(' >>>>>>>>>>>>>logger Pre Update.'. $stock ) ;
    }

}
