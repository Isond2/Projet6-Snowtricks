<?php

namespace ST\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="ST\PlatformBundle\Repository\VideoRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */

class Video
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
     * @var string
     *
     * @ORM\Column(name="url",type="string")
     */
    protected $url;

    /**
     *   
     * @ORM\ManyToOne(targetEntity="ST\PlatformBundle\Entity\Figure", inversedBy="video")
     * @ORM\JoinColumn(name="figure_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $figure;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $supp;




    public function __construct()
    {
        $this->setSupp(false);
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



    /**
     * Set url
     *
     * @param string $url
     *
     * @return Video
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

        /**
     * Set supp
     *
     * @param boolean $supp
     *
     * @return Comment
     */
    public function setSupp($supp)
    {
        $this->supp = $supp;

        return $this;
    }

    /**
     * Get supp
     *
     * @return boolean
     */
    public function getSupp()
    {
        return $this->supp;
    }
}
