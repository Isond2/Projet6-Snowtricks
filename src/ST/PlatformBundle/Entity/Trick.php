<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trick
 *
 * @ORM\Table(name="trick")
 * @ORM\Entity(repositoryClass="ST\PlatformBundle\Repository\TrickRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @UniqueEntity(fields="nom", message="Une figure existe déjà avec ce nom.")

 */
class Trick
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Groupe", type="string", length=255)
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="ST\PlatformBundle\Entity\Image", mappedBy="trick",  cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="ST\PlatformBundle\Entity\Video", mappedBy="trick",  cascade={"persist", "remove"})
     */
    private $video;

     /**
      * @ORM\OneToMany(targetEntity="Comment", mappedBy="trick", cascade={"persist", "remove"})
      * @ORM\JoinColumn(name="trick_id")
      */
    protected $comments;

    /**
     * @Gedmo\Slug(fields={"nom"})
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;

    /**
    * Array collections
    */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->video    = new ArrayCollection();
        $this->image    = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Trick
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }//end setNom()


    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }//end getNom()


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Trick
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }//end setDescription()


    /**
     * Get description
     *
     * @param length $length
     *
     * @return string
     */
    public function getDescription($length = null)
    {
        if (false === is_null($length) && $length > 0) {
            return substr($this->description, 0, $length);
        }

            return $this->description;
    }//end getDescription()


    /**
     * Set groupe
     *
     * @param string $groupe
     *
     * @return Trick
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }//end setGroupe()


    /**
     * Get groupe
     *
     * @return string
     */
    public function getGroupe()
    {
        return $this->groupe;
    }//end getGroupe()


    /**
     * Set image
     *
     * @param string $image
     *
     * @return Trick
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }//end setImage()


    /**
     * Get image
     *
     * @return string
     */
    public function getGallery()
    {
        return $this->image;
    }//end getGallery()

    /**
    * add image
    *
    * @param image $image
    */
    public function addImage(Image $image)
    {
        $image->setTrick($this);
        $this->image->add($image);
    }//end addImage()

    /**
    * remove image
    *
    * @param image $image
    */
    public function removeImage(Image $image)
    {
        $this->image->removeElement($image);
    }//end removeImage()


    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }//end getImage()

    /**
    * add video
    *
    * @param video $video
    */
    public function addVideo(Video $video)
    {
        $video->setTrick($this);
        $this->video->add($video);
    }//end addVideo()

    /**
    * remove video
    *
    * @param video $video
    */
    public function removeVideo(Video $video)
    {
        $this->video->removeElement($video);
    }//end removeVideo()


    /**
     * Get video
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideo()
    {
        return $this->video;
    }//end getVideo()

    /**
    * add comment
    *
    * @param comment $comment
    */
    public function addComment(Comment $comment)
    {
        $this->comments->add($comment);
    }//end addComment()


    /**
     * Remove comment
     *
     * @param \ST\PlatformBundle\Entity\Comment $comment
     */
    public function removeComment(\ST\PlatformBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }//end removeComment()


    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }//end getComments()


    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }//end setSlug()


    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }//end getSlug()
}//end class
