<?php

namespace App\Service;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Psr\Log\LoggerInterface;

class ImageResizeService
{
    private ImageManager $manager;
    private int $maxWidth;
    private int $maxHeight;
    private LoggerInterface $logger;



    public function __construct(int $maxWidth = 2016, int $maxHeight = 1512,int $minWidth = 800, int $minHeight = 600,  LoggerInterface $logger, ImageManager $manager)
    {
        $this->maxWidth = $maxWidth;
        $this->minWidth = $minWidth;
        $this->maxHeight = $maxHeight;
        $this->minHeight = $minHeight;
        $this->logger = $logger;
        $this->manager = $manager;
        
    }

    public function resize(string $imagePath): void
    {
        $this->logger->info("Tentative de redimensionnement de l'image: {$imagePath}");
        
        try {

            $image = $this->manager->read($imagePath);
            $originalSize = $image->width() . 'x' . $image->height();
            $halfWidth = $image->width() / 2;
            $halfHeight = $image->height() / 2;

            if($image->width() <= $this->minWidth || $image->height() <= $this->minHeight){
                $this->logger->info("L'image ne nécessite pas de redimensionnement: {$imagePath}");
            } 
            else if ($halfWidth < $this->maxWidth || $halfHeight < $this->maxHeight) {
                $this->logger->info("Le ratio de l'image va être divisé par 2 : {$imagePath}");
                $image->resize($halfWidth, $halfHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $image->save();
            } else {
                $image->resize($this->maxWidth, $this->maxHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->save();
                $newSize = $image->width() . 'x' . $image->height();
                $this->logger->info("Image redimensionnée: {$imagePath}", [
                    'original_size' => $originalSize,
                    'new_size' => $newSize
                ]);
            }
        } catch (\Exception $e) {
            $this->logger->error("Erreur lors du redimensionnement de l'image: {$imagePath}", [
                'error' => $e->getMessage()
            ]);
        }
    }
}
