<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DemandesRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"Dem:read"}},
 *      denormalizationContext={"groups"={"Dem:write"}},
 *      attributes={"force_eager"=true},
 *      order("DESC"),
 * )
 *  @ApiFilter(
 *  SearchFilter::class,
 *      properties={"id" : "exact","affectation" : "partial","groupeAffectation" : "partial"})
 * @ApiFilter(
 *  BooleanFilter::class, 
 *      properties={"statut"}
 * )
 * @ApiFilter(
 *  DateFilter::class, 
 *      properties={"createdAt","datePlanif"}
 * )
 * @ORM\Entity(repositoryClass=DemandesRepository::class)
 */
class Demandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Dem:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"Dem:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"Dem:read"})
     */
    private $dateAffectation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Dem:read","Dem:write"})
     */
    private $groupeAffectation;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"Dem:read","Dem:write"})
     */
    private $datePlanif;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"Dem:read","Dem:write"})
     */
    private $dateReal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Dem:read","Dem:write"})
     */
    private $statut;

    /**
     * @ORM\OneToOne(targetEntity=SBO::class, cascade={"persist", "remove"})
     * @Groups({"Dem:read"})
     */
    private $sbo;

    /**
     * @ORM\OneToOne(targetEntity=Controle::class, cascade={"persist", "remove"})
     * @Groups({"Dem:read"})
     */
    private $controle;

    /**
     * @ORM\OneToOne(targetEntity=Maintenance::class, cascade={"persist", "remove"})
     * @Groups({"Dem:read"})
     */
    private $maintenance;

    /**
     * @Groups({"Dem:read"})
     */
    private $type;

    /**
    *@Groups({"Dem:read"})
    */
    private $affectation;

    public function getAffectation(): ?array
    {
        return $this->affectation;
    }

    public function setAffectation(array $affectation)
    {
        $this->affectation = $affectation;

        return $this;
    }
 
    /**
     * @return string
     * @throws \Exception
     */
    public function getType(): string
    {
        //Trouve le type de demande lié (Controle, Maintenance ou SBO)
        if($this->getControle()) {
            $type="Controle";
        } elseif($this->getMaintenance()){
            $type="Maintenance";
        } else {
            $type="SBO";
        }
        return $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateAffectation(): ?\DateTimeImmutable
    {
        return $this->dateAffectation;
    }

    public function setDateAffectation(?\DateTimeImmutable $dateAffectation): self
    {
        $this->dateAffectation = $dateAffectation;

        return $this;
    }

    public function getGroupeAffectation(): ?string
    {
        return $this->groupeAffectation;
    }

    public function setGroupeAffectation(?string $groupeAffectation): self
    {
        $this->groupeAffectation = $groupeAffectation;

        return $this;
    }

    public function getDatePlanif(): ?\DateTimeImmutable
    {
        return $this->datePlanif;
    }

    public function setDatePlanif(?\DateTimeImmutable $datePlanif): self
    {
        $this->datePlanif = $datePlanif;

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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getSbo(): ?SBO
    {
        return $this->sbo;
    }

    public function setSbo(?SBO $sbo): self
    {
        $this->sbo = $sbo;

        return $this;
    }

    public function getControle(): ?Controle
    {
        return $this->controle;
    }

    public function setControle(?Controle $controle): self
    {
        $this->controle = $controle;

        return $this;
    }

    public function getMaintenance(): ?Maintenance
    {
        return $this->maintenance;
    }

    public function setMaintenance(?Maintenance $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }
}
