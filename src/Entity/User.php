<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Animal::class)]
    private Collection $Animals;

    #[ORM\OneToMany(mappedBy: 'postOwnerId', targetEntity: Post::class)]
    private Collection $Posts;

    #[ORM\OneToMany(mappedBy: 'ownerid', targetEntity: Post::class)]
    private Collection $UserPosts;

    #[ORM\OneToMany(mappedBy: 'userid', targetEntity: Post::class)]
    private Collection $posts;

    public function __construct()
    {
        $this->Animals = new ArrayCollection();
        $this->Posts = new ArrayCollection();
        $this->UserPosts = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->Animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->Animals->contains($animal)) {
            $this->Animals->add($animal);
            $animal->setOwner($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->Animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getOwner() === $this) {
                $animal->setOwner(null);
            }
        }

        return $this;
    }

    #[ORM\Column(type: 'string')]
    private string $avatar;





    public function getavatar(): string
    {
        return $this->avatar;
    }

    public function setavatar(string $avatar): self
    {
        $this->avatar = $avatar;

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
            $post->setUserid($this);
        }

        return $this;
    }

    public function removePost(Post $post): static
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUserid() === $this) {
                $post->setUserid(null);
            }
        }

        return $this;
    }


    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $ArrayOfFriends = [];

    
    



    public function getArrayOfFriends(): array
    {
        return $this->ArrayOfFriends;
    }

    public function setArrayOfFriends(?array $ArrayOfFriends): static
    {
        $this->ArrayOfFriends = $ArrayOfFriends;

        return $this;
    }


    #[ORM\Column(type: Types::ARRAY)]
    private $friends;

    public function getFriends()
    {
        if (gettype($this->friends) != 'array') {
            $this->friends = [];
            return $this->friends;
        } else {
            return $this->friends;
        }
    }

    public function setFriends(array $friends): static
    {
        $this->friends = $friends;

        return $this;
    }








}
