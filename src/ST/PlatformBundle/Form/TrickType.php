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
use ST\PlatformBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
* Form for trick
*/
class TrickType extends AbstractType
{


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = $builder->getForm()->getData();

        $builder->add('nom')->add('description')->add(
            'groupe',
            ChoiceType::class,
            [
                'choices'  => [
                    'Facile' => 'Facile',
                    'Moyenne' => 'Moyenne',
                    'Difficile' => 'Difficile',
                    'Extreme' => 'Extreme',
                ],
            ]
        )->add(
            'image',
            CollectionType::class,
            [
                'entry_type' => ImageType::class,
                'label' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'required'     => false,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'attr' => ['class' => 'my-selector'],
            ]
        )->add(
            'video',
            CollectionType::class,
            [
                'entry_type' => VideoType::class,
                'label' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'required'     => false,
                'delete_empty' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'attr' => ['class' => 'my-selector'],
            ]
        )->add('creer', SubmitType::class);
    }//end buildForm()


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            ['data_class' => 'ST\PlatformBundle\Entity\Trick']
        );
    }//end configureOptions()


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st_platformbundle_trick';
    }//end getBlockPrefix()
}//end class
