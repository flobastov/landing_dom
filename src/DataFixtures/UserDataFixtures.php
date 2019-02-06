<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 07.09.2018
 * Time: 11:32
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserDataFixtures extends Fixture implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {
        // Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');

        // Create our user and set details
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->setPlainPassword('3NCRYPT3D-V3R51ON');
        $user->setPassword('3NCRYPT3D-V3R51ON');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_SUPER_ADMIN'));

        // Update the user
        $userManager->updateUser($user, true);
    }
}
