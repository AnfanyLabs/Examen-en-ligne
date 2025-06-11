<?php

namespace App\Form;

use App\Entity\Reponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseCorrectionTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextareaType::class, [
                'data'       => $options['question']->getContenu(),
                'mapped'     => false,
                'disabled'   => true,
                'label'      => 'Question',
            ])
            // Réponse de l’élève affichée
            ->add('contenu', TextareaType::class, [
                'mapped'   => false,
                'data'     => $options['reponse']->getContenu(),
                'disabled' => true,
                'label'    => 'Réponse de l’élève',
            ])
            // Champ pour la note
            ->add('points', IntegerType::class, [
                'label' => 'Points attribués',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => Reponse::class,
            // on exige de recevoir l’objet question en option
            'question'   => null,
            'reponse'    => null,
        ]);
    }
}
