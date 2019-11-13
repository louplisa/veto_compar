<?php


namespace App\Form;

use App\Entity\DispenseSearch;
use App\Entity\MedicalTreatment;
use App\Entity\Pet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DispenseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pet', EntityType::class, [
                'label'=> false,
                'class'=>Pet::class,
                'required'=>true,
                'choice_label' => 'espece',
                'multiple'=>false,
            ])
            ->add('medical_treatment', EntityType::class, [
                'label'=> false,
                'class'=>MedicalTreatment::class,
                'required'=>true,
                'choice_label' => 'type',
                'multiple'=>false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DispenseSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
