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

        $elements = $crawler->filter('.offer')->each(function ($node){
            return $node->text();
        });

        return $this->getOffers($elements);
    }

    public function getOffers($elements)
    {
        $offers = array();
        foreach ($elements as $element) {
            $offer = new Offer();
            $rawNode = str_replace('  ', '', $element);
            $s = str_replace("\t", '', $rawNode);
            $data = explode("\n", $s);
            dd($data, $data['14']);
            $offer->setArea('nieznana');

            $offer->setName($data['14']);

            $offer->setCity('Olsztyn');
            $offer->setPrice('sdfsdf');
            $offer->setLink('fsdf');

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