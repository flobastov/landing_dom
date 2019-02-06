<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 10.09.2018
 * Time: 12:00
 */

namespace App\Admin;


use App\Entity\FormField;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormFieldAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Общее')
            ->add('name', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('required', CheckboxType::class, [
                'label' => 'Обязательное',
                'required' => false
            ])
            ->add('type', ChoiceFieldMaskType::class, [
                'choices' => [
                    'Короткий текст' => 'text',
                    'Длинный текст' => 'textarea',
                    'Галочка' => 'checkbox',
                    'Одиночный выбор' => 'select',
                    'Radio-кнопка' => 'radio',
                    'Кнопка' => 'submit'
                ],
                'map' => [
                    'text' => ['placeholder', 'meta'],
                    'textarea' => ['placeholder', 'meta'],
                    'checkbox' => ['placeholder', 'checkbox', 'meta'],
                    'select' => ['placeholder', 'sel', 'meta'],
                    'radio' => ['placeholder', 'radio', 'meta'],
                    'submit' => ['button', 'meta'],
                ],
                'label' => 'Тип поля'
            ])
            ->add('placeholder', TextType::class, [
                'label' => 'Заголовок',
                'required' => false
            ])
            ->add('sel', TextareaType::class, [
                'label' => 'Варианты разделенные вертикальной чертой |',
                'required' => false
            ])
            ->add('radio', TextareaType::class, [
                'label' => 'Варианты разделенные вертикальной чертой |',
                'required' => false
            ])
            ->add('checkbox', TextType::class, [
                'label' => 'Подпись',
                'required' => false
            ])
            ->add('button', TextType::class, [
                'label' => 'Кнопка',
                'required' => false,
            ])
            ->add('meta', TextareaType::class, [
                'label' => 'Дополнительно',
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
        return $object instanceof FormField
            ? $object->getName()
            : 'Поле'; // shown in the breadcrumb on the create view
    }
}
