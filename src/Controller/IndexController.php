<?php

namespace App\Controller;


use App\Entity\Protagonist;
use App\Repository\CategoryRepository;
use App\Service\CapsGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param CategoryRepository $categoryRepository
     * @param CapsGenerator $capsGenerator
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository, CapsGenerator $capsGenerator)
    {

        $categories = $categoryRepository->findAll();
        foreach ($categories as $category){
            foreach ($category->getProtagonists() as $protagonist){
                $protagonistName = $capsGenerator->capsMeMaybe($protagonist->getName());
                $protagonist->setName($protagonistName);
            }
        }

        return $this->render('index/index.html.twig', [
            'head_title' => 'Hello les wildooz',
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/character/{id}", name = "character_show")
     * @param Protagonist $protagonist
     * @param CapsGenerator $capsGenerator
     * @return Response
     */
    public function show(Protagonist $protagonist, CapsGenerator $capsGenerator) :Response
    {
        $protagonistName = $capsGenerator->capsMeMaybe($protagonist->getName());
        $protagonist->setName($protagonistName);
        return $this->render('character/show.html.twig',[
            'protagonist' => $protagonist
        ]);
    }
}
