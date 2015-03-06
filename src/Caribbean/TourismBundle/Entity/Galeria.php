<?php

namespace Caribbean\TourismBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Galeria
 *
 * @ORM\Table(name="d_galeria")
 * @ORM\Entity
 */
class Galeria
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Caribbean\TourismBundle\Entity\Imagen", mappedBy="galeria")
     */
    private $imagenes;

    /**
     * @var \Caribbean\TourismBundle\Entity\POI
     *
     * @ORM\OneToOne(targetEntity="Caribbean\TourismBundle\Entity\POI", mappedBy="galeria")
     */
    private $poi;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add imagenes
     *
     * @param \Caribbean\TourismBundle\Entity\Imagen $imagenes
     * @return Galeria
     */
    public function addImagene(\Caribbean\TourismBundle\Entity\Imagen $imagenes)
    {
        $this->imagenes[] = $imagenes;

        return $this;
    }

    /**
     * Remove imagenes
     *
     * @param \Caribbean\TourismBundle\Entity\Imagen $imagenes
     */
    public function removeImagene(\Caribbean\TourismBundle\Entity\Imagen $imagenes)
    {
        $this->imagenes->removeElement($imagenes);
    }

    /**
     * Get imagenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImagenes()
    {
        return $this->imagenes;
    }

    /**
     * Set poi
     *
     * @param \Caribbean\TourismBundle\Entity\POI $poi
     * @return Galeria
     */
    public function setPoi(\Caribbean\TourismBundle\Entity\POI $poi = null)
    {
        $this->poi = $poi;

        return $this;
    }

    /**
     * Get poi
     *
     * @return \Caribbean\TourismBundle\Entity\POI 
     */
    public function getPoi()
    {
        return $this->poi;
    }
}
