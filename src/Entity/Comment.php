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
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_comment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $comment_user;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipe_comment")
     */
    private $comment_recipe;

    public function __toString(){
        return $this->message; // Remplacer champ par une propriété "string" de l'entité
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCommentUser(): ?User
    {
        return $this->comment_user;
    }

    public function setCommentUser(?User $comment_user): self
    {
        $this->comment_user = $comment_user;

        return $this;
    }

    public function getCommentRecipe(): ?Recipe
    {
        return $this->comment_recipe;
    }

    public function setCommentRecipe(?Recipe $comment_recipe): self
    {
        $this->comment_recipe = $comment_recipe;

        return $this;
    }
}
