<?php
/**
 * Created by IntelliJ IDEA.
 * User: kirillrossokhin
 * Date: 07.09.2018
 * Time: 14:48
 */

namespace App\Controller;


use App\Repository\PageBlockRepository;
use App\Repository\ProductRepository;
use App\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index(SettingRepository $settingRepository, ProductRepository $productRepository, PageBlockRepository $pageBlockRepository)
    {
        $settings = $settingRepository->findByPage();
        $content = $pageBlockRepository->findByPage();
        $projects = $productRepository->findBy(['type' => 'Проект', 'publish' => true], ['id' => 'desc'], 5);
        $objects = $productRepository->findBy(['type' => 'Объект', 'publish' => true], ['id' => 'desc']);

        return $this->render('home.html.twig', [
            'settings' => $settings,
            'content' => $content,
            'projects' => $projects,
            'objects' => $objects]);
    }

}
