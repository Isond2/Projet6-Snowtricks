<?php

namespace ST\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use ST\PlatformBundle\Form\ImageType;
use ST\PlatformBundle\Form\CommentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FigureCommentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $myEntity = $builder->getForm()->getData();

        $builder
        ->add('comments', CollectionType::class, array(
            'entry_type' => CommentType::class,'label' => false,
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
