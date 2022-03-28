<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaintenanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MaintenanceRepository::class)
 */
class Maintenance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tool::class, inversedBy="maintenances")
     */
    private $outillage;

    /**
     * @ORM\ManyToOne(targetEntity=Equipement::class, inversedBy="maintenances")
     */
    private $Equipement;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateBesoin;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userCreat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userModif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fichier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOutillage(): ?Tool
    {
        return $this->outillage;
    }

    public function setOutillage(?Tool $outillage): self
    {
        $this->outillage = $outillage;

        return $this;
    }

    public function getEquipement(): ?Equipement
    {
        return $this->Equipement;
    }

    public function setEquipement(?Equipement $Equipement): self
    {
        $this->Equipement = $Equipement;

        return $this;
    }

    public function getDateBesoin(): ?\DateTimeImmutable
    {
        return $this->dateBesoin;
    }

    public function setDateBesoin(\DateTimeImmutable $dateBesoin): self
    {
        $this->dateBesoin = $dateBesoin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeImmutable $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getUserCreat(): ?string
    {
        return $this->userCreat;
    }

    public function setUserCreat(string $userCreat): self
    {
        $this->userCreat = $userCreat;

        return $this;
    }

    public function getUserModif(): ?string
    {
        return $this->userModif;
    }

    public function setUserModif(?string $userModif): self
    {
        $this->userModif = $userModif;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(?string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }
}
