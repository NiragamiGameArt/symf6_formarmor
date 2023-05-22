<?php
namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

   /**
 * @ORM\ManyToOne(targetEntity="App\Entity\Session_formation")
 * @ORM\JoinColumn(name="session_formation_id", referencedColumnName="id", nullable=false)
 */
private $session_formation_id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_inscription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validee;

    // Getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getSessionFormationId(): ?Session_formation
{
    return $this->session_formation_id;
}

public function setSessionFormationId(?Session_formation $session_formation): self
{
    $this->session_formation_id = $session_formation;

    return $this;
}

    public function getValidee(): ?bool
    {
        return $this->validee;
    }

    public function setValidee(bool $validee): self
    {
        $this->validee = $validee;

        return $this;
    }
}
