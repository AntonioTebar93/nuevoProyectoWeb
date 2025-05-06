<?php

namespace App\Entity;

use App\Repository\PersonaValidationRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonaValidationRepository::class)]
class PersonaValidation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Assert\NotBlank(message: 'El id no puede estar vacío')]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'El nombre no puede estar vacío')]
    #[ORM\Column(length: 100)]
    private ?string $nombre = null;
    
    #[Assert\NotBlank(message: 'El correo no puede estar vacío')]
    #[ORM\Column(length: 255)]
    private ?string $correo = null;

    #[Assert\NotBlank(message: 'El teléfono no puede estar vacío')]
    #[ORM\Column(length: 100)]
    private ?string $telefono = null;

    #[Assert\NotBlank(message: 'El país no puede estar vacío')]
    #[ORM\Column(length: 100)]
    private ?string $pais = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): static
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): static
    {
        $this->pais = $pais;

        return $this;
    }
}
