<?php
// src/AppBundle/Form/RegistrationType.php

namespace STU\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
* RegistrationType
*/
class RegistrationType extends AbstractType
{
    /**
    * buildForm
    *
    * @param builder $builder
    * @param options $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('avatar');
    }
    /**
    * getParent
    *
    * @return fos_user_registration
    */
    public function getParent()
    {
        return 'fos_user_registration';
    }
    /**
    * getName
    *
    * @return app_user_registration
    */
    public function getName()
    {
        return 'app_user_registration';
    }
}
