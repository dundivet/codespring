<?php

namespace Caribbean\TourismBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * POI
 *
 * @ORM\Table(name="d_poi")
 * @ORM\Entity
 */
class POI
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=125)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=1000, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=50, nullable=true)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=50, nullable=true)
     */
    private $ciudad;

    /**
     * @var \Caribbean\TourismBundle\Entity\Galeria
     *
     * @ORM\OneToOne(targetEntity="Caribbean\TourismBundle\Entity\Galeria", inversedBy="poi", cascade={"persist","remove"})
     */
    private $galeria;

    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", length=15)
     * @Assert\NotNull
     */
    private $latitud;

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=15)
     * @Assert\NotNull
     */
    private $longitud;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Caribbean\TourismBundle\Entity\Comentario", mappedBy="poi")
     */
    private $comentarios;

    /**
     * @var \Caribbean\TourismBundle\Entity\Rating
     *
     * @ORM\ManyToOne(targetEntity="Caribbean\TourismBundle\Entity\Rating", inversedBy="pois")
     */
    private $rating;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Caribbean\TourismBundle\Entity\Etiqueta", inversedBy="pois")
     */
    private $etiquetas;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etiquetas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return POI
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return POI
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return POI
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     * @return POI
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return POI
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set latitud
     *
     * @param string $latitud
     * @return POI
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return string 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     * @return POI
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return string 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set galeria
     *
     * @param \Caribbean\TourismBundle\Entity\Galeria $galeria
     * @return POI
     */
    public function setGaleria(\Caribbean\TourismBundle\Entity\Galeria $galeria = null)
    {
        $this->galeria = $galeria;

        return $this;
    }

    /**
     * Get galeria
     *
     * @return \Caribbean\TourismBundle\Entity\Galeria 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * Add comentarios
     *
     * @param \Caribbean\TourismBundle\Entity\Comentario $comentarios
     * @return POI
     */
    public function addComentario(\Caribbean\TourismBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \Caribbean\TourismBundle\Entity\Comentario $comentarios
     */
    public function removeComentario(\Caribbean\TourismBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set rating
     *
     * @param \Caribbean\TourismBundle\Entity\Rating $rating
     * @return POI
     */
    public function setRating(\Caribbean\TourismBundle\Entity\Rating $rating = null)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return \Caribbean\TourismBundle\Entity\Rating 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Add etiquetas
     *
     * @param \Caribbean\TourismBundle\Entity\Etiqueta $etiquetas
     * @return POI
     */
    public function addEtiqueta(\Caribbean\TourismBundle\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas[] = $etiquetas;

        return $this;
    }

    /**
     * Remove etiquetas
     *
     * @param \Caribbean\TourismBundle\Entity\Etiqueta $etiquetas
     */
    public function removeEtiqueta(\Caribbean\TourismBundle\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas->removeElement($etiquetas);
    }

    /**
     * Get etiquetas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }
}
