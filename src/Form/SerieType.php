<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Serie;
use App\Repository\GenreRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('resume')
            ->add('duree', TimeType::class, array(
                'input'  => 'datetime',
                'widget' => 'choice',
            ))
            ->add('premierediffusion', DateType::class, array(
                "widget" => 'single_text',
                "format" => 'yyyy-MM-dd',
                "data" => new \DateTime()
            ))
            ->add('image')
            ->add(
                'lesGenres',
                EntityType::class,
                array(
                    'class' => Genre::class,
                    'choice_label' => 'libelle', // libelle est la propriété de l'entité Genre que l'on veut afficher
                    'multiple' => true, // permet la sélection multiple
                    'query_builder' => function (GenreRepository $gr) {
                        return $gr->genreByOrder();
                    }
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
