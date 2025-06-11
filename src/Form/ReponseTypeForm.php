<?php

namespace App\Form;

use App\Entity\Copie;
use App\Entity\Question;
use App\Entity\Reponse;
use Doctrine\ORM\EntityRepository;
use Dom\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReponseTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $epreuve = $options['epreuve'];

        $builder
            ->add('question', EntityType::class, [
                'class' => Question::class,
                'choice_label' => 'contenu',
                'query_builder'=> function(EntityRepository $entityRepository) use ($epreuve){
                    return $entityRepository->createQueryBuilder('q')
                    ->where('q.epreuve = :epreuve')
                    ->setParameter('epreuve', $epreuve);
                },
                'placeholder' => "Choisir la question"
            ])
            ->add('contenu', TextareaType::class)
            ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
            'epreuve'=>null,
        ]);
    }
}
