<?php

namespace ST\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ST\PlatformBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FigureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = $builder->getForm()->getData();

        $builder->add('nom')
        ->add('description')
        ->add('groupe', ChoiceType::class, array(
            'choices'  => array(
            'Facile' => 'Facile',
            'Moyenne' => 'Moyenne',
            'Difficile' => 'Difficile',
            'Extreme' => 'Extreme')))

        ->add('image', CollectionType::class, array(
            'entry_type' => ImageType::class,'label' => false,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'required'     => false,
            'delete_empty' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'attr' => array(
            'class' => 'my-selector',

        ),
        ))

        

        ->add('video', CollectionType::class, array(
            'entry_type' => VideoType::class, 'label' => false,
            'entry_options' => array('label' => false),
            'allow_add' => true,
            'required'     => false,
            'delete_empty' => true,
            'by_reference' => false,
            'allow_delete' => true,
            'attr' => array(
            'class' => 'my-selector',
        ),
        ))

        ->add('creer', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ST\PlatformBundle\Entity\Figure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'st_platformbundle_figure';
    }


}
