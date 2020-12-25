<?php

namespace App\Entity;

use App\Repository\DownloadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=DownloadRepository::class)
 */
class Download
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_downloads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $download_user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="post_downloads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $download_post_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDownloadUserId(): ?UserInterface
    {
        return $this->download_user_id;
    }

    public function setDownloadUserId(?UserInterface $download_user_id): self
    {
        $this->download_user_id = $download_user_id;

        return $this;
    }

    public function getDownloadPostId(): ?Post
    {
        return $this->download_post_id;
    }

    public function setDownloadPostId(?Post $download_post_id): self
    {
        $this->download_post_id = $download_post_id;

        return $this;
    }
}
