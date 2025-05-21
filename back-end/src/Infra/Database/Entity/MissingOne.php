<?php

namespace Fmb\Infra\Database\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Fmb\Infra\Database\Entity\Photos;
use Fmb\Infra\Database\Repository\MissingOneRepository;

#[ORM\Entity(repositoryClass: MissingOneRepository::class)]
#[ApiResource]
class MissingOne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $name = null;

    #[ORM\Column(length: 1000)]
    private ?string $description = null;

    /**
     * @var Collection<int, Photos>
     */
    #[ORM\OneToMany(targetEntity: Photos::class, mappedBy: 'missingOne')]
    private Collection $photosList;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    public function __construct()
    {
        $this->photosList = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return static
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return static
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Photos>
     */
    public function getPhotosList(): Collection
    {
        return $this->photosList;
    }

    /**
     * @param Photos $photosList
     * @return static
     */
    public function addPhotosList(Photos $photosList): static
    {
        if (!$this->photosList->contains($photosList)) {
            $this->photosList->add($photosList);
            $photosList->setMissingOne($this);
        }

        return $this;
    }

    /**
     * @param Photos $photosList
     * @return static
     */
    public function removePhotosList(Photos $photosList): static
    {
        if ($this->photosList->removeElement($photosList)) {
            // set the owning side to null (unless already changed)
            if ($photosList->getMissingOne() === $this) {
                $photosList->setMissingOne(null);
            }
        }

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return static
     */
    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
