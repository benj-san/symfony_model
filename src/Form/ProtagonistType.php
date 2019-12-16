<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\EventRegistration;
use App\Entity\Protagonist;
use App\Entity\Tag;
use App\Repository\EventRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProtagonistType
 * @package App\Form
 */
class ProtagonistType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Protagonist name *'],
                'label' => false
            ])
            ->add('japaneseName', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Protagonist japanese name'],
                'label' => false
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['placeholder' => 'Protagonist Description*'],
                'label' => false
            ])
            ->add('picture', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Protagonist pic'],
                'label' => false,
                'help' => 'png format, 400/400'
            ])
            ->add('background', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Protagonist pic'],
                'label' => false,
                'help' => 'jpg format'
            ])
            ->add('isAlive', CheckboxType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => false
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
            ])
            ->add('eventRegistrations', CollectionType::class, [
                'entry_type' => EventRegistrationType::class
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Protagonist::class,
        ]);
    }
}
