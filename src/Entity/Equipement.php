<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"Eqmnt:read"}},
 *      denormalizationContext={"groups"={"Eqmnt:write"}},
 * )
 * @ORM\Entity(repositoryClass=EquipementRepository::class)
 * @UniqueEntity("numEquipement")
 * @UniqueEntity("identification")
 */
class Equipement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Eqmnt:read","Dem:read","CT:read","Maint:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"Eqmnt:read","Eqmnt:write","Dem:read","CT:read","Maint:read"})
     */
    private $numEquipement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Eqmnt:read","Eqmnt:write","Dem:read","CT:read","Maint:read"})
     */
    private $identification;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"Eqmnt:read","Eqmnt:write","Dem:read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"Eqmnt:read"})
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="equipement")
     */
    private $controles;

    /**
     * @ORM\OneToMany(targetEntity=Maintenance::class, mappedBy="equipement")
     */
    private $maintenances;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Eqmnt:read"})
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity=Tool::class, inversedBy="equipemnt")
     */
    private $tool;

    /**
     * @Groups({"Eqmnt:read"})
     */
    private $siteUtil;

    public function __construct()
    {
        $this->controles = new ArrayCollection();
        $this->maintenances = new ArrayCollection();
    }

    public function getSiteUtil(): ?array
    {
        return $this->siteUtil;
    }

    public function setSiteUtil(array $siteUtil)
    {
        $this->siteUtil = $siteUtil;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEquipement(): ?int
    {
        return $this->numEquipement;
    }

    public function setNumEquipement(int $numEquipement): self
    {
        $this->numEquipement = $numEquipement;

        return $this;
    }

    public function getIdentification(): ?string
    {
        return $this->identification;
    }

    public function setIdentification(string $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, Controle>
     */
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(Controle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
            $controle->setEquipement($this);
        }

        return $this;
    }

    public function removeControle(Controle $controle): self
    {
        if ($this->controles->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getEquipement() === $this) {
                $controle->setEquipement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Maintenance>
     */
    public function getMaintenances(): Collection
    {
        return $this->maintenances;
    }

    public function addMaintenance(Maintenance $maintenance): self
    {
        if (!$this->maintenances->contains($maintenance)) {
            $this->maintenances[] = $maintenance;
            $maintenance->setEquipement($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->maintenances->removeElement($maintenance)) {
            // set the owning side to null (unless already changed)
            if ($maintenance->getEquipement() === $this) {
                $maintenance->setEquipement(null);
            }
        }

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getTool(): ?Tool
    {
        return $this->tool;
    }

    public function setTool(?Tool $tool): self
    {
        $this->tool = $tool;

        return $this;
    }
}
