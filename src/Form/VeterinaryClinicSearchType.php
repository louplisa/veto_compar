<?php


namespace App\Form;


use App\Entity\VeterinaryClinicSearch;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VeterinaryClinicSearchType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('zipCode', TextType::class, [
            'required'=> false,
            'label'=> false,
            'attr'=> [
                'placeholder'=> 'Code postal'
            ]
        ])
        ->add('city', TextType::class, [
            'required'=> false,
            'label'=> false,
            'attr'=> [
                'placeholder'=> 'Ville'
            ]
        ]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VeterinaryClinicSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
