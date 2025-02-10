<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitsRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Filter\CustomSearchFilter;



#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    shortName :'Produit',
    normalizationContext: ['groups' => ['read:product']],
    order: ['id' => 'DESC']
    )]
#[ApiFilter(CustomSearchFilter::class)]
#[ApiFilter(SearchFilter::class, properties: ['categorie.nom' => 'partial', 'tag' => 'exact' ])]
// #[ApiFilter(SearchFilter::class, properties: ['tag' => 'exact'])]

class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:product'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $imageUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $imageUrl2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $imageUrl3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $collection = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 9, scale: 2, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $prix = null;

    #[ORM\Column]
    #[Groups(['read:product'])]
    private ?bool $visible = true;

    #[ORM\Column]
    #[Groups(['read:product'])]
    private ?int $stock = 1;

    #[ORM\ManyToOne(inversedBy: 'produitsAssocies')]
    #[Groups(['read:product'])]
    private ?Categories $categorie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tag = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $imageUrl4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read:product'])]
    private ?string $imageUrl5 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getImageUrl2(): ?string
    {
        return $this->imageUrl2;
    }

    public function setImageUrl2(?string $imageUrl2): static
    {
        $this->imageUrl2 = $imageUrl2;

        return $this;
    }

    public function getImageUrl3(): ?string
    {
        return $this->imageUrl3;
    }

    public function setImageUrl3(?string $imageUrl3): static
    {
        $this->imageUrl3 = $imageUrl3;

        return $this;
    }



    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function setCollection(?string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getImageUrl4(): ?string
    {
        return $this->imageUrl4;
    }

    public function setImageUrl4(?string $imageUrl4): static
    {
        $this->imageUrl4 = $imageUrl4;

        return $this;
    }

    public function getImageUrl5(): ?string
    {
        return $this->imageUrl5;
    }

    public function setImageUrl5(?string $imageUrl5): static
    {
        $this->imageUrl5 = $imageUrl5;

        return $this;
    }

}
