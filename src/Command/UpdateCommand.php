<?php

namespace App\Command;

use App\Services\ScrapingService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCommand extends Command
{
    protected static $defaultName = 'app:update-offers';
    private $scrapingService;

    public function __construct(ScrapingService $scrapingService)
    {
        $this->scrapingService = $scrapingService;
        parent::__construct();
    }

    protected  function configure()
    {
        $this->setDescription('updating offers...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('updating offers...');
        $this->scrapingService->scrap();
        $output->writeln('offers updated');

    }
}