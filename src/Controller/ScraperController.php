<?php

namespace App\Controller;

use App\Services\ScrapingOlxService;
use App\Services\ScrapingOtodomService;
use Goutte\Client;
use App\Entity\Offer;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScraperController
{
    /**
     * @Route("/home")
     */
    public function showAction(ScrapingOlxService $scrapingOtodomService)
    {
        $scrapingOtodomService->scrap();

        return new Response('');
    }
}