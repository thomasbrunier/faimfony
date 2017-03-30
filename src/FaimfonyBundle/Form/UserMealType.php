<?php

namespace FaimfonyBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserMealType extends AbstractType
{

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $min = $this->manager->getRepository('FaimfonyBundle:Meal')->minPriceMeal();
        $max = $this->manager->getRepository('FaimfonyBundle:Meal')->maxPriceMeal();

        $builder
            ->add('price', RangeType::class, array('label' => 'Quel est votre budget maximum?',
                'attr' => array(
                    'min' => $min[0]->getPrice(),
                    'max' => $max[0]->getPrice(),
                )
            ))
            ->add('tags', TagsType::class, array(
                'label' => 'Quel genre de plats voulez-vous manger (Séparez les mots par des virgules) ?'
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FaimfonyBundle\Entity\Meal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'faimfonybundle_meal';
    }


}
