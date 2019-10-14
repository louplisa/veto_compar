<?php

namespace App\Form;

use App\Entity\VeterinaryClinic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VeterinaryClinicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('street_number')
            ->add('indice_street_number')
            ->add('street')
            ->add('complementary')
            ->add('zip_code')
            ->add('city')
            ->add('phone')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VeterinaryClinic::class,
        ]);
    }
}
