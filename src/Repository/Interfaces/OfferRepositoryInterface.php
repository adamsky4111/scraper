<?php


namespace App\Repository\Interfaces;


interface OfferRepositoryInterface
{

    public function save($offers);

    public function deleteDuplicates();

}