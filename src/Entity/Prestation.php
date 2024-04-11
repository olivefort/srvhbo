<?php

namespace App\Entity;


use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PrestationRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
#[UniqueEntity('title')]
#[ORM\HasLifecycleCallbacks]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    private string $title;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    private string $location;

    #[ORM\Column(type: 'date_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $date;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    private string $meetingLocation;

    #[ORM\Column(type: 'time_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $meetingHour;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private string $information;

    #[ORM\Column(type: 'time_immutable')]
    #[Assert\NotNull()]
    private \DateTimeImmutable $playingTime;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    private ?int $nbPerformance = null;




    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
        $this->meetingHour = new \DateTimeImmutable();
        $this->playingTime = new \DateTimeImmutable();
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
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }
    public function setLocation(string $location): static
    {
        $this->location = $location;
        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }
    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getMeetingLocation(): ?string
    {
        return $this->meetingLocation;
    }
    public function setMeetingLocation(string $meetingLocation): static
    {
        $this->meetingLocation = $meetingLocation;
        return $this;
    }

    public function getMeetingHour(): ?\DateTimeImmutable
    {
        return $this->meetingHour;
    }
    public function setMeetingHour(\DateTimeImmutable $meetingHour): static
    {
        $this->meetingHour = $meetingHour;
        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): static
    {
        $this->information = $information;
        return $this;
    }

    public function getPlayingTime(): ?\DateTimeImmutable
    {
        return $this->playingTime;
    }

    public function setPlayingTime(\DateTimeImmutable $playingTime): static
    {
        $this->playingTime = $playingTime;
        return $this;
    }

    public function getNbPerformance(): ?int
    {
        return $this->nbPerformance;
    }

    public function setNbPerformance(?int $nbPerformance): static
    {
        $this->nbPerformance = $nbPerformance;
        return $this;
    }
}
