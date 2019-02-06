<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 10.09.2018
 * Time: 10:40
 */

namespace App\Admin;


use App\Entity\Page;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PageAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Общее')
            ->add('title', TextType::class, [
                'label' => 'Заголовок'
            ])
            ->add('slug', TextType::class, [
                'label' => 'Символическая ссылка',
                'required' => false
            ])
            ->add('publish', CheckboxType::class, [
                'label' => 'Опубликовано',
                'required' => false
            ])
            ->add('blocks', ModelType::class, [
                'multiple' => true,
                'property' => 'name',
                'label' => 'Блоки',
                'required' => false
            ])
            ->end()
        ;

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('slug', null, [
                'label' => 'Ссылка'
            ])
            ->addIdentifier('title', null, [
                'label' => 'Заголовок'
            ])
        ;
    }

    public function toString($object)
    {
        return $object instanceof Page
            ? $object->getTitle()
            : 'Страница'; // shown in the breadcrumb on the create view
    }
}
