<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password',PasswordType::class)
            ->add('nom')
            ->add('prenom')
            ->add('pays')
            ->add('ville')
            ->add('Gender',ChoiceType::class, [
                'choices'  => [
                    'Male' => 'Male' ,
                    'Female' => 'Female',
                    ]]
            )
            ->add('Etude')
            ->add('AboutMe')
            ->add('MF')
            ->add('dateNaissance')
            ->add('Role', EntityType::class,
                [
                    'class'=>Role::class,
                    'choice_label'=>'name'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
