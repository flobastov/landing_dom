<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 06.09.2018
 * Time: 9:20
 */

namespace App\Admin;


use App\Entity\Product;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Общее')
            ->with('Общее', [
                'class' => 'col-sm-12 col-md-6'
            ])
            ->add('type', ChoiceType::class, array(
                'label' => 'Тип',
                'expanded' => true,
                'multiple' => false,
                'choices' => array(
                    'Проект' => 'Проект',
                    'Построенный объект' => 'Объект'
                )
            ))
            ->add('name', TextType::class, [
                'label' => 'Название'
            ])
            ->add('term', TextType::class, [
                'label' => 'Срок',
                'required' => false
            ])
            ->add('price', TextType::class, [
                'label' => 'Цена',
                'required' => false
            ])
            ->add('publish', CheckboxType::class, [
                'label' => 'Опубликовано',
                'required' => false
            ])
            ->end()
            ->with('Характеристики', [
                'class' => 'col-sm-12 col-md-6'
            ])
            ->add('square', TextType::class, [
                'label' => 'Площадь'
            ])
            ->add('floors', TextType::class, [
                'label' => 'Этажность'
            ])
            ->add('dimensions', TextType::class, [
                'label' => 'Габариты'
            ])
            ->add('equipment', TextType::class, [
                'label' => 'Комплектация'
            ])
            ->add('foundation', TextType::class, [
                'label' => 'Фундамент'
            ])
            ->add('overlap', TextType::class, [
                'label' => 'Перекрытия'
            ])
            ->add('roof', TextType::class, [
                'label' => 'Кровля',
                'required' => false
            ])
            ->end()
            ->add('media', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context' => 'products',
                'label' => 'Изображение',
            ])
            ->end()
            ->end()
            ->tab('Медиа')
            ->with('Дополнительные изображения')
            ->add('gallery', ModelListType::class, [
                'label' => 'Изображения',
                'required' => false
            ], [
                'link_parameters' => [
                    'context' => 'products'
                ]
            ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, [
                'label' => 'Название'
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name', null, [
                'label' => 'Название проекта'
            ])
            ->add('type', null, [
                'label' => 'Тип'
            ])
            ->add('publish', null, [
                'label' => 'Опубликовано',
                'editable' => true
            ])
            ->add('media', 'string', [
                'template' => '@SonataMedia/MediaAdmin/list_image.html.twig',
                'label' => 'Изображение'
            ])
            ->add('createdAt', null, [
                'label' => 'Создано'
            ]);
    }

    public function toString($object)
    {
        return $object instanceof Product
            ? $object->getName()
            : 'Проект'; // shown in the breadcrumb on the create view
    }
}
