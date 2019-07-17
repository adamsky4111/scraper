<?php


namespace App\Repository\Custom;

use App\Entity\Offer;
use App\Repository\Interfaces\OfferRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class OfferRepository implements OfferRepositoryInterface
{
    private $repository;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Offer::class);
    }

    public function save($offers)
    {
        foreach ($offers as $offer){
            $this->entityManager->persist($offer);
        }
        $this->entityManager = flush();
    }
    public function deleteDuplicates()
    {
//        $query = $this->entityManager->createQuery(
//            'SELECT App:Offer t1 INNER JOIN App:Offer t2
//            WHERE t1.id < t2.id
//            AND t1.link = t2.link');
//        dd($query->getResult());



//        $query = $this->entityManager->createQuery(
//            'DELETE t1 from App:Offer t1 INNER JOIN App:Offer t2 WHERE t1.id < t2.id AND t1.link = t2.link'
//        );
//
//        dd($query->execute());
      //   $query->execute();

//
//        $deleteQuery = $this->entityManager
//            ->createQueryBuilder('t1')
//            ->delete('App:Offer', 't1')
//            ->innerJoin('App:Offer', 't2')
//            ->where('t1.id < t2.id')
//            ->andWhere('t1.link = t2.link')
//            ->getQuery();

       // $deleted = $deleteQuery->execute();

       // $deleted->flush();
       // dd($deleteQuery);
    }

}




