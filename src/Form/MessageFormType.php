<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('text', TextareaType::class)
        // <button type="button" class="btn btn-primary">Primary</button>
        // ;

        $builder
            ->add('text', TextareaType::class, [
                'attr' => ['class' => 'uk-textarea', 'rows' => 8],
                'constraints' => [
                    new NotNull([
                        'message' => 'Please enter a message',
                   ]),
                ],
            ])
            ->add('Ajouter', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ])
            ->add('Annuler', ButtonType::class, [
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
