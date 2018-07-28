<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('file', FileType::class, [
            'label' => 'Image',
            'data_class' => null,
            'attr' => [
                'class' => 'uploadImg'
            ]
        ])
        ->add('main', CheckboxType::class, array(
            'label'    => 'Put this image on the front ?',
            'required' => false,
            'attr' => [
                'class' => 'uniqCheckbox'
            ]
        ));

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}