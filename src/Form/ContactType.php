<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    /**
    * Permet d'avoir la configuration de base d'un champ
    *
    * @param string $label
    * @param array $options
    * @return array
    */

    private function getConfiguration($label, $options = []) {
        return array_merge([
            'label' => $label
        ], $options);
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'lastname',
                TextType::class,
                $this->getConfiguration("Nom")
                )

            ->add(
                'compagny',
                TextType::class,
                $this->getConfiguration("Entreprise")
                )

            ->add(
                'phone',
                TelType::class,
                $this->getConfiguration("Téléphone")
                )

            ->add(
                'mail',
                EmailType::class,
                $this->getConfiguration("Email")
                )
                
            ->add(
                'message',
                TextareaType::class,[
                    'label' => 'Message',
                    'attr' => [
                        'rows' => 4,
                    ]
                ])              
                
            ->add(
                'checkmessage',
                CheckboxType::class, [
                    'label' => 'Je ne suis pas un robot !'
                ])

            ->add(
                'submit',
                SubmitType::class, [
                    'label' => 'Envoyer',
                    'attr' => [
                        'class' => 'btn-submit'
                    ]    
                ])  
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
