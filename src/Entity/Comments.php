<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $create_at = null;

    #[ORM\Column(length: 100)]
    private ?string $content = null;

    #[ORM\Column(length: 100)]
    private ?string $id_user = null;

    #[ORM\Column(length: 100)]
    private ?string $id_post = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?post $post_reference = null;

    #[ORM\OneToMany(targetEntity: user::class, mappedBy: 'comments')]
    private Collection $user_reference;

    public function __construct()
    {
        $this->user_reference = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeImmutable $create_at): static
    {
        $this->create_at = $create_at;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getIdUser(): ?string
    {
        return $this->id_user;
    }

    public function setIdUser(string $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdPost(): ?string
    {
        return $this->id_post;
    }

    public function setIdPost(string $id_post): static
    {
        $this->id_post = $id_post;

        return $this;
    }

    public function getPostReference(): ?post
    {
        return $this->post_reference;
    }

    public function setPostReference(?post $post_reference): static
    {
        $this->post_reference = $post_reference;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserReference(): Collection
    {
        return $this->user_reference;
    }

    public function addUserReference(user $userReference): static
    {
        if (!$this->user_reference->contains($userReference)) {
            $this->user_reference->add($userReference);
            $userReference->setComments($this);
        }

        return $this;
    }

    public function removeUserReference(user $userReference): static
    {
        if ($this->user_reference->removeElement($userReference)) {
            // set the owning side to null (unless already changed)
            if ($userReference->getComments() === $this) {
                $userReference->setComments(null);
            }
        }

        return $this;
    }
}
