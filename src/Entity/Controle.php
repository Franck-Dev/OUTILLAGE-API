<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ControleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"CT:read"}},
 *      denormalizationContext={"groups"={"CT:write"}},
 * )
 * @ORM\Entity(repositoryClass=ControleRepository::class)
 */
class Controle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"CT:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tool::class, inversedBy="controles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"CT:read","CT:write"})
     */
    private $outillage;

    /**
     * @ORM\ManyToOne(targetEntity=Equipement::class, inversedBy="controles")
     * @Groups({"CT:read","CT:write"})
     */
    private $equipement;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"CT:read","CT:write"})
     */
    private $dateBesoin;

    /**
     * @ORM\Column(type="text")
     * @Groups({"CT:read","CT:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"CT:read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"CT:read"})
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"CT:read","CT:write"})
     */
    private $userCreat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $userModif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $fichier;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"CT:read","CT:write"})
     */
    private $refPlan;

    /**
     * @ORM\Column(type="string", length=2)
     * @Groups({"CT:read","CT:write"})
     */
    private $indPlan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $cheminCAO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $detailsControle;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $tolerances;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $dispoOut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $typeRapport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $moyenMesure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CT:read","CT:write"})
     */
    private $infosComplementaire;

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
        return $this->equipement;
    }

    public function setEquipement(?Equipement $equipement): self
    {
        $this->equipement = $equipement;

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

    public function getRefPlan(): ?string
    {
        return $this->refPlan;
    }

    public function setRefPlan(string $refPlan): self
    {
        $this->refPlan = $refPlan;

        return $this;
    }

    public function getIndPlan(): ?string
    {
        return $this->indPlan;
    }

    public function setIndPlan(string $indPlan): self
    {
        $this->indPlan = $indPlan;

        return $this;
    }

    public function getCheminCAO(): ?string
    {
        return $this->cheminCAO;
    }

    public function setCheminCAO(?string $cheminCAO): self
    {
        $this->cheminCAO = $cheminCAO;

        return $this;
    }

    public function getDetailsControle(): ?string
    {
        return $this->detailsControle;
    }

    public function setDetailsControle(?string $detailsControle): self
    {
        $this->detailsControle = $detailsControle;

        return $this;
    }

    public function getTolerances(): ?string
    {
        return $this->tolerances;
    }

    public function setTolerances(?string $tolerances): self
    {
        $this->tolerances = $tolerances;

        return $this;
    }

    public function getDispoOut(): ?\DateTimeImmutable
    {
        return $this->dispoOut;
    }

    public function setDispoOut(?\DateTimeImmutable $dispoOut): self
    {
        $this->dispoOut = $dispoOut;

        return $this;
    }

    public function getTypeRapport(): ?string
    {
        return $this->typeRapport;
    }

    public function setTypeRapport(?string $typeRapport): self
    {
        $this->typeRapport = $typeRapport;

        return $this;
    }

    public function getMoyenMesure(): ?string
    {
        return $this->moyenMesure;
    }

    public function setMoyenMesure(?string $moyenMesure): self
    {
        $this->moyenMesure = $moyenMesure;

        return $this;
    }

    public function getInfosComplementaire(): ?string
    {
        return $this->infosComplementaire;
    }

    public function setInfosComplementaire(?string $infosComplementaire): self
    {
        $this->infosComplementaire = $infosComplementaire;

        return $this;
    }
}
