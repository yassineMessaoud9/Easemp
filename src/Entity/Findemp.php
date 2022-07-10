<?php

namespace App\Entity;

use App\Repository\FindempRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=FindempRepository::class)
 */
class Findemp
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
    private $domaine;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     * message = "{{ value }} is not a valid email.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Range(min=10000000, max=99999999,minMessage="8 Numbers")
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $place;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type="integer")
     * @Assert\NotBlank(message="Please fill in this field")
     */
    private $nbremp;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getNbremp(): ?int
    {
        return $this->nbremp;
    }

    public function setNbremp(int $nbremp): self
    {
        $this->nbremp = $nbremp;

        return $this;
    }
}
