<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     */
    private $date_of_birth;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="recipe_user")
     */
    private $user_recipe;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="comment_user")
     */
    private $user_comment;

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="mark_user")
     */
    private $user_mark;

    public function __construct()
    {
        $this->user_recipe = new ArrayCollection();
        $this->user_comment = new ArrayCollection();
        $this->user_mark = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getUserRecipe(): Collection
    {
        return $this->user_recipe;
    }

    public function addUserRecipe(Recipe $userRecipe): self
    {
        if (!$this->user_recipe->contains($userRecipe)) {
            $this->user_recipe[] = $userRecipe;
            $userRecipe->setRecipeUser($this);
        }

        return $this;
    }

    public function removeUserRecipe(Recipe $userRecipe): self
    {
        if ($this->user_recipe->removeElement($userRecipe)) {
            // set the owning side to null (unless already changed)
            if ($userRecipe->getRecipeUser() === $this) {
                $userRecipe->setRecipeUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getUserComment(): Collection
    {
        return $this->user_comment;
    }

    public function addUserComment(Comment $userComment): self
    {
        if (!$this->user_comment->contains($userComment)) {
            $this->user_comment[] = $userComment;
            $userComment->setCommentUser($this);
        }

        return $this;
    }

    public function removeUserComment(Comment $userComment): self
    {
        if ($this->user_comment->removeElement($userComment)) {
            // set the owning side to null (unless already changed)
            if ($userComment->getCommentUser() === $this) {
                $userComment->setCommentUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getUserMark(): Collection
    {
        return $this->user_mark;
    }

    public function addUserMark(Mark $userMark): self
    {
        if (!$this->user_mark->contains($userMark)) {
            $this->user_mark[] = $userMark;
            $userMark->setMarkUser($this);
        }

        return $this;
    }

    public function removeUserMark(Mark $userMark): self
    {
        if ($this->user_mark->removeElement($userMark)) {
            // set the owning side to null (unless already changed)
            if ($userMark->getMarkUser() === $this) {
                $userMark->setMarkUser(null);
            }
        }

        return $this;
    }
}
