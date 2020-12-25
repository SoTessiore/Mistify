<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $comment_content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comment_user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="post_comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comment_post_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentContent(): ?string
    {
        return $this->comment_content;
    }

    public function setCommentContent(string $comment_content): self
    {
        $this->comment_content = $comment_content;

        return $this;
    }

    public function getCommentUserId(): ?User
    {
        return $this->comment_user_id;
    }

    public function setCommentUserId(?User $comment_user_id): self
    {
        $this->comment_user_id = $comment_user_id;

        return $this;
    }

    public function getCommentPostId(): ?Post
    {
        return $this->comment_post_id;
    }

    public function setCommentPostId(?Post $comment_post_id): self
    {
        $this->comment_post_id = $comment_post_id;

        return $this;
    }
}
