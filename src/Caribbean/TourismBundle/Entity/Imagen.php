<?php

namespace Caribbean\TourismBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imagen
 *
 * @ORM\Table(name="d_imagen")
 * @ORM\Entity
 */
class Imagen
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
     * @ORM\Column(name="ruta", type="string", length=255)
     */
    private $ruta;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Caribbean\TourismBundle\Entity\Galeria", inversedBy="imagenes")
     */
    private $galeria;



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
     * Set ruta
     *
     * @param string $ruta
     * @return Imagen
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set galeria
     *
     * @param \Caribbean\TourismBundle\Entity\Galeria $galeria
     * @return Imagen
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
}
