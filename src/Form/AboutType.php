<?php

namespace App\Form;

use App\Entity\About;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AboutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('presentation', CKEditorType::class)
            ->add('cursus', CKEditorType::class)
            ->add('problematique', CKEditorType::class)
            ->add('conclusion', CKEditorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => About::class,
            'translation_domain' => 'forms'
        ]);
    }
}
