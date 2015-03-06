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
}
