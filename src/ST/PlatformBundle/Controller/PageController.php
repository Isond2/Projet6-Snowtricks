<?php

namespace ST\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()
                   ->getManager();

        $figure = $em->createQueryBuilder()
                    ->select('b')
                    ->from('STPlatformBundle:Figure',  'b')
                    ->addOrderBy('b.id', 'DESC')
                    ->getQuery()
                    ->getResult();

        return $this->render('STPlatformBundle:Page:index.html.twig', array(
            'figure' => $figure));
    }
}

?>