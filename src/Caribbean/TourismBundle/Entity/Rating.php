<?php

namespace Caribbean\TourismBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="r_poi_usuario")
 * @ORM\Entity
 */
class Rating
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
     * @var \Caribbean\TourismBundle\Entity\POI
     *
     * @ORM\OneToMany(targetEntity="Caribbean\TourismBundle\Entity\POI", mappedBy="rating")
     */
    private $pois;

    /**
     * @var \Caribbean\SecurityBundle\Entity\Usuario
     *
     * @ORM\OneToMany(targetEntity="Caribbean\SecurityBundle\Entity\Usuario", mappedBy="rating")
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="decimal")
     */
    private $rating;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pois = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set rating
     *
     * @param string $rating
     * @return Rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Add pois
     *
     * @param \Caribbean\TourismBundle\Entity\POI $pois
     * @return Rating
     */
    public function addPois(\Caribbean\TourismBundle\Entity\POI $pois)
    {
        $this->pois[] = $pois;

        return $this;
    }

    /**
     * Remove pois
     *
     * @param \Caribbean\TourismBundle\Entity\POI $pois
     */
    public function removePois(\Caribbean\TourismBundle\Entity\POI $pois)
    {
        $this->pois->removeElement($pois);
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

    /**
     * Add usuario
     *
     * @param \Caribbean\SecurityBundle\Entity\Usuario $usuario
     * @return Rating
     */
    public function addUsuario(\Caribbean\SecurityBundle\Entity\Usuario $usuario)
    {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \Caribbean\SecurityBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\Caribbean\SecurityBundle\Entity\Usuario $usuario)
    {
        $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
