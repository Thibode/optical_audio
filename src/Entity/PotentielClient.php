<?php

namespace App\Entity;

use App\Repository\PotentielClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ambta\DoctrineEncryptBundle\Configuration\Encrypted;


#[ORM\Table(name: 'clients')]
#[ORM\Entity(repositoryClass: PotentielClientRepository::class)]
class PotentielClient
{
    const OUI = 'OUI';
    const NON = 'NON';
    const PRESBYACOUSIE = 'PRESBYACOUSIE';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Encrypted]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateTest = null;

    #[ORM\Column(length: 255)]
    #[Encrypted]
    private ?string $appareil = null;

    #[ORM\Column(length: 255)]
    #[Encrypted]
    private ?string $perteAuditive = null;

    #[ORM\Column(length: 255)]
    #[Encrypted]
    private ?string $Deni = null;

    #[ORM\Column(length: 255)]
    #[Encrypted]
    private ?string $souhait = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Encrypted]
    private ?string $remarque = null;

    #[ORM\ManyToOne(inversedBy: 'opticien')]
    private ?Opticiens $opticien = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateRappel = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateTest(): ?\DateTimeInterface
    {
        return $this->dateTest;
    }

    public function setDateTest(\DateTimeInterface $dateTest): self
    {
        $this->dateTest = $dateTest;

        return $this;
    }

    public function getDateRappel(): ?\DateTimeInterface
    {
        return $this->dateRappel;
    }

    public function setDateRappel(\DateTimeInterface $dateRappel): self
    {
        $this->dateRappel = $dateRappel;

        return $this;
    }

    public function getAppareil(): ?string
    {
        return $this->appareil;
    }

    public function setAppareil(string $appareil): self
    {
        $this->appareil = $appareil;

        return $this;
    }

    public function getPerteAuditive(): ?string
    {
        return $this->perteAuditive;
    }

    public function setPerteAuditive(string $perteAuditive): self
    {
        $this->perteAuditive = $perteAuditive;

        return $this;
    }

    public function getDeni(): ?string
    {
        return $this->Deni;
    }

    public function setDeni(string $Deni): self
    {
        $this->Deni = $Deni;

        return $this;
    }

    public function getSouhait(): ?string
    {
        return $this->souhait;
    }

    public function setSouhait(string $souhait): self
    {
        $this->souhait = $souhait;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    public function getOpticien(): ?Opticiens
    {
        return $this->opticien;
    }

    public function setOpticien(?Opticiens $opticien): self
    {
        $this->opticien = $opticien;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

}
