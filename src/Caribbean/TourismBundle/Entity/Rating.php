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
    private $poi;

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
        $this->poi = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add poi
     *
     * @param \Caribbean\TourismBundle\Entity\POI $poi
     * @return Rating
     */
    public function addPoi(\Caribbean\TourismBundle\Entity\POI $poi)
    {
        $this->poi[] = $poi;

        return $this;
    }

    /**
     * Remove poi
     *
     * @param \Caribbean\TourismBundle\Entity\POI $poi
     */
    public function removePoi(\Caribbean\TourismBundle\Entity\POI $poi)
    {
        $this->poi->removeElement($poi);
    }

    /**
     * Get poi
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPoi()
    {
        return $this->poi;
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
