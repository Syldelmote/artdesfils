<?php

namespace App\EventListener;

// use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Produits;
use App\Service\ImageResizeService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Psr\Log\LoggerInterface;


class ProductImageResizeListener implements EventSubscriberInterface
{
    private ImageResizeService $imageResizeService;
    private LoggerInterface $logger;


    public function __construct(ImageResizeService $imageResizeService, LoggerInterface $logger)
    {
        $this->imageResizeService = $imageResizeService;
        $this->logger = $logger;
 
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['resizeProductImages', EventPriorities::PRE_WRITE],
        ];
    }

    public function resizeProductImages(ViewEvent $event): void
    {
        $produit = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$produit instanceof Produit || !in_array($method, [Request::METHOD_POST, Request::METHOD_PUT])) {
            return;
        }
        $this->logger->info('ProductImageResizeListener déclenché pour le produit: ' . $produit->getId());


        $imagePaths = [
            $produit->getImageUrl(),
            $produit->getImageUrl2(),
            $produit->getImageUrl3(),
            $produit->getImageUrl4(),
            $produit->getImageUrl5(),
        ];

        foreach ($imagePaths as $imagePath) {
            if ($imagePath) {
                try {
                    $this->imageResizeService->resize($imagePath);
                    $this->logger->info("Image redimensionnée avec succès: {$imagePath}");
                } catch (\Exception $e) {
                    $this->logger->error("Erreur lors du redimensionnement de l'image: {$imagePath}", [
                        'exception' => $e->getMessage()
                    ]);
                }
            }
        }
    }
}