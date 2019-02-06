<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 10.09.2018
 * Time: 11:56
 */

namespace App\Admin;


use App\Entity\Form;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Общее')
            ->add('name', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('fields', ModelType::class, [
                'multiple' => true,
                'property' => 'name',
                'label' => 'Поля',
                'required' => false
            ])
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name', null, [
                'label' => 'Имя'
            ]);
    }

    public function toString($object)
    {
        return $object instanceof Form
            ? $object->getName()
            : 'Форма'; // shown in the breadcrumb on the create view
    }
}
