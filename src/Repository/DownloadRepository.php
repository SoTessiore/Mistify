<?php

namespace App\Repository;

use App\Entity\Download;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Download|null find($id, $lockMode = null, $lockVersion = null)
 * @method Download|null findOneBy(array $criteria, array $orderBy = null)
 * @method Download[]    findAll()
 * @method Download[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DownloadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Download::class);
    }

    /**
    * @return Download[] Returns an array of Download objects
    */

    public function findByPostId($postId)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.download_post_id = :val')
            ->setParameter('val', $postId)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Download[] Returns an array of Download objects
     */

    public function findUserDownloads($userId)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.download_user_id = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Download
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function hasAlreadyDownload($userId, $postId): ?Download
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.download_user_id = :userId')
            ->setParameter('userId', $userId)
            ->andWhere('d.download_post_id = :postId')
            ->setParameter('postId', $postId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
