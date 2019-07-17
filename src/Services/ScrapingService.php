<?php

namespace App\Services;

use App\Services\ScrapingInterface;

class ScrapingService
{
    private $scrapingOlxService;
    private $scrapingOtodomService;
    private $duplicatesService;

    public function __construct(ScrapingOlxService $scrapingOlxService,
                                ScrapingOtodomService $scrapingOtodomService,
                                DuplicatesService $duplicatesService)
    {
        $this->scrapingOtodomService = $scrapingOtodomService;
        $this->scrapingOlxService = $scrapingOlxService;
        $this->duplicatesService = $duplicatesService;
    }

    public function scrap()
    {
        $this->scrapingOlxService->scrap();
        $this->scrapingOtodomService->scrap();
        $this->duplicatesService->deleteDuplicates();

    }
}
