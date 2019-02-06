<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 07.09.2018
 * Time: 11:00
 */

namespace App\Admin;


use App\Entity\Setting;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OptionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('value', TextType::class, [
                'label' => 'Значение'
            ]);

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('value');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name', null, [
            'label' => 'Название'
        ]);
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }

    public function toString($object)
    {
        return $object instanceof Setting
            ? $object->getName()
            : 'Параметр'; // shown in the breadcrumb on the create view
    }

}
