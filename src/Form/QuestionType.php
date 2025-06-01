<?php

namespace App\Form;

use App\Entity\Epreuve;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextareaType::class,
            [ 
            'label' => false,
            'required' => true,
            'attr' => [
                    'class' => 'w-full text-black  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Entrez le contenu de la question'
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
            ]]) ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
