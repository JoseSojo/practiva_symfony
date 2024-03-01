<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'user')]
    private Collection $posts;

    #[ORM\ManyToOne(inversedBy: 'user_reference')]
    private ?Comments $comments = null;

    #[ORM\Column(length: 200)]
    private ?string $photo = null;

    #[ORM\OneToMany(targetEntity: Posts::class, mappedBy: 'user_id')]
    private Collection $postss;

    #[ORM\OneToMany(targetEntity: Published::class, mappedBy: 'user_id')]
    private Collection $publisheds;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->postss = new ArrayCollection();
        $this->publisheds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): static
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

        return $this;
    }

    public function getComments(): ?Comments
    {
        return $this->comments;
    }

    public function setComments(?Comments $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Posts>
     */
    public function getPostss(): Collection
    {
        return $this->postss;
    }

    public function addPostss(Posts $postss): static
    {
        if (!$this->postss->contains($postss)) {
            $this->postss->add($postss);
            $postss->setUserId($this);
        }

        return $this;
    }

    public function removePostss(Posts $postss): static
    {
        if ($this->postss->removeElement($postss)) {
            // set the owning side to null (unless already changed)
            if ($postss->getUserId() === $this) {
                $postss->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Published>
     */
    public function getPublisheds(): Collection
    {
        return $this->publisheds;
    }

    public function addPublished(Published $published): static
    {
        if (!$this->publisheds->contains($published)) {
            $this->publisheds->add($published);
            $published->setUserId($this);
        }

        return $this;
    }

    public function removePublished(Published $published): static
    {
        if ($this->publisheds->removeElement($published)) {
            // set the owning side to null (unless already changed)
            if ($published->getUserId() === $this) {
                $published->setUserId(null);
            }
        }

        return $this;
    }
}
