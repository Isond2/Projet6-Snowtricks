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
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
* Video Form
*/
class VideoType extends AbstractType
{

    /**
    * Build Form
    * @param builder $builder
    * @param options $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'url',
            TextType::class,
            ['label' => 'Url de la vidéo :']
        );
    }//end buildForm()

    /**
    * Configure Options
    *
    * @param resolver $resolver
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'ST\PlatformBundle\Entity\Video']
        );
    }//end configureOptions()

    /**
    * Get Block Prefix
    *
    * @return st_platformbundle_video
    */
    public function getBlockPrefix()
    {
        return 'st_platformbundle_video';
    }//end getBlockPrefix()
}//end class
