<?php

namespace Fmb\Infra\Database\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fmb\Infra\Database\Entity\MissingOne;
use Fmb\Infra\Database\Repository\PhotosRepository;

#[ORM\Entity(repositoryClass: PhotosRepository::class)]
class Photos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'photosList')]
    private ?MissingOne $missingOne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMissingOne(): ?MissingOne
    {
        return $this->missingOne;
    }

    public function setMissingOne(?MissingOne $missingOne): static
    {
        $this->missingOne = $missingOne;

        return $this;
    }
}
