<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recipe_name', TextType::class)
            ->add('number_person', IntegerType::class)
            ->add('preparation_time', IntegerType::class)
            ->add('cooking_time', IntegerType::class)
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize'=>'16384k',
                        'maxSizeMessage'=>'Taille de fichier trop grande',
                        'mimeTypes'=>[
                            'image/jpeg',
                            'image/png',
                            'image/svg',
                        ],
                        'mimeTypesMessage'=>'Extension de fichier invalide',
                    ])
                    ],
                'attr'=>[
                    'class'=>'form-control',
                ],
                'data_class'=>null,

            ])
            
            ->add('recipe_ingredient', EntityType::class, [
                'label' => "Ingredient :",
                'class' => Ingredient::class,
                'choice_label'=> 'ingredient_name',
                'multiple' => false,
                'expanded' => true,
                'mapped' => false,
            ])
            
            ->add('recipe_step')
            // ->add('recipe_user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
