<?php

namespace App\Controller;


use App\Entity\Protagonist;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository)
    {

        $categories = $categoryRepository->findAll();

        return $this->render('index/index.html.twig', [
            'head_title' => 'Hello les wildooz',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/character/{id}", name = "character_show")
     * @param Protagonist $protagonist
     * @return Response
     */
    public function show(Protagonist $protagonist) :Response
    {
        return $this->render('character/show.html.twig',[
            'protagonist' => $protagonist
        ]);
    }
}
