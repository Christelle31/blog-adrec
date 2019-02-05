<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextareaType::class, [
                'label' => 'article.form.title.label',
            ])
            ->add('body', null, [
                'label' => 'article.form.body.label',
            ])
            ->add('author', EntityType::class, [
                'expanded' => true,
                'class' => User::class,
                'label' => 'article.form.author.label',
            ])
//            ->add('categories')
            ->add('submit', SubmitType::class, [
                'label' => 'article.form.submit.label',
            ])
            ->add('submitAndRestart', SubmitType::class, [
                'label' => 'article.form.submitAndRestart.label',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
