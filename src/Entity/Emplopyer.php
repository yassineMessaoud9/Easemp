<?php

namespace App\Entity;

use App\Repository\EmplopyerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmplopyerRepository::class)
 * @UniqueEntity(fields={"email"}, message="This email already exists")
 */
class Emplopyer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     * message = "{{ value }} is not a valid email.")
     */
    private $email;

    /**
     * @var int
     * @Assert\Range(min=10000000, max=99999999,minMessage="8 Numbers")
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $numerotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $specialite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $otherspec;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat='En attente';

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archived=0;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumerotel(): ?int
    {
        return $this->numerotel;
    }

    public function setNumerotel(int $numerotel): self
    {
        $this->numerotel = $numerotel;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getOtherspec(): ?string
    {
        return $this->otherspec;
    }

    public function setOtherspec(string $otherspec): self
    {
        $this->otherspec = $otherspec;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
