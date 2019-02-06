<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 10.09.2018
 * Time: 10:40
 */

namespace App\Admin;


use App\Entity\PageBlock;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PageBlockAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Общее')
            ->add('name', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('type', ChoiceFieldMaskType::class, [
                'choices' => [
                    'HTML разметка' => 'html',
                    'Форма' => 'form',
                    'Слайдер' => 'slider',
                    'Фотогалерея' => 'gallery',
                    'Изображение' => 'image'
                ],
                'map' => [
                    'html' => ['body'],
                    'form' => ['form'],
                    'slider' => ['gallery'],
                    'gallery' => ['gallery'],
                    'image' => ['media'],
                ],
                'label' => 'Тип блока'
            ])
            ->add('body', CKEditorType::class, [
                'label' => 'Содержимое'
            ])
            ->add('gallery', ModelListType::class, [
                'label' => 'Изображения',
                'required' => false
            ], [
                'link_parameters' => [
                    'context' => 'blocks'
                ]
            ])
            ->add('media', MediaType::class, [
                'provider' => 'sonata.media.provider.image',
                'context' => 'default',
                'label' => 'Изображение',
                'required' => false
            ]);
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
        return $object instanceof PageBlock
            ? $object->getName()
            : 'Блок'; // shown in the breadcrumb on the create view
    }
}
