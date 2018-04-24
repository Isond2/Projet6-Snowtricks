<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
* Form for comments
*/
class CommentType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->setMethod('POST')->add(
                'comment',
                TextareaType::class,
                ['label' => 'Votre commentaire']
            )->add(
                'save',
                SubmitType::class,
                ['label' => 'Ajouter']
            );
    }//end buildForm()


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'ST\PlatformBundle\Entity\Comment']
        );
    }//end configureOptions()


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st_platformbundle_comment';
    }//end getBlockPrefix()
}//end class
