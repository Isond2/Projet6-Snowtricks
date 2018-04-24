<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Home Page
 */
class IndexController extends Controller
{


    /**
     * Home Page Tricks indexAction
     *
     * @return $this
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trick = $em->createQueryBuilder()->select('b')->from('STPlatformBundle:Trick', 'b')
        ->addOrderBy('b.id', 'DESC')->getQuery()->getResult();

        return $this->render(
            'STPlatformBundle:Index:index.html.twig',
            ['trick' => $trick]
        );
    }//end indexAction()
}//end class
