<?php

namespace FaimfonyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('is_cooker', CheckboxType::class, array(
            'label'     => 'Voulez-vous devenir un Cooker ?',
            'required'  => false
            ))
            ->add('email', null, array('label'=>'Votre e-mail:'))
            ->add('first_name', null, array('label'=>'Prénom:'))
            ->add('lastname', null, array('label'=>'Nom:'))
            ->add('phone', null, array('label'=>'Numéro de téléphone:'))
            ->remove('username');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}