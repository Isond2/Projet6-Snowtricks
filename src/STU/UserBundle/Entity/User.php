<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace STU\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use ST\PlatformBundle\Entity\Avatar;

/**
 * @ORM\Table(name="st_user")
 * @ORM\Entity(repositoryClass="STU\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    protected $id;

    /**
    * @ORM\OneToOne(targetEntity="ST\PlatformBundle\Entity\Avatar", cascade={"persist", "remove"})
    */
    private $avatar;

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Figure
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
