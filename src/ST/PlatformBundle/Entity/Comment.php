<?php

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
     * @ORM\ManyToOne(targetEntity="ST\PlatformBundle\Entity\Figure", inversedBy="comments")
     * @ORM\JoinColumn(name="figure_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $figure;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;



        public function __construct(\ST\PlatformBundle\Entity\Figure $figure = null)
    {
        $this->figure = $figure;        
        $this->setCreated(new \DateTime());
        $this->setApproved(true);
        return $this;
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
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

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
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

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
    }

    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

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
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }



    /**
     * Set figure
     *
     * @param \ST\PlatformBundle\Entity\Figure $figure
     *
     * @return Video
     */
    public function setFigure(\ST\PlatformBundle\Entity\Figure $figure = null)
    {
        $this->figure = $figure;

        return $this;
    }

    /**
     * Get figure
     *
     * @return \ST\PlatformBundle\Entity\Figure
     */
    public function getFigure()
    {
        return $this->figure;
    }

}

