<?php

namespace App\Controller;

use App\Services\ScrapingInterface;
use App\Services\ScrapingOlxService;
use App\Services\ScrapingOtodomService;
use App\Services\ScrapingService;
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
    public function showAction(ScrapingService $scrapingService)
    {
        $scrapingService->scrap();

        return new Response('');
    }
}