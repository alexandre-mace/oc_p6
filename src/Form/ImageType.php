<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ImageType extends AbstractType
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', HiddenType::class)
            ->add('main', CheckboxType::class, array(
                'label'    => 'Put this image on the front ?',
                'required' => false,
                'attr' => [
                    'class' => 'uniqCheckbox'
                ]
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $image = $event->getData();
                $form = $event->getForm();

                $user = $this->tokenStorage->getToken()->getUser();
                if($image && $user !== $image->getAuthor()) {
                    $form->remove('name');
                    $form->remove('main');
                }
            })
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}