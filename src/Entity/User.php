<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"user_pseudo"}, message="There is already an account with this username")
 * @UniqueEntity(fields={"user_mail"}, message="There is already an account with this email address")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $user_pseudo;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $user_password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $user_mail;

    /**
     * @ORM\Column(type="date")
     */
    private $user_born;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="post_user_id", orphanRemoval=true)
     */
    private $user_posts;

    /**
     * @ORM\OneToMany(targetEntity=Download::class, mappedBy="download_user_id", orphanRemoval=true)
     */
    private $user_downloads;

    /**
     * @ORM\OneToMany(targetEntity=Likes::class, mappedBy="likes_user_id", orphanRemoval=true)
     */
    private $user_likes;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="comment_user_id", orphanRemoval=true)
     */
    private $user_comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_lastname;

    public function __construct()
    {
        $this->user_posts = new ArrayCollection();
        $this->user_downloads = new ArrayCollection();
        $this->user_likes = new ArrayCollection();
        $this->user_comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserPseudo(): ?string
    {
        return $this->user_pseudo;
    }

    public function setUserPseudo(string $user_pseudo): self
    {
        $this->user_pseudo = $user_pseudo;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->user_password;
    }

    public function setUserPassword(string $user_password): self
    {
        $this->user_password = $user_password;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->user_mail;
    }

    public function setUserMail(string $user_mail): self
    {
        $this->user_mail = $user_mail;

        return $this;
    }

    public function getUserBorn(): ?\DateTimeInterface
    {
        return $this->user_born;
    }

    public function setUserBorn(\DateTimeInterface $user_born): self
    {
        $this->user_born = $user_born;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getUserPosts(): Collection
    {
        return $this->user_posts;
    }

    public function addUserPost(Post $userPost): self
    {
        if (!$this->user_posts->contains($userPost)) {
            $this->user_posts[] = $userPost;
            $userPost->setPostUserId($this);
        }

        return $this;
    }

    public function removeUserPost(Post $userPost): self
    {
        if ($this->user_posts->removeElement($userPost)) {
            // set the owning side to null (unless already changed)
            if ($userPost->getPostUserId() === $this) {
                $userPost->setPostUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Download[]
     */
    public function getUserDownloads(): Collection
    {
        return $this->user_downloads;
    }

    public function addUserDownload(Download $userDownload): self
    {
        if (!$this->user_downloads->contains($userDownload)) {
            $this->user_downloads[] = $userDownload;
            $userDownload->setDownloadUserId($this);
        }

        return $this;
    }

    public function removeUserDownload(Download $userDownload): self
    {
        if ($this->user_downloads->removeElement($userDownload)) {
            // set the owning side to null (unless already changed)
            if ($userDownload->getDownloadUserId() === $this) {
                $userDownload->setDownloadUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getUserLikes(): Collection
    {
        return $this->user_likes;
    }

    public function addUserLike(Likes $userLike): self
    {
        if (!$this->user_likes->contains($userLike)) {
            $this->user_likes[] = $userLike;
            $userLike->setLikesUserId($this);
        }

        return $this;
    }

    public function removeUserLike(Likes $userLike): self
    {
        if ($this->user_likes->removeElement($userLike)) {
            // set the owning side to null (unless already changed)
            if ($userLike->getLikesUserId() === $this) {
                $userLike->setLikesUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getUserComments(): Collection
    {
        return $this->user_comments;
    }

    public function addUserComment(Comment $userComment): self
    {
        if (!$this->user_comments->contains($userComment)) {
            $this->user_comments[] = $userComment;
            $userComment->setCommentUserId($this);
        }

        return $this;
    }

    public function removeUserComment(Comment $userComment): self
    {
        if ($this->user_comments->removeElement($userComment)) {
            // set the owning side to null (unless already changed)
            if ($userComment->getCommentUserId() === $this) {
                $userComment->setCommentUserId(null);
            }
        }

        return $this;
    }

    public function getUserAvatar(): ?string
    {
        return $this->user_avatar;
    }

    public function setUserAvatar(?string $user_avatar): self
    {
        $this->user_avatar = $user_avatar;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return $this->user_password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->user_pseudo;
    }

    public function eraseCredentials()
    {

    }

    public function getUserFirstname(): ?string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(string $user_firstname): self
    {
        $this->user_firstname = $user_firstname;

        return $this;
    }

    public function getUserLastname(): ?string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): self
    {
        $this->user_lastname = $user_lastname;

        return $this;
    }
}
