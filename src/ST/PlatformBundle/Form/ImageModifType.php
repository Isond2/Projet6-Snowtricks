<?php
namespace ST\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ImageModifType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('file', FileType::class, array('label'=>'Image :'))
      ->add('supp', CheckboxType::class, array(
                'label'    => 'Cochez pour supprimer l\'image',
                'required' => false,
            ));
    ;
  }

   public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'ST\PlatformBundle\Entity\Image'
    ));
  }
}