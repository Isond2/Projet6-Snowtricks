<?php

namespace ST\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Figure
 *
 * @ORM\Table(name="figure")
 * @ORM\Entity(repositoryClass="ST\PlatformBundle\Repository\FigureRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="nom", message="Une figure existe déjà avec ce nom.")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Figure
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
    * @ORM\OneToMany(targetEntity="ST\PlatformBundle\Entity\Image", mappedBy="figure",  cascade={"persist", "remove"})
    */
    private $image;



    /**
    * @ORM\OneToMany(targetEntity="ST\PlatformBundle\Entity\Video", mappedBy="figure",  cascade={"persist", "remove"})
    */
    private $video;

     /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="figure", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="figure_id")
     */
    protected $comments;

    /**
    * @Gedmo\Slug(fields={"nom"})
    * @ORM\Column(name="slug", type="string", length=255, unique=true)
    */
    protected $slug;

    


    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->video = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Figure
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Figure
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription($length = null)
    {
        if (false === is_null($length) && $length > 0)
        return substr($this->description, 0, $length);
        else
        return $this->description;
    }

    /**
     * Set groupe
     *
     * @param string $groupe
     *
     * @return Figure
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return string
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

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
    public function getGallery()
    {
        return $this->image;
    }

    /**
     * Set gallery
     *
     * @param string $gallery
     *
     * @return Figure
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;

        return $this;
    }





    public function addImage(Image $image)
    {
        $image->setFigure($this);
        $this->image->add($image);
    }

    public function removeImage(Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImage()
    {
        return $this->image;
    }









    public function addVideo(Video $video)
    {
        $video->setFigure($this);
        $this->video->add($video);
    }

    public function removeVideo(Video $video)
    {
        $this->video->removeElement($video);
    }

    /**
     * Get video
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideo()
    {
        return $this->video;
    }












    /**
     * Add comment
     *
     * @param \ST\PlatformBundle\Entity\Comment $comment
     *
     * @return Figure
     */
    public function addComment(\ST\PlatformBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \ST\PlatformBundle\Entity\Comment $comment
     */
    public function removeComment(\ST\PlatformBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }




    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

}
