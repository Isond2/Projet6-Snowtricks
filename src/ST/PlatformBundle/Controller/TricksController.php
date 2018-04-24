<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Controller;

use ST\PlatformBundle\Entity\Trick;
use ST\PlatformBundle\Entity\Comment;
use ST\PlatformBundle\Entity\Video;
use ST\PlatformBundle\Entity\Image;
use ST\PlatformBundle\Form\CommentType;
use ST\PlatformBundle\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\RequestContext;

/**
 * Tricks Controller
 */
class TricksController extends Controller
{


     /**
      * Show a trick
      *
      * @param request $request
      * @param slug    $slug
      *
      * @return $this
      */
    public function showAction(Request $request, $slug)
    {
        $em     = $this->getDoctrine()->getManager();
        $trick  = $em->getRepository('STPlatformBundle:Trick')->findOneBy(['slug' => $slug]);
        $videos = $em->getRepository('STPlatformBundle:Video')->findBy(['trick' => $trick]);
        $img    = $em->getRepository('STPlatformBundle:Image')->findBy(['trick' => $trick]);

        if (!$trick) {
            throw $this->createNotFoundException('yayee');
        }

        $videoConverter = $this->container->get('st_platform.videoConverter');
        $videoEmbed     = $videoConverter->convertVideos($videos);

        $comments = $em->getRepository('STPlatformBundle:Comment')->getCommentsForTrick($trick->getId());

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $comment = new Comment($trick);
        $comment->setUser($user);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('st_platform_trick', ['slug' => $trick->getSlug()]);
        }

        /*
         * @var $paginator \knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($comments, $request->query->getInt('page', 1), 10);

        return $this->render(
            'STPlatformBundle:Trick:show.html.twig',
            [
                'image' => $img,
                'videos'  => $videoEmbed,
                'trick'      => $trick,
                'form' => $form->createView(),
                'comments'  => $comments,
                'pagination' => $pagination,
            ]
        );
    }//end showAction()


    /**
     * Add a trick
     *
     * @param request $request
     *
     * @return $this
     */
    public function addAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $trick = new Trick();

            $form = $this->createForm(TrickType::class, $trick);

            if ($request->isMethod('POST')) {
                $form->handleRequest($request);

                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $trick->setSlug(null);
                    $em->persist($trick);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('notice', 'Votre figure as bien été ajoutée');

                    return $this->redirectToRoute('st_platform_homepage');
                }
                $request->getSession()->getFlashBag()->add('notice', 'Une erreur est survenue.');
            }

            return $this->render(
                'STPlatformBundle:Trick:form_add.html.twig',
                [
                    'form' => $form->createView(),
                    'trick'      => $trick,
                ]
            );
        }//end if

        $request->getSession()->getFlashBag()
        ->add('Utilisateur_annonyme', 'Vous devez vous connecter pour pouvoir ajouter une figure.');
        throw new AccessDeniedException();
    }//end addAction()


    /**
     * Edit a trick
     *
     * @param request $request
     * @param id      $id
     *
     * @return $this
     */
    public function editAction(Request $request, $id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();

            $trick = $em->getRepository('STPlatformBundle:Trick')->find($id);
            $vids  = $em->getRepository('STPlatformBundle:Video')->findBy(['trick' => $trick]);
            $img   = $em->getRepository('STPlatformBundle:Image')->findBy(['trick' => $trick]);

            if (!$trick) {
                throw $this->createNotFoundException('La figure n\'existe pas.');
            }

            $editMedia = $this->container->get('st_platform.EditMedia');
            $originalVideo = $editMedia->getVideoArray($trick);
            $originalImage = $editMedia->getImageArray($trick);

            $form = $this->createForm(TrickType::class, $trick);

            if ($request->isMethod('POST')) {
                $form->handleRequest($request);

                if ($form->isValid()) {
                    foreach ($originalVideo as $video) {
                        if (false === $trick->getVideo()->contains($video)) {
                            $video->getTrick()->removeVideo($video);
                            $em->remove($video);
                        }
                    }

                    foreach ($originalImage as $image) {
                        if (false === $trick->getImage()->contains($image)) {
                            $image->getTrick()->removeImage($image);
                            $em->remove($image);
                        }
                    }

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($trick);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('notice', 'La figure as bien été mise a jour.');

                    return $this->redirectToRoute('st_platform_homepage', ['id' => $trick->getId()]);
                }//end if
            }//end if

            return $this->render(
                'STPlatformBundle:Trick:form.html.twig',
                [
                    'form' => $form->createView(),
                    'image' => $img,
                    'video' => $vids,
                    'trick' => $trick,
                ]
            );
        }//end if

        $request->getSession()->getFlashBag()
        ->add('Utilisateur_annonyme', 'Vous devez vous connecter pour pouvoir modifier une figure.');
        throw new AccessDeniedException();
    }//end editAction()


    /**
     * Delete Form generation.
     *
     * @Route("/supp/{id}", name="trick_delete")
     *
     * @Method("POST")
     *
     * @param request $request
     * @param id      $id
     *
     * @return $this
     */
    public function suppAction(Request $request, $id)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $em = $this->getDoctrine()->getManager();

            $trick = $em->getRepository('STPlatformBundle:Trick')->find($id);

            if (null === $trick) {
                throw new NotFoundHttpException(sprintf("La figure d'id %s n'existe pas.", $id));
            }

            $form = $this->get('form.factory')->create();

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $em->remove($trick);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'La figure a bien été supprimée.');

                return $this->redirectToRoute('st_platform_homepage');
            }

            return $this->render(
                'STPlatformBundle:Trick:supp.html.twig',
                [
                    'trick' => $trick,
                    'form'   => $form->createView(),
                ]
            );
        }//end if

        $request->getSession()->getFlashBag()
        ->add('Utilisateur_annonyme', 'Vous devez vous connecter pour pouvoir supprimer une figure.');
        throw new AccessDeniedException();
    }//end suppAction()


    /**
     * Delete form
     *
     * @param id $id
     *
     * @return $this
     */
    private function createDeleteForma($id)
    {
        return $this->createFormBuilder(['id' => $id])->add('id')->getForm();
    }//end createDeleteForma()
}//end class
