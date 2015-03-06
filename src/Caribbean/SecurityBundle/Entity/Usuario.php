<?php

namespace Caribbean\SecurityBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="security_fos_usuario")
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Caribbean\SecurityBundle\Entity\Grupo")
     * @ORM\JoinTable(name="security_fos_usuario_grupo",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $nombre;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Caribbean\TourismBundle\Entity\Comentario", mappedBy="usuario")
     */
    protected  $comentarios;

    /**
     * @var \Caribbean\TourismBundle\Entity\Rating
     *
     * @ORM\ManyToOne(targetEntity="Caribbean\TourismBundle\Entity\Rating", inversedBy="usuario")
     */
    protected $rating;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function isActive()
    {
        return $this->locked == false;
    }

    public function setActive($value)
    {
        $this->locked = !$value;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Add comentarios
     *
     * @param \Caribbean\TourismBundle\Entity\Comentario $comentarios
     * @return Usuario
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
     * @return Usuario
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
}
