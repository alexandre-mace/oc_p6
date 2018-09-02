<?php

// src/Form/TrickType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TrickType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('images', CollectionType::class, [
                "entry_type"    => ImageType::class,
                "allow_add"     => true,
                "allow_delete"  => true,
                "by_reference"  => false
            ])
            ->add('videos', CollectionType::class, [
                "entry_type"    => VideoType::class,
                "allow_add"     => true,
                "allow_delete"  => true,
                "by_reference"  => false
            ])
            ->add('categories', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $trick = $event->getData();
                $form = $event->getForm();

                $user = $this->tokenStorage->getToken()->getUser();
                if($trick && $user !== $trick->getAuthor()) {
                    $form->remove('name');
                    $form->remove('description');
                    $form->remove('categories');
                }
            })
            ->addEventListener(
                FormEvents::SUBMIT,
                array($this, 'onSubmit')
            )
            ->add('save', SubmitType::class)
        ;
    }
	
	public function configureOptions(OptionsResolver $resolver)
	{
	    $resolver->setDefaults(array(
	        'data_class' => Trick::class,
	    ));
	}

    public function onSubmit(FormEvent $event)
    {
        $trick = $event->getData();

        if (!$trick) {
            return;
        }

        foreach ($trick->getImages() as $value) {
            if ($value->getMain()) {
                $trick->setMainImage($value);
                $event->setData($trick);
            }
        }
    }
}