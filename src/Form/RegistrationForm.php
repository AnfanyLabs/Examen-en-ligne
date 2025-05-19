<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,[
            'label'=>"Nom:", 
            'attr' => [
                    'class' => 'w-full text-white  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Entrez votre nom'
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
        ]])
        ->add('prenom', TextType::class, [
        'label'=>"Prénom:", 
        'attr' => [
                    'class' => 'w-full text-white  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Entrez votre prénom'
            ],
        'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
        ]])
        ->add('email', EmailType::class, [
        'label'=>"Email:", 
        'attr' => [
                    'class' => 'w-full text-white  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Entrez votre email'
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
        ]])
        ->add('password', PasswordType::class, [
            'label'=>"Mot de passe:", 
            'attr' => [
                    'class' => 'w-full text-white  focus:border-[#fff] outline-none bg-lime-[#270082] outl0ine-[#000] py-3 px-8 text-xl rounded-[50px] border-[3px] border-[#FFF]',
                    'placeholder' => 'Entrez votre mot de passe'
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
        ]])
        ->add('roles', ChoiceType::class,[
            'label'=>"", 
            'choices'=>[
                "Candidat.e"=> "ROLE_CANDIDAT",
                "Enseignant.e"=>"ROLE_ENSEIGNANT",
                "Administrateur-rice"=>"ROLE_ADMIN"
            ],
            'data' => "ROLE_CANDIDAT",
            'multiple'=>false,
            'expanded'=>true,
            'attr' => [
                    'class' => "flex items-center gap-4 checked:bg-[#7a0bc0] checked:border-[#270082] focus:ring-2 focus:ring-[#7a0bc0] transition",
            ],
            'label_attr' => [
                    'class' => "w-full text-white text-[20px] font-medium font-['Quicksand'] tracking-wide"
        ]]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
