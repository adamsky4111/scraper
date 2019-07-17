<?php


namespace App\Services;


use App\Repository\Interfaces\OfferRepositoryInterface;

class DuplicatesService
{
    private $offerRepository;

    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function deleteDuplicates()
    {
        $this->offerRepository->deleteDuplicates();
    }
}