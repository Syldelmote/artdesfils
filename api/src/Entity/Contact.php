<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[ApiResource]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomArticle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $referenceArticle = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: false)]
    private \DateTimeImmutable $dateEnvoi;

    public function __construct()
    {
        $this->dateEnvoi = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getNomArticle(): ?string
    {
        return $this->nomArticle;
    }

    public function setNomArticle(?string $nomArticle): static
    {
        $this->nomArticle = $nomArticle;

        return $this;
    }

    public function getReferenceArticle(): ?string
    {
        return $this->referenceArticle;
    }

    public function setReferenceArticle(?string $referenceArticle): static
    {
        $this->referenceArticle = $referenceArticle;

        return $this;
    }

    public function getDateEnvoi(): \DateTimeImmutable
    {
        return $this->dateEnvoi;
    }

    // public function setDateEnvoi(?\DateTimeImmutable $dateEnvoi): static
    // {
    //     $this->dateEnvoi = $dateEnvoi;

    //     return $this;
    // }
}
