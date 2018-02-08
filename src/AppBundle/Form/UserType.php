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
        ->add('username', null, array('label' => false, 'attr' => array(
        'placeholder' => 'Nom')))
        ->add('compagnyName', null, array('label' => false, 'attr' => array(
        'placeholder' => 'Raison Social')))
        ->add('email', null,array('label' => false, 'attr' => array(
        'placeholder' => 'Adresse E-mail'))) ;


        if($options['edit']==false)
        {
        $builder->add('password', null, array('label' => false, 'attr' => array(
        'placeholder' => 'mot de passe')));
        }
        else{
            $builder->add('password', null, [
                'attr'=>[
                    'placeholder'=> 'Laisser vide si inchangé',
                ]
            ]);
        }



        $builder
        ->add('numstrett', null, array('label' => false, 'attr' => array(
        'placeholder' => 'N° de rue')))
        ->add('adress', null, array('label' => false, 'attr' => array(
        'placeholder' => 'Nom de rue')))
        ->add('codepostale', null, array('label' => false, 'attr' => array(
        'placeholder' => 'code postale')))
        ->add('ville', null, array('label' => false, 'attr' => array(
        'placeholder' => 'Ville')))
        ->add('telephone',null, array('label' => false, 'attr' => array(
        'placeholder' => 'Numéro de tel.')))
        ->add('city', null, array('label' => "Sélectionnez Ville la plus proche"))
        ->add('service', null, array('label' => "Sélectionnez votre secteur d'activité" ))
        ->add('logo', FileType::class);

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
