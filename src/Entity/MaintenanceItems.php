<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaintenanceItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"ItemMaint:read"}},
 *      denormalizationContext={"groups"={"ItemMaint:write"}},
 * )
 * @ORM\Entity(repositoryClass=MaintenanceItemsRepository::class)
 */
class MaintenanceItems
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"ItemMaint:read","Maint:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"ItemMaint:read","ItemMaint:write","Maint:read"})
     */
    private $nonConformite;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"ItemMaint:read","ItemMaint:write","Maint:read"})
     */
    private $actionsCorrectives;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ItemMaint:read","ItemMaint:write","Maint:read"})
     */
    private $respo;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"ItemMaint:read","ItemMaint:write","Maint:read"})
     */
    private $delaiAction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"ItemMaint:read","ItemMaint:write","Maint:read"})
     */
    private $userReal;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"ItemMaint:read","ItemMaint:write","Maint:read"})
     */
    private $dateReal;

    /**
     * @ORM\ManyToMany(targetEntity=Maintenance::class, mappedBy="itemActionCorrective")
     */
    private $maintenances;

    public function __construct()
    {
        $this->maintenances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNonConformite(): ?string
    {
        return $this->nonConformite;
    }

    public function setNonConformite(string $nonConformite): self
    {
        $this->nonConformite = $nonConformite;

        return $this;
    }

    public function getActionsCorrectives(): ?string
    {
        return $this->actionsCorrectives;
    }

    public function setActionsCorrectives(?string $actionsCorrectives): self
    {
        $this->actionsCorrectives = $actionsCorrectives;

        return $this;
    }

    public function getRespo(): ?string
    {
        return $this->respo;
    }

    public function setRespo(?string $respo): self
    {
        $this->respo = $respo;

        return $this;
    }

    public function getDelaiAction(): ?\DateTimeImmutable
    {
        return $this->delaiAction;
    }

    public function setDelaiAction(?\DateTimeImmutable $delaiAction): self
    {
        $this->delaiAction = $delaiAction;

        return $this;
    }

    public function getUserReal(): ?string
    {
        return $this->userReal;
    }

    public function setUserReal(?string $userReal): self
    {
        $this->userReal = $userReal;

        return $this;
    }

    public function getDateReal(): ?\DateTimeImmutable
    {
        return $this->dateReal;
    }

    public function setDateReal(?\DateTimeImmutable $dateReal): self
    {
        $this->dateReal = $dateReal;

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
            $maintenance->addItemActionCorrective($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->maintenances->removeElement($maintenance)) {
            $maintenance->removeItemActionCorrective($this);
        }

        return $this;
    }
}
