<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=255, minMessage="Votre nom ne peut pas faire moins de 2 caratères", maxMessage="Votre nom ne peut pas faire plus de 255 caractères")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=255, minMessage="Votre prénom ne peut pas faire moins de 2 caratères", maxMessage="Votre prénom ne peut pas faire plus de 255 caractères")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=2, max=255, minMessage="Le nom de votre entreprise doit contenir minimum 2 caratères", maxMessage="Le nom de votre entreprise ne peut pas faire plus de 255 caractères")
     */
    private $compagny;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     * pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})^",
     * message="Veuillez saisir un numéro de téléphone valide")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(message="Veuillez saisir une adresse mail valide")
     */
    private $mail;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=30, minMessage="Votre message ne peut pas faire moins 30 caratères")
     */
    private $message;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     */
    private $checkmessage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCompagny(): ?string
    {
        return $this->compagny;
    }

    public function setCompagny(?string $compagny): self
    {
        $this->compagny = $compagny;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCheckmessage(): ?bool
    {
        return $this->checkmessage;
    }

    public function setCheckmessage(bool $checkmessage): self
    {
        $this->checkmessage = $checkmessage;

        return $this;
    }
}
