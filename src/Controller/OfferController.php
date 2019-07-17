<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use App\Repository\Doctrine\OfferRepository;
use App\Repository\Interfaces\OfferRepositoryInterface;
use App\Services\OfferService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offer")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", name="offer_index", methods={"GET"})
     */
    public function index(OfferService $offerService): Response
    {
        dd($offerService->getAll());
        return $this->render('offer/index.html.twig', [
            'offers' => $offerService->getAll(),
        ]);
    }
}
