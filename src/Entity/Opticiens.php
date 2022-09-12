<?php

namespace App\Entity;

use App\Repository\OpticiensRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpticiensRepository::class)]
class Opticiens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: 'opticien', targetEntity: PotentielClient::class)]
    private Collection $opticien;

    public function __construct()
    {
        $this->opticien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, PotentielClient>
     */
    public function getOpticien(): Collection
    {
        return $this->opticien;
    }

    public function addOpticien(PotentielClient $opticien): self
    {
        if (!$this->opticien->contains($opticien)) {
            $this->opticien->add($opticien);
            $opticien->setOpticien($this);
        }

        return $this;
    }

    public function removeOpticien(PotentielClient $opticien): self
    {
        if ($this->opticien->removeElement($opticien)) {
            // set the owning side to null (unless already changed)
            if ($opticien->getOpticien() === $this) {
                $opticien->setOpticien(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
