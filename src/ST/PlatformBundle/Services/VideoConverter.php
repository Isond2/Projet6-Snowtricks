<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Services;

/** VideoConverter Class
 *
 */
class VideoConverter
{


    /**
     * Convertit les urls de vidéos en balises embed
     *
     * @param array $videos
     *
     * @return $autoEmbedVideos
     */
    public function convertVideos($videos)
    {
        $blank = '';
        foreach ($videos as $video) {
            $blank .= ' '.$video->geturl();
        }

        $video           = $blank;
        $embera          = new \Embera\Embera();
        $autoEmbedVideos = $embera->autoEmbed($video);

        return $autoEmbedVideos;
    }//end convertVideos()
}//end class
