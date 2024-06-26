<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FiliereRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FiliereRepository::class)]
class Filiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    private ?string $imageFile = null;

    #[ORM\OneToMany(mappedBy: 'filiere', targetEntity: Orientation::class)]
    private Collection $orientations;

    public function __construct()
    {
        $this->orientations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        $this->setSlug((new Slugify())->slugify($title));

        return $this;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    // public function setCycle(): ?string
    // {
    //     return $this->cycle;
    // }

    // public function getCycle(?string $cycle): static
    // {
    //     $this->cycle = $cycle;

    //     return $this;
    // }
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

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(string $imageFile): static
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return Collection<int, Orientation>
     */
    public function getOrientations(): Collection
    {
        return $this->orientations;
    }

    public function addOrientation(Orientation $orientation): static
    {
        if (!$this->orientations->contains($orientation)) {
            $this->orientations->add($orientation);
            $orientation->setFiliere($this);
        }

        return $this;
    }

    public function removeOrientation(Orientation $orientation): static
    {
        if ($this->orientations->removeElement($orientation)) {
            // set the owning side to null (unless already changed)
            if ($orientation->getFiliere() === $this) {
                $orientation->setFiliere(null);
            }
        }

        return $this;
    }
}
