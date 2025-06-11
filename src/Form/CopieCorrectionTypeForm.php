<?php

namespace App\Form;

use App\Entity\Reponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CopieCorrectionTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Collection|Reponse[] $reponses */
        $reponses = $options['reponses'];

        $builder->add('reponses', CollectionType::class, [
            'entry_type'   => ReponseCorrectionTypeForm::class,
            'entry_options'=> function (Reponse $reponse) {
                return [
                    'label'    => false,
                    'question' => $reponse->getQuestion(),
                    'reponse'  => $reponse,
                ];
            },
            'data'         => $reponses,
            'by_reference' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'reponses' => [],
        ]);
    }
}
