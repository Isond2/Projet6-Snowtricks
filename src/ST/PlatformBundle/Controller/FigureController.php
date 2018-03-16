<?php

namespace ST\PlatformBundle\Controller;

use ST\PlatformBundle\Entity\Figure;
use ST\PlatformBundle\Entity\Comment;
use ST\PlatformBundle\Entity\Video;
use ST\PlatformBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ST\PlatformBundle\Form\FigureType;
use ST\PlatformBundle\Form\FigureModifType;
use ST\PlatformBundle\Form\FigureNewModifType;
use ST\PlatformBundle\Entity\Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;

class FigureController extends Controller
{
   
    public function showAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $Figure = $em->getRepository('STPlatformBundle:Figure')->findOneBy(array('slug' => $slug));
        $vids = $em->getRepository('STPlatformBundle:Video')->findBy(array('figure' => $Figure));
        $img = $em->getRepository('STPlatformBundle:Image')->findBy(array('figure' => $Figure));

        if (!$Figure) {
            throw $this->createNotFoundException('yayee');
        }


        $url_des_videos = '';
        foreach ($vids as $video) {
        $url_des_videos .=' '.$video->geturl();
        }
        


        $video = $url_des_videos;
        $embera = new \Embera\Embera();
        $iframe_video = $embera->autoEmbed($video);
        $id = $Figure->getId();

       
        $comments = $em->getRepository('STPlatformBundle:Comment')
                   ->getCommentsForFigure($Figure->getId());


        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        
        $comment = new Comment($Figure);
        $comment->setUser($user);
        $Figure->addComment($comment);

        $form = $this->createForm(CommentType::class, $comment);

        $form1 = $this->createFormBuilder()    
        ->add('aie', SubmitType::class
          )
        ->getForm();
        ;

      

        if ($form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($Figure);
          $em->flush();

        }

        if ($form1->get('aie')->isClicked()) {
         return $this->redirectToRoute('st_platform_homepage');

        }


     
          /**
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($comments,$request->query->getInt('page',1),10);
       


          
          

    
    
            
           

        return $this->render('STPlatformBundle:Figure:show.html.twig', array(
          'form1' => $form1->createView(),
            'image' => $img,
            'video' => $vids,
            'videaaao'  => $iframe_video,
            'Figure'      => $Figure,
            'form' => $form->createView(),
            'comments'  => $comments,
            'pagination' => $pagination,
            'id'        => $id,
            
        ));
        }
    






    public function addAction(Request $request)
    {

     $securityContext = $this->container->get('security.authorization_checker');
      if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) 
        {

    $Figure = new Figure();
  
    $form = $this->createForm(FigureType::class, $Figure);

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {

        $em = $this->getDoctrine()->getManager();
        $Figure->setSlug(null);
        $em->persist($Figure);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Votre figure as bien été ajoutée');

        return $this->redirectToRoute('st_platform_homepage');
      }

      else
      {
        $request->getSession()->getFlashBag()->add('notice', 'Une erreur est survenue.');
      }
    }

    return $this->render('STPlatformBundle:Figure:form_add.html.twig', array(
      'form' => $form->createView(),
      'Figure'      => $Figure,
    ));
    }

    $request->getSession()
        ->getFlashBag()
        ->add('Utilisateur_annonyme', 'Vous devez vous connecter pour pouvoir ajouter une figure.');
      throw new AccessDeniedException();

    }







    public function modifAction(Request $request, $id)
    {

      $securityContext = $this->container->get('security.authorization_checker');
      if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) 
        {

         $em = $this->getDoctrine()->getManager();

        $Figure = $em->getRepository('STPlatformBundle:Figure')->find($id);
        $vids = $em->getRepository('STPlatformBundle:Video')->findBy(array('figure' => $Figure));
        $img = $em->getRepository('STPlatformBundle:Image')->findBy(array('figure' => $Figure));


        if (!$Figure) 
          {
            throw $this->createNotFoundException('La figure n\'existe pas.');
          }

          $originalVideo = new ArrayCollection();
          foreach ($Figure->getVideo() as $video) {
              $originalVideo->add($video);
          }

          $originalImage = new ArrayCollection();
          foreach ($Figure->getImage() as $image) {
              $originalImage->add($image);
          }


    $form = $this->createForm(FigureType::class, $Figure);

    if ($request->isMethod('POST')) {

      $form->handleRequest($request);

      if ($form->isValid()) {
         foreach ($originalVideo as $video) {
            if (false === $Figure->getVideo ()->contains($video)) {
                $video->getFigure()->removeVideo($video);
                $em->remove($video);
              }
            }

          foreach ($originalImage as $image) {
            if (false === $Figure->getImage ()->contains($image)) {
                $image->getFigure()->removeImage($image);
                $em->remove($image);
              }
            }

        $em = $this->getDoctrine()->getManager();
        $em->persist($Figure);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'La figure as bien été mise a jour.');
        return $this->redirectToRoute('st_platform_homepage', array('id' => $Figure->getId()));
      }
    }

    return $this->render('STPlatformBundle:Figure:form.html.twig', array(
      'form' => $form->createView(),
      'image' => $img,
      'video' => $vids,
      'Figure' => $Figure,
    ));
    }

    $request->getSession()
        ->getFlashBag()
        ->add('Utilisateur_annonyme', 'Vous devez vous connecter pour pouvoir modifier une figure.');
      throw new AccessDeniedException();

    }


/**
     * Delete Form generation.
     *
     * @Route("/supp/{id}", name="figure_delete")
     * @Method("POST")
     */
  public function suppAction(Request $request, $id)
  {
    $securityContext = $this->container->get('security.authorization_checker');
      if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) 
        {
    $em = $this->getDoctrine()->getManager();

    $figure = $em->getRepository('STPlatformBundle:Figure')->find($id);

    if (null === $figure) {
      throw new NotFoundHttpException("La figure d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($figure);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', "La figure a bien été supprimée.");

      return $this->redirectToRoute('st_platform_homepage');
    }
    
    return $this->render('STPlatformBundle:Figure:supp.html.twig', array(
      'figure' => $figure,
      'form'   => $form->createView(),
    ));
 
    




    }

    $request->getSession()
        ->getFlashBag()
        ->add('Utilisateur_annonyme', 'Vous devez vous connecter pour pouvoir supprimer une figure.');
      throw new AccessDeniedException();


} 

    private function createDeleteForma($id)
    {
        return $this->createFormBuilder(array('id' => $id))
                    ->add('id')
                    ->getForm();
    }



}