<?php

namespace App\Entity;

use App\Repository\MascotaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MascotaRepository::class)
 */
class Mascota
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $requisitos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vacunado;

    /**
     * @ORM\Column(type="boolean")
     */
    private $desparasitado;

    /**
     * @ORM\Column(type="boolean")
     */
    private $esterilizado;

    /**
     * @ORM\Column(type="boolean")
     */
    private $microchip;

    /**
     * @ORM\ManyToOne(targetEntity=TipoMascota::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity=EstadoMascota::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fecha_alta;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fecha_adopcion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $aprobada;

    /**
     * @ORM\Column(type="boolean")
     */
    private $rechazada;


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

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getRequisitos(): ?string
    {
        return $this->requisitos;
    }

    public function setRequisitos(?string $requisitos): self
    {
        $this->requisitos = $requisitos;

        return $this;
    }

    public function getVacunado(): ?bool
    {
        return $this->vacunado;
    }

    public function setVacunado(bool $vacunado): self
    {
        $this->vacunado = $vacunado;

        return $this;
    }

    public function getDesparasitado(): ?bool
    {
        return $this->desparasitado;
    }

    public function setDesparasitado(bool $desparasitado): self
    {
        $this->desparasitado = $desparasitado;

        return $this;
    }

    public function getEsterilizado(): ?bool
    {
        return $this->esterilizado;
    }

    public function setEsterilizado(bool $esterilizado): self
    {
        $this->esterilizado = $esterilizado;

        return $this;
    }

    public function getMicrochip(): ?bool
    {
        return $this->microchip;
    }

    public function setMicrochip(bool $microchip): self
    {
        $this->microchip = $microchip;

        return $this;
    }

    public function getTipo(): ?TipoMascota
    {
        return $this->tipo;
    }

    public function setTipo(?TipoMascota $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getEstado(): ?EstadoMascota
    {
        return $this->estado;
    }

    public function setEstado(?EstadoMascota $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFechaAlta(): ?string
    {
        return $this->fecha_alta;
    }

    public function setFechaAlta(string $fecha_alta): self
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    public function getFechaAdopcion(): ?string
    {
        return $this->fecha_adopcion;
    }

    public function setFechaAdopcion(?string $fecha_adopcion): self
    {
        $this->fecha_adopcion = $fecha_adopcion;

        return $this;
    }

    public function getAprobada(): ?bool
    {
        return $this->aprobada;
    }

    public function setAprobada(bool $aprobada): self
    {
        $this->aprobada = $aprobada;

        return $this;
    }

    public function getRechazada(): ?bool
    {
        return $this->rechazada;
    }

    public function setRechazada(bool $rechazada): self
    {
        $this->rechazada = $rechazada;

        return $this;
    }




}
