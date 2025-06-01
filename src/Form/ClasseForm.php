<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('nom', TextType::class,[ 
            'label'=>"Nom:", 
            'required' => true,
            'attr' => [
                    'class' => 'w-full text-black  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Entrez le nom de la classe'
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
        ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
