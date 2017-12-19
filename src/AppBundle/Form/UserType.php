<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
        /**
         * {@inheritdoc}
         */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username')
        ->add('logo', FileType::class)
        ->add('compagnyName');


        if($options['edit']==false)
        {
        $builder->add('password');
        }
        else{
            $builder->add('password', null, [
                'attr'=>[
                    'placeholder'=> 'Laisser vide si inchangé',
                ]
            ]);
        }



        $builder->add('email')
        ->add('numstrett')
        ->add('adress')
        ->add('codepostale')
        ->add('ville')
        ->add('telephone')
        ->add('city')
        ->add('service');

    }

        /**
         * {@inheritdoc}
         */

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'attr' =>['novalidate' => 'novalidate'],
            'edit'=> false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }
}
