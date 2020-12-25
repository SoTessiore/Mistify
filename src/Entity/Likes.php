<?php

namespace App\Entity;

use App\Repository\LikesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LikesRepository::class)
 */
class Likes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $likes_user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="post_likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $likes_post_id;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLikesUserId(): ?User
    {
        return $this->likes_user_id;
    }

    public function setLikesUserId(?User $likes_user_id): self
    {
        $this->likes_user_id = $likes_user_id;

        return $this;
    }

    public function getLikesPostId(): ?Post
    {
        return $this->likes_post_id;
    }

    public function setLikesPostId(?Post $likes_post_id): self
    {
        $this->likes_post_id = $likes_post_id;

        return $this;
    }
}
