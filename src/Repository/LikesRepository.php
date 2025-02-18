<?php

namespace App\Repository;

use App\Entity\Download;
use App\Entity\Likes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Likes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Likes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Likes[]    findAll()
 * @method Likes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Likes::class);
    }

    /**
    * @return Likes[] Returns an array of Likes objects
    */
    public function findByPostId($postId)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.likes_post_id = :val')
            ->setParameter('val', $postId)
            ->getQuery()
            ->getResult()
            ;
    }

    public function hasAlreadyLiked($userId, $postId): ?Likes
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.likes_user_id = :userId')
            ->setParameter('userId', $userId)
            ->andWhere('d.likes_post_id = :postId')
            ->setParameter('postId', $postId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findUserLikes($userId)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.likes_user_id = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Likes[] Returns an array of Likes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Likes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
