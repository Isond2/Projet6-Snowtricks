<?php

namespace STU\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

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
  	* @ORM\OneToOne(targetEntity="ST\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
    */
    private $image;

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Figure
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}