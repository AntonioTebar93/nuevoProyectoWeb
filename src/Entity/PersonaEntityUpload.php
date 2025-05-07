<?php

namespace App\Entity;

use App\Repository\PersonaEntityUploadRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonaEntityUploadRepository::class)]
class PersonaEntityUpload
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'El nombre no puede estar vacío')]
    #[ORM\Column(length: 100)]
    private ?string $nombre = null;
    
    #[Assert\NotBlank(message: 'El correo no puede estar vacío')]
    #[Assert\Email(message: 'El correo {{ value }} no tiene un formato válido')]
    #[ORM\Column(length: 255)]
    private ?string $correo = null;

    #[Assert\NotBlank(message: 'El teléfono no puede estar vacío')]
    #[Assert\Regex(
        pattern: '/^(\d{9}|\d{3}\s\d{3}\s\d{3})$/',
        message: 'El teléfono {{ value }} no tiene un formato válido. Debe ser 9 dígitos o 3 grupos de 3 dígitos separados por espacios.'
    )]
    #[ORM\Column(length: 100)]
    private ?string $telefono = null;

    #[Assert\NotBlank(message: 'El país no puede estar vacío')]
    #[ORM\Column(length: 100)]
    private ?string $pais = null;

    #[Assert\NotNull(message: 'Debes subir una imagen.')]
    #[Assert\File(
        maxSize: "10M",
        mimeTypes: [
            'image/jpeg',
            'image/png',
            'image/gif',
        ],
        mimeTypesMessage: 'Por favor, sube una imagen válida (JPEG, PNG o GIF).',
        maxSizeMessage: 'El tamaño máximo permitido es de 10 MB.'
    )]
    protected $foto;

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

    public function getFoto()
    {
        return $this->foto;
    }
    public function setFoto($foto): static
    {
        $this->foto = $foto;

        return $this;
    }
}
