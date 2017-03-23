<?php

namespace FaimfonyBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',TextType::class, array('label'=>'Nom du restaurant'))
            ->add('address',TextType::class, array('label'=>'Adresse'));
            //->add('timetable',TimeType::class, array('label'=>'Horaires'))
        $dayArray = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi','dimanche'];
                foreach ($dayArray as $day) {
                    $builder->add($day.'-ouverture',TimeType::class, array(
                        'mapped' => false,
                    ));
                    $builder->add($day.'-fermeture',TimeType::class, array(
                        'mapped'=>false,
                    ));
                }
            $builder->add('phone',NumberType::class, array('label'=>'Numéro de téléphone'));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FaimfonyBundle\Entity\Restaurant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faimfonybundle_restaurant';
    }


}
