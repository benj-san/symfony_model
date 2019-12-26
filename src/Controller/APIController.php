<?php

namespace App\Controller;

use App\Entity\Protagonist;
use App\Repository\ProtagonistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class APIController extends AbstractController
{
    /**
     * @Route("/api/characters", name="api_characters")
     * @param ProtagonistRepository $protagonistRepository
     * @return JsonResponse
     */
    public function index(ProtagonistRepository $protagonistRepository): JsonResponse
    {
        $characters = $protagonistRepository->findAll();
        return $this->json($characters, 200, [], [
            ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object) {
            $object->getId();
            },
            ObjectNormalizer::IGNORED_ATTRIBUTES => ['protagonists'],
            AbstractObjectNormalizer::SKIP_NULL_VALUES => ['japaneseName']
        ]);
    }

    /**
     * @Route("/api/character/{id}", name="api_character")
     * @param Protagonist $protagonist
     * @return JsonResponse
     */
    public function getCharacter(Protagonist $protagonist): JsonResponse
    {
        return $this->json($protagonist, 200, [], [
            ObjectNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object) {
                $object->getId();
            },
            ObjectNormalizer::IGNORED_ATTRIBUTES => ['protagonists'],
            AbstractObjectNormalizer::SKIP_NULL_VALUES => ['japaneseName']
        ]);

    }
}
