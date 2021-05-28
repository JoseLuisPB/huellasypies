<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
// Import para comprobar que el valor del campo no está ya en la base de datos
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 * @UniqueEntity(fields={"email"}, message="El email ya existe")
 */
class Usuario implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar en blanco")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar en blanco")
     */
    private $poblacion;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar en blanco")
     */
    private $provincia;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar en blanco")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email( message = "El email '{{ value }}' no es válido")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar en blanco")
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="El campo no puede estar en blanco")
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reiniciar_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPoblacion(): ?string
    {
        return $this->poblacion;
    }

    public function setPoblacion(string $poblacion): self
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fecha_alta;
    }

    public function setFechaAlta(string $fecha_alta): self
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    public function getReiniciarPassword(): ?bool
    {
        return $this->reiniciar_password;
    }

    public function setReiniciarPassword(bool $reiniciar_password): self
    {
        $this->reiniciar_password = $reiniciar_password;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    public function getUserName()
    {
        return $this->login;
    }
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array($this->rol);
    }
        public function eraseCredentials()
    {
    }
    public function serialize() 
    { 
        return serialize(array($this->id, $this->login, $this->password)); 
    } 
    public function unserialize($datos_serializados) 
    { 
        list($this->id, $this->login, $this->password) = unserialize($datos_serializados, array('allowed_classes'=> false)); 
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }
}
