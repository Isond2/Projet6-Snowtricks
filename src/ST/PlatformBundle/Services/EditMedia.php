<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Services;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

/**
* Allows the edit form to work correctly
*/
class EditMedia
{

    /**
     * Allows the videos of the edit form to udate correctly
     *
     * @param string $trick
     *
     * @return $originalVideo
     */
    public function getVideoArray($trick)
    {
            $originalVideo = new ArrayCollection();
        foreach ($trick->getVideo() as $video) {
            $originalVideo->add($video);
        }

        return $originalVideo;
    }//end getVideoArray()

    /**
     * Allows the images of the edit form to udate correctly
     *
     * @param string $trick
     *
     * @return $originalImage
     */
    public function getImageArray($trick)
    {
            $originalImage = new ArrayCollection();
        foreach ($trick->getImage() as $image) {
            $originalImage->add($image);
        }

        return $originalImage;
    }//end getImageArray()
}//end class
