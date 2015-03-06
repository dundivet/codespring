<?php

namespace Caribbean\TourismBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiqueta
 *
 * @ORM\Table(name="d_etiqueta")
 * @ORM\Entity
 */
class Etiqueta
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
     * @ORM\Column(name="nombre", type="string", length=32)
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Caribbean\TourismBundle\Entity\POI", mappedBy="etiqueta")
     */
    private $pois;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pois = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Etiqueta
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
     * Add poi
     *
     * @param \Caribbean\TourismBundle\Entity\POI $poi
     * @return Etiqueta
     */
    public function addPoi(\Caribbean\TourismBundle\Entity\POI $poi)
    {
        $this->pois[] = $poi;

        return $this;
    }

    /**
     * Remove poi
     *
     * @param \Caribbean\TourismBundle\Entity\POI $poi
     */
    public function removePoi(\Caribbean\TourismBundle\Entity\POI $poi)
    {
        $this->pois->removeElement($poi);
    }

    /**
     * Get pois
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPois()
    {
        return $this->pois;
    }
}
