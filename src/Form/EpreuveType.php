<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Discipline;
use App\Entity\Epreuve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpreuveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
            'required' => true,
            'label'=> "Titre:",
            'attr' => [
                    'class' => 'w-full text-black  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => "Entrez le titre de l'épreuve "
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
            ]])
            ->add('coefficient', IntegerType::class, [
            'required' => true,
            'label'=> "Coefficient:",
            'attr' => [
                    'class' => 'w-full text-black  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Ajouter un coefficient'
            ],
            'label_attr' => [
                    'class' => "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            ]])
            ->add('dateEpreuve', DateTimeType::class,  [
            'required' => true,
            'widget' => 'single_text',
            'html5' => true,
            'label'=> "Date de l'épreuve:",
            'attr' => [
                    'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
                    'placeholder' => "Choisissez une date"
                ],
            'label_attr' => [
                    'class' => "block pl-4 text-sm font-medium text-gray-900 dark:text-white"
            ]])
            ->add('dureeEpreuve', IntegerType::class, [
            'required' => true,
            'label'=>"  Durée de l'épreuve (en minutes):",
            'attr' => [
                    'class' => 'w-full text-black  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => "Entrer la durée de l'épreuve"
            ],
            'label_attr' => [
                    'class' => "block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            ]])
            ->add('discipline', EntityType::class, [
                'label' => "Discipline:",
                'class' => Discipline::class,
                'choice_label' => 'nom',
            ])
            ->add('classe', EntityType::class, [
                'label' => "Classe:",
                'class' => Classe::class,
                'choice_label' => 'nom',
            ])
            ->add('contexte', TextareaType::class, [
                'label' => "Contexte:",
                'attr' => [
                    'class' => 'w-full text-black  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => "Entrez le contexte de l'évaluation"
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
            ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Epreuve::class,
        ]);
    }
}
