<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    private string $Title;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    private string $Location;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull()]
    private string $Date;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    private string $meetingLocation;

    #[ORM\Column(type: 'string')]
    #[Assert\NotNull()]
    private string $meetingHour;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    private string $information;

    #[ORM\Column(type: 'integer')]
    #[Assert\Positive()]
    #[Assert\NotNull()]
    private ?int $playingTime = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\Positive()]
    private ?int $nbPerformance = null;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }
    public function setTitle(string $Title): static
    {
        $this->Title = $Title;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }
    public function setLocation(string $Location): static
    {
        $this->Location = $Location;
        return $this;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }
    public function setDate(string $Date): static
    {
        $this->Date = $Date;
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

    public function getMeetingHour(): ?string
    {
        return $this->meetingHour;
    }
    public function setMeetingHour(string $meetingHour): static
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

    public function getPlayingTime(): ?int
    {
        return $this->playingTime;
    }

    public function setPlayingTime(int $playingTime): static
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
