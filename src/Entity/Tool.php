<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ToolRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"OT:read"}},
 *      denormalizationContext={"groups"={"OT:write"}},
 * )
 * @ApiFilter(
 *      SearchFilter::class,
 *          properties={"sapToolNumber" : "exact","identification" : "exact"}
 * )
 * @ORM\Entity(repositoryClass=ToolRepository::class)
 * @UniqueEntity("sapToolNumber")
 * @UniqueEntity("identification")
 */
class Tool
{
    /**
     * @Groups({"OT:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="integer", unique=true)
     */
    private $sapToolNumber;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $identification;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utilisation;

    /**
     * @ORM\OneToMany(targetEntity=Demandes::class, mappedBy="ToolSAP")
     */
    private $demandes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $programmeAvion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getsapToolNumber(): ?int
    {
        return $this->sapToolNumber;
    }

    public function setsapToolNumber(int $sapToolNumber): self
    {
        $this->sapToolNumber = $sapToolNumber;

        return $this;
    }

    public function getdesignation(): ?string
    {
        return $this->designation;
    }

    public function setdesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getidentification(): ?string
    {
        return $this->identification;
    }

    public function setidentification(?string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    public function getutilisation(): ?string
    {
        return $this->utilisation;
    }

    public function setutilisation(?string $utilisation): self
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    /**
     * @return Collection<int, Demandes>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demandes $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setToolSAP($this);
        }

        return $this;
    }

    public function removeDemande(Demandes $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getToolSAP() === $this) {
                $demande->setToolSAP(null);
            }
        }

        return $this;
    }

    public function getprogrammeAvion(): ?string
    {
        return $this->programmeAvion;
    }

    public function setprogrammeAvion(string $programmeAvion): self
    {
        $this->programmeAvion = $programmeAvion;

        return $this;
    }

    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
