<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="st_image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{

    /**
     *
     * @ORM\ManyToOne(targetEntity="ST\PlatformBundle\Entity\Trick", inversedBy="image")
     * @ORM\JoinColumn(name="trick_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $trick;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var UploadedFile
     */
    private $file;

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;



    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {

        if (null === $this->file) {
            return;
        }


        $this->url = $this->file->guessExtension();

        $this->alt = $this->file->getClientOriginalName();
    }//end preUpload()


    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {

        if (null === $this->file) {
            return;
        }


        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }


        $this->file->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->url
        );
    }//end upload()


    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {

        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }//end preRemoveUpload()


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {

        if (file_exists($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }//end removeUpload()

    /**
    * getUploadDir
    *
    * @return uploads/img
    */
    public function getUploadDir()
    {
        return 'uploads/img';
    }//end getUploadDir()

    /**
    * getWebPath
    *
    * @return $this
    */
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }//end getWebPath()


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }//end getId()


    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }//end setUrl()


    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }//end getUrl()


    /**
     * @param string $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }//end setAlt()


    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }//end getAlt()


    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }//end getFile()


    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->url) {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFilename = $this->url;
            // On réinitialise les valeurs des attributs url et alt
            $this->url = null;
            $this->alt = null;
        }
    }//end setFile()


      /**
       * Set trick
       *
       * @param \ST\PlatformBundle\Entity\Trick $trick
       *
       * @return Image
       */
    public function setTrick(\ST\PlatformBundle\Entity\Trick $trick = null)
    {
        $this->trick = $trick;

        return $this;
    }//end setTrick()


    /**
     * Get trick
     *
     * @return \ST\PlatformBundle\Entity\trick
     */
    public function getTrick()
    {
        return $this->trick;
    }//end getTrick()

    /**
    * getUploadRootDir
    *
    * @return __DIR__
    */
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }//end getUploadRootDir()
}//end class
