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
     * @Groups({"OT:read","Dem:read","CT:read","Maint:read"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"OT:read", "OT:write","Dem:read","CT:read","Maint:read"})
     * @ORM\Column(type="integer", unique=true)
     */
    private $sapToolNumber;

    /**
     * @Groups({"OT:read", "OT:write","Dem:read","CT:read","Maint:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $designation;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $identification;

    /**
     * @Groups({"OT:read", "OT:write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $utilisation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"OT:write"})
     */
    private $programmeAvion;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"OT:read", "OT:write"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SBO::class, mappedBy="outillage")
     */
    private $sBOs;

    /**
     * @ORM\OneToMany(targetEntity=Controle::class, mappedBy="Outillage")
     */
    private $controles;

    /**
     * @ORM\OneToMany(targetEntity=Maintenance::class, mappedBy="outillage")
     */
    private $maintenances;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"OT:write","Dem:read"})
     */
    private $secteur;

    /**
     * @ORM\OneToMany(targetEntity=Equipement::class, mappedBy="tool")
     * @Groups({"OT:read"})
     */
    private $equipemnt;

    /**
     * @Groups({"OT:read"})
     */
    private $programme;

    /**
     * @Groups({"OT:read"})
     */
    private $division;

    /**
     * @Groups({"OT:read"})
     */
    private $listEquipement;

    public function __construct()
    {
        $this->sBOs = new ArrayCollection();
        $this->controles = new ArrayCollection();
        $this->maintenances = new ArrayCollection();
        $this->equipemnt = new ArrayCollection();
    }

    public function getProgramme(): ?array
    {
        return $this->programme;
    }

    public function setProgramme(array $programme)
    {
        $this->programme = $programme;

        return $this;
    }

    public function getDivision(): ?array
    {
        return $this->division;
    }

    public function setDivision(array $division)
    {
        $this->division = $division;

        return $this;
    }

    public function getListEquipement(): ?array
    {
        return $this->listEquipement;
    }

    public function setListEquipement(array $listEquipement)
    {
        $this->listEquipement = $listEquipement;

        return $this;
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

    /**
     * @return Collection<int, SBO>
     */
    public function getSBOs(): Collection
    {
        return $this->sBOs;
    }

    public function addSBO(SBO $sBO): self
    {
        if (!$this->sBOs->contains($sBO)) {
            $this->sBOs[] = $sBO;
            $sBO->setOutillage($this);
        }

        return $this;
    }

    public function removeSBO(SBO $sBO): self
    {
        if ($this->sBOs->removeElement($sBO)) {
            // set the owning side to null (unless already changed)
            if ($sBO->getOutillage() === $this) {
                $sBO->setOutillage(null);
            }
        }

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
            $controle->setOutillage($this);
        }

        return $this;
    }

    public function removeControle(Controle $controle): self
    {
        if ($this->controles->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getOutillage() === $this) {
                $controle->setOutillage(null);
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
            $maintenance->setOutillage($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->maintenances->removeElement($maintenance)) {
            // set the owning side to null (unless already changed)
            if ($maintenance->getOutillage() === $this) {
                $maintenance->setOutillage(null);
            }
        }

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * @return Collection<int, equipement>
     */
    public function getEquipemnt(): Collection
    {
        return $this->equipemnt;
    }

    public function addEquipemnt(equipement $equipemnt): self
    {
        if (!$this->equipemnt->contains($equipemnt)) {
            $this->equipemnt[] = $equipemnt;
            $equipemnt->setTool($this);
        }

        return $this;
    }

    public function removeEquipemnt(equipement $equipemnt): self
    {
        if ($this->equipemnt->removeElement($equipemnt)) {
            // set the owning side to null (unless already changed)
            if ($equipemnt->getTool() === $this) {
                $equipemnt->setTool(null);
            }
        }

        return $this;
    }
}
