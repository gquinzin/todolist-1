<?php

namespace TodoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', null, array(
                'label' => 'task.form.label',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('description', null, array(
                'label' => 'task.form.description',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('dueDate', null, array(
                'label' => 'task.form.duedate',
                'data' => new \DateTime(date('Y-m-d H:i:s')),
            ))
            ->add('remindAt', null, array(
                'label' => 'task.form.remindat',
                'data' => new \DateTime(date('Y-m-d H:i:s')),
            ))
            ->add('status', null, array(
                'label' => 'task.form.status',
                'attr' => ['class' => 'form-control'],
            ))
            ->add('category', null, array(
                'attr' => ['class' => 'form-control'],
            ))
            ->add('tag', null, array(
                'attr' => ['class' => 'form-control'],
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'task.form.save',
                'attr' => ['class' => 'btn btn-default'],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TodoBundle\Entity\Task',
        ));
    }
}
