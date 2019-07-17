<?php


namespace App\Services;


use App\Entity\Offer;
use App\Repository\Custom\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Goutte\Client;

class ScrapingOlxService implements ScrapingInterface
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
        $url = "https://www.olx.pl/nieruchomosci/domy/sprzedaz/olsztyn/";

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $elements = $crawler->filter('.offer-wrapper')->each(function ($node){
            return $node->text();
        });

        $links = $crawler->filter('.marginright5')->extract(['href']);

        return $this->getOffers($elements, $links);
    }

    public function getOffers($elements, $links)
    {
        $offers = array();
        $temp = 0;

        foreach ($elements as $element) {

            $offer = new Offer();

            $element = str_replace(['  ', "\t"], '', $element);
            $element = preg_split('/'."\n".'/', $element, -1, PREG_SPLIT_NO_EMPTY);
            $offer->setArea('nieznana');
            $offer->setName($element['0']);
            $offer->setCity('Olsztyn');
            $offer->setPrice($element['2']);
            $offer->setLink($links[$temp]);
            $offer->setPortal('Olx');
            $temp++;
            $this->entityManager->persist($offer);

            array_push($offers, $offer);
        }

        $this->entityManager->flush();

    }

    public function save($offers)
    {
        $this->offerRepository->save($offers);
    }
}