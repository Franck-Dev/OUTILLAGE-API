<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaintenanceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"Maint:read"}},
 *      denormalizationContext={"groups"={"Maint:write"}},
 * )
 * @ORM\Entity(repositoryClass=MaintenanceRepository::class)
 */
class Maintenance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Maint:read","Dem:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tool::class, inversedBy="maintenances")
     * @Groups({"Maint:read","Maint:write","Dem:read"})
     */
    private $outillage;

    /**
     * @ORM\ManyToOne(targetEntity=Equipement::class, inversedBy="maintenances")
     * @Groups({"Maint:read","Maint:write","Dem:read"})
     */
    private $Equipement;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"Maint:read","Maint:write","Dem:read"})
     */
    private $dateBesoin;

    /**
     * @ORM\Column(type="array")
     * @Groups({"Maint:read","Maint:write","Dem:read"})
     */
    private $nonConformite;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"Maint:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"Maint:read"})
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Maint:read","Maint:write","Dem:read"})
     */
    private $userCreat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Maint:read"})
     */
    private $userModif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $fichier;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $sigle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $causeDem;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $actionsCorrectives = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $userValideur;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $dateValid;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $respo;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $delaiAction = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $userReal = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $dateReal = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Groups({"Maint:read","Maint:write"})
     */
    private $rep = [];

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

    public function getNonConformite(): ?string
    {
        return $this->nonConformite;
    }

    public function setNonConformite(string $nonConformite): self
    {
        $this->nonConformite = $nonConformite;

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

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getCauseDem(): ?string
    {
        return $this->causeDem;
    }

    public function setCauseDem(string $causeDem): self
    {
        $this->causeDem = $causeDem;

        return $this;
    }

    public function getActionsCorrectives(): ?array
    {
        return $this->actionsCorrectives;
    }

    public function setActionsCorrectives(?array $actionsCorrectives): self
    {
        $this->actionsCorrectives = $actionsCorrectives;

        return $this;
    }

    public function getUserValideur(): ?string
    {
        return $this->userValideur;
    }

    public function setUserValideur(?string $userValideur): self
    {
        $this->userValideur = $userValideur;

        return $this;
    }

    public function getDateValid(): ?\DateTimeImmutable
    {
        return $this->dateValid;
    }

    public function setDateValid(?\DateTimeImmutable $dateValid): self
    {
        $this->dateValid = $dateValid;

        return $this;
    }

    public function getRespo(): ?array
    {
        return $this->respo;
    }

    public function setRespo(?array $respo): self
    {
        $this->respo = $respo;

        return $this;
    }

    public function getDelaiAction(): ?array
    {
        return $this->delaiAction;
    }

    public function setDelaiAction(?array $delaiAction): self
    {
        $this->delaiAction = $delaiAction;

        return $this;
    }

    public function getUserReal(): ?array
    {
        return $this->userReal;
    }

    public function setUserReal(?array $userReal): self
    {
        $this->userReal = $userReal;

        return $this;
    }

    public function getDateReal(): ?array
    {
        return $this->dateReal;
    }

    public function setDateReal(?array $dateReal): self
    {
        $this->dateReal = $dateReal;

        return $this;
    }

    public function getRep(): ?array
    {
        return $this->rep;
    }

    public function setRep(?array $rep): self
    {
        $this->rep = $rep;

        return $this;
    }
}
