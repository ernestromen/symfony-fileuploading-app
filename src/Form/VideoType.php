<?php

namespace App\Form;

use App\Entity\Video;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('video_name', TextType::class,[
                'required' => true
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'category_name',
                'placeholder' => 'Select a category', 
                'required' => true
            ])
            ->add('video_file_path', FileType::class, [
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'video/mp4',
                            'video/mkv',
                            'video/mov',
                            'video/avi',
                            'video/wmv',
                            'video/flv',
                            'video/webm',
                            'video/m4v',
                            'video/mpg',
                            'video/mpeg',
                            'video/3gp',
                            'video/3g2',
                            'video/m2ts',
                            'video/mts',
                    ],
                    'mimeTypesMessage' => 'Please upload a valid video file.',
                ])
                ]     
            ])
            ->add('submit',SubmitType::class, ['label' => 'Add Video'])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Video::class,
        ));
    }
}