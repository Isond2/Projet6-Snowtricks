<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="ST\PlatformBundle\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */

class Comment
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
      * @ORM\ManyToOne(targetEntity="STU\UserBundle\Entity\User")
      * @ORM\JoinColumn(nullable=false)
      */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    protected $comment;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $approved;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ST\PlatformBundle\Entity\Trick", inversedBy="comments")
     * @ORM\JoinColumn(name="trick_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $trick;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
    * Set trick , datetime and approved=true
    *
    * @param trick $trick
    */
    public function __construct(\ST\PlatformBundle\Entity\Trick $trick = null)
    {
        $this->trick = $trick;
        $this->setCreated(new \DateTime());
        $this->setApproved(true);

        return $this;
    }//end __construct()


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }//end getId()


    /**
     * Set user
     *
     * @param string $user
     *
     * @return Comment
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }//end setUser()


    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }//end getUser()


    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }//end setComment()


    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }//end getComment()


    /**
     * Set approved
     *
     * @param boolean $approved
     *
     * @return Comment
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }//end setApproved()


    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }//end getApproved()


    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }//end setCreated()


    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }//end getCreated()


    /**
     * Set trick
     *
     * @param \ST\PlatformBundle\Entity\Trick $trick
     *
     * @return Video
     */
    public function setTrick(\ST\PlatformBundle\Entity\Trick $trick = null)
    {
        $this->trick = $trick;

        return $this;
    }//end setTrick()


    /**
     * Get trick
     *
     * @return \ST\PlatformBundle\Entity\Trick
     */
    public function getTrick()
    {
        return $this->trick;
    }//end getTrick()
}//end class
