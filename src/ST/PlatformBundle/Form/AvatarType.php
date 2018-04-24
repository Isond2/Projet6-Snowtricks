<?php

/*
 * This file is part of the Snowtricks community website.
 *
 * GOMEZ José-Adrian j.gomez17@hotmail.fr
 *
 */

namespace ST\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Comur\ImageBundle\Form\Type\CroppableImageType;

/**
* Form for user avatar
*/
class AvatarType extends AbstractType
{

    /**
    * Build Form
    *
    * @param builder $builder
    * @param options $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', FileType::class, ['label' => 'Avatar :']);
    }//end buildForm()

    /**
    * Build Configure Options
    *
    * @param resolver $resolver
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'ST\PlatformBundle\Entity\Avatar']
        );
    }//end configureOptions()
}//end class
