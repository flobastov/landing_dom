<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 27.09.2018
 * Time: 9:15
 */

namespace App\Admin;

use App\Entity\FormDataRequest;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class FormDataRequestAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id', null, [
                'label' => '№ заявки',
            ])
            ->add('created_at', null, [
                'label' => 'Создано',
            ]);
    }
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->with('Форма')
            ->add('raw', 'string', [
                'template' => 'bundles/SonataAdminBundle/jsonTable.html.twig',
                'label' => 'Данные пользователя'
            ])
            ->end();
    }
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('edit');
    }

    public function toString($object)
    {
        return $object instanceof FormDataRequest
            ? 'Заявка №' . $object->getId()
            : 'Форма';
    }
}
