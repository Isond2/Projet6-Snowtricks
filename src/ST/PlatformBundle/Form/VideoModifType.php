<?php

namespace ST\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class VideoModifType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url', TextType::class, array(
                'label' => "Url de la vidéo :",
                'disabled' => true
            ))
            ->add('supp', CheckboxType::class, array(
                'label'    => 'Cochez pour supprimer la vidéo',
                'required' => false,
            ));
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ST\PlatformBundle\Entity\Video'
        ));
    }


    public function getBlockPrefix()
    {
        return 'st_platformbundle_video';
    }


}
