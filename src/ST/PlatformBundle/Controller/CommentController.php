<?php

namespace ST\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ST\PlatformBundle\Entity\Thread;
use ST\PlatformBundle\Entity\Comment;
use ST\PlatformBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $IDFigure = $em->getRepository('STPlatformBundle:Figure')->find($id);
        
        $User = $this->getUser();
        $Username = $User->getUsername();


        $Comment = new Comment();

        $form = $this->createForm(CommentType::class, $Comment);
        
        $Comment->setUser($Username);
        $Comment->setFigure($IDFigure);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {

        $em = $this->getDoctrine()->getManager();
        $em->persist($Comment);
        $em->flush();



        return $this->redirectToRoute('st_platform_figure', array('id' => $IDFigure->getId()));
        }
                                

        return $this->render('STPlatformBundle:Comment:form.html.twig', array(
        'form' => $form->createView(),
        'comment' => $Comment,
        'id' => $IDFigure,
        ));


    
    }
}










//$Comment->setComment($this->encodePassword($Comment, $data['comment']));


/*

    public function createAction(Request $request, $id)
    {
        
        $User = $this->getUser();
        $Username = $User->getUsername();


        $Comment = new Comment();

        $Comment->setUser($Username);
        $Comment->setFigure($id);
        $Comment->setComment('Mais omg');
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $Comment);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      
      ->add('addComment',      SubmitType::class);
   
    $form = $formBuilder->getForm();

     // Si la requête est en POST
    if ($request->isMethod('POST')) {
      // On fait le lien Requête <-> Formulaire
      // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
      $form->handleRequest($request);

      // On vérifie que les valeurs entrées sont correctes
      // (Nous verrons la validation des objets en détail dans le prochain chapitre)
      
        // On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($Comment);
        $em->flush();

        // On redirige vers la page de visualisation de l'annonce nouvellement créée
        return $this->redirectToRoute('st_platform_figure', array('id' => $figure->getid()));
        
                            
                        }
        return $this->render('STPlatformBundle:Comment:form.html.twig', array(
        'form' => $form->createView(),
        ));

    }
}

*/