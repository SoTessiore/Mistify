<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ORM\Table(name="Post", indexes={@ORM\Index(columns={"post_name", "post_category", "post_user_pseudo"}, flags={"fulltext"})})
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_name;

    /**
     * @ORM\Column(type="text")
     */
    private $post_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_download_link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $post_nb_likes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $post_nb_coms;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post_user_id;

    /**
     * @ORM\OneToMany(targetEntity=Download::class, mappedBy="download_post_id", orphanRemoval=true)
     */
    private $post_downloads;



    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="comment_post_id", orphanRemoval=true)
     */
    private $post_comments;

    /**
     * @ORM\Column(type="integer")
     */
    private $post_nb_downloads;

    /**
     * @ORM\Column(type="date")
     */
    private $post_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_user_pseudo;

    /**
     * @ORM\OneToMany(targetEntity=Likes::class, mappedBy="likes_post_id", orphanRemoval=true)
     */
    private $post_likes;

    public function __construct()
    {
        $this->post_downloads = new ArrayCollection();
        $this->post_comments = new ArrayCollection();
        $this->post_likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostName(): ?string
    {
        return $this->post_name;
    }

    public function setPostName(string $post_name): self
    {
        $this->post_name = $post_name;

        return $this;
    }

    public function getPostDescription(): ?string
    {
        return $this->post_description;
    }

    public function setPostDescription(string $post_description): self
    {
        $this->post_description = $post_description;

        return $this;
    }

    public function getPostCategory(): ?string
    {
        return $this->post_category;
    }

    public function setPostCategory(string $post_category): self
    {
        $this->post_category = $post_category;

        return $this;
    }

    public function getPostDownloadLink(): ?string
    {
        return $this->post_download_link;
    }

    public function setPostDownloadLink(string $post_download_link): self
    {
        $this->post_download_link = $post_download_link;

        return $this;
    }

    public function getPostImage(): ?string
    {
        return $this->post_image;
    }

    public function setPostImage(string $post_image): self
    {
        $this->post_image = $post_image;

        return $this;
    }

    public function getPostNbLikes(): ?int
    {
        return $this->post_nb_likes;
    }

    public function setPostNbLikes(?int $post_nb_likes): self
    {
        $this->post_nb_likes = $post_nb_likes;

        return $this;
    }

    public function getPostNbComs(): ?int
    {
        return $this->post_nb_coms;
    }

    public function setPostNbComs(?int $post_nb_coms): self
    {
        $this->post_nb_coms = $post_nb_coms;

        return $this;
    }

    public function getPostUserId(): ?UserInterface
    {
        return $this->post_user_id;
    }

    public function setPostUserId(?UserInterface $post_user_id): self
    {
        $this->post_user_id = $post_user_id;

        return $this;
    }

    /**
     * @return Collection|Download[]
     */
    public function getPostDownloads(): Collection
    {
        return $this->post_downloads;
    }

    public function addPostDownload(Download $postDownload): self
    {
        if (!$this->post_downloads->contains($postDownload)) {
            $this->post_downloads[] = $postDownload;
            $postDownload->setDownloadPostId($this);
        }

        return $this;
    }

    public function removePostDownload(Download $postDownload): self
    {
        if ($this->post_downloads->removeElement($postDownload)) {
            // set the owning side to null (unless already changed)
            if ($postDownload->getDownloadPostId() === $this) {
                $postDownload->setDownloadPostId(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|Comment[]
     */
    public function getPostComments(): Collection
    {
        return $this->post_comments;
    }

    public function addPostComment(Comment $postComment): self
    {
        if (!$this->post_comments->contains($postComment)) {
            $this->post_comments[] = $postComment;
            $postComment->setCommentPostId($this);
        }

        return $this;
    }

    public function removePostComment(Comment $postComment): self
    {
        if ($this->post_comments->removeElement($postComment)) {
            // set the owning side to null (unless already changed)
            if ($postComment->getCommentPostId() === $this) {
                $postComment->setCommentPostId(null);
            }
        }

        return $this;
    }

    public function getPostNbDownloads(): ?int
    {
        return $this->post_nb_downloads;
    }

    public function setPostNbDownloads(int $post_nb_downloads): self
    {
        $this->post_nb_downloads = $post_nb_downloads;

        return $this;
    }

    public function getPostDate(): ?\DateTimeInterface
    {
        return $this->post_date;
    }

    public function setPostDate(\DateTimeInterface $post_date): self
    {
        $this->post_date = $post_date;

        return $this;
    }

    public function getPostUserPseudo(): ?string
    {
        return $this->post_user_pseudo;
    }

    public function setPostUserPseudo(string $post_user_pseudo): self
    {
        $this->post_user_pseudo = $post_user_pseudo;

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getPostLikes(): Collection
    {
        return $this->post_likes;
    }

    public function addPostLike(Likes $postLike): self
    {
        if (!$this->post_likes->contains($postLike)) {
            $this->post_likes[] = $postLike;
            $postLike->setLikesPostId($this);
        }

        return $this;
    }

    public function removePostLike(Likes $postLike): self
    {
        if ($this->post_likes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getLikesPostId() === $this) {
                $postLike->setLikesPostId(null);
            }
        }

        return $this;
    }
}
