<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ({"TotoGroup","genreGroup"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ({"Toto","genreGroup"})
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     * @Groups ({"Toto","genreGroup"})
     */
    private $releasedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"Toto","genreGroup"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups ({"Toto","genreGroup"})
     */
    private $img;

    /**
     * @ORM\ManyToOne(targetEntity=Studio::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"Toto","genreGroup"})
     */
    private $studio;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="games")
     * @Groups ({"Toto"})
     */
    private $genre;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReleasedAt(): ?\DateTimeInterface
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(\DateTimeInterface $releasedAt): self
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getStudio(): ?Studio
    {
        return $this->studio;
    }

    public function setStudio(?Studio $studio): self
    {
        $this->studio = $studio;

        return $this;
    }

//    public function jsonSerialize()
//    {
//        return[
//            'id' => $this->getId(),
//            'name' => $this->getName(),
//            'releasedAt' => $this->getReleasedAt()->format('d-m-y'),
//            'img' => $this->getImg(),
//            'studio' => $this->getStudio(),
//            'description' => $this->getDescription(),
//            'genre' => $this->getGenre()->toArray()
//        ];
//    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genre->contains($genre)) {
            $this->genre->removeElement($genre);
        }

        return $this;
    }



}
