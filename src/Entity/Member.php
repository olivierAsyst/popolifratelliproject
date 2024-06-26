<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    private ?string $fonction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $social_linkOne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $social_linkTwo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $social_linkThree = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;
    private ?string $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateJoined = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): static
    {
        $this->fonction = $fonction;

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

    public function getSocialLinkOne(): ?string
    {
        return $this->social_linkOne;
    }

    public function setSocialLinkOne(?string $social_linkOne): static
    {
        $this->social_linkOne = $social_linkOne;

        return $this;
    }

    public function getSocialLinkTwo(): ?string
    {
        return $this->social_linkTwo;
    }

    public function setSocialLinkTwo(?string $social_linkTwo): static
    {
        $this->social_linkTwo = $social_linkTwo;

        return $this;
    }

    public function getSocialLinkThree(): ?string
    {
        return $this->social_linkThree;
    }

    public function setSocialLinkThree(?string $social_linkThree): static
    {
        $this->social_linkThree = $social_linkThree;

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

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): static
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getDateJoined(): ?\DateTime
    {
        return $this->dateJoined;
    }

    public function setDateJoined(?\DateTime $dateJoined): static
    {
        $this->dateJoined = $dateJoined;

        return $this;
    }

}
