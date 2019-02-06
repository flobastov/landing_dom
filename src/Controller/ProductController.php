<?php
/**
 * Created by IntelliJ IDEA.
 * User: LobastovG
 * Date: 23.01.2019
 * Time: 10:18
 */

namespace App\Controller;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends AbstractController
{

    /**
     * @Route("/show/{id}", name="show")
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request, ProductRepository $productRepository, $id)
    {
        if ($request->isXmlHttpRequest()) {
            $product = $productRepository->findOneBy([
                'id' => $id
            ]);
            if (null === $product) {
                throw $this->createNotFoundException();
            } else {
                return $this->render('sections/_product.html.twig', [
                    'product' => $product
                ]);
            }
        } else {
            return $this->redirectToRoute('homepage');
        }
    }


    /**
     * @Route("/projects/more/{page}", name="projects/more")
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param PaginatorInterface $paginator
     * @param int $page
     * @param int $limit
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loadMore(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator, $page = 1, $limit = 5)
    {
        if ($request->isXmlHttpRequest()) {

            $projects = $productRepository->findBy(['type' => 'Проект', 'publish' => true], ['id' => 'desc']);

            $pagination = $paginator->paginate(
                $projects,
                $page,
                $limit
            );

            $renderedProjects = [];

            foreach ($pagination as $index => $project) {
                $renderedProjects[] = $this->renderView('projects/_project.html.twig', [
                    'project' => $project,
                    'index' => $index + 1
                ]);
            }

            return $this->json([
                'projects' => $renderedProjects,
                'page' => $page + 1
            ]);

        } else {
            return $this->redirectToRoute('homepage');
        }
    }

}

