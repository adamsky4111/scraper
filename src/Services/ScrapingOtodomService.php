<?php


namespace App\Services;


use App\Entity\Offer;
use App\Repository\Custom\OfferRepository;

use Doctrine\ORM\EntityManagerInterface;
use Goutte\Client;

class ScrapingOtodomService implements ScrapingInterface
{
    private $offerRepository;

    private $entityManager;

    public function __construct( OfferRepository $offerRepository,
                                 EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->offerRepository = $offerRepository;
    }

    public function scrap()
    {
        $url = "https://www.otodom.pl/sprzedaz/dom/olsztyn/?search%5Bcity_id%5D=210&search%5Bsubregion_id%5D=454&search%5Bregion_id%5D=14";

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $elements = $crawler->filter('.offer-item-details
            ')->each(function ($node){
            return $node->text();
        });

        $links = $crawler->filter('.offer-item')->extract(['data-url']);

        $images = $crawler->filter('.offer-item-image')->extract(['data-quick-gallery']);

        return $this->getOffers($elements, $links);
    }

    public function getOffers($elements, $links)
    {
        $offers = array();
        $temp = 0;
        foreach ($elements as $element)
        {
            $offer = new Offer();
            $rawNode = str_replace('  ', '', $element);
            $data = explode("\n",  $rawNode);

            $offer->setArea($data['3']);
            $offer->setName($data['5']);
            $offer->setCity('Olsztyn');
            $offer->setPrice($data['21']);
            $offer->setLink($links[$temp]);
            $offer->setPortal('Otodom');
            $this->entityManager->persist($offer);
            array_push($offers, $offer);
            $temp++;
        }

        $this->entityManager->flush();

    }

    public function save($offers)
    {
        $this->offerRepository->save($offers);
   }
}