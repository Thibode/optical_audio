<?php

namespace App\Entity;

use App\Repository\UserNotificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserNotificationRepository::class)]
class UserNotification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNotification = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentNotification = null;

    #[ORM\ManyToOne(inversedBy: 'userNotifications')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userNotifications')]
    private ?PotentielClient $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNotification(): ?\DateTimeInterface
    {
        return $this->dateNotification;
    }

    public function setDateNotification(?\DateTimeInterface $dateNotification): self
    {
        $this->dateNotification = $dateNotification;

        return $this;
    }

    public function getCommentNotification(): ?string
    {
        return $this->commentNotification;
    }

    public function setCommentNotification(?string $commentNotification): self
    {
        $this->commentNotification = $commentNotification;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getClient(): ?PotentielClient
    {
        return $this->client;
    }

    public function setClient(?PotentielClient $client): self
    {
        $this->client = $client;

        return $this;
    }
}
