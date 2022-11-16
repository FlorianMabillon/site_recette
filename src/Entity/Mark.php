<?php

namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarkRepository::class)
 */
class Mark
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stars;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_mark")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mark_user;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipe_mark")
     */
    private $mark_recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(?int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }

    public function getMarkUser(): ?User
    {
        return $this->mark_user;
    }

    public function setMarkUser(?User $mark_user): self
    {
        $this->mark_user = $mark_user;

        return $this;
    }

    public function getMarkRecipe(): ?Recipe
    {
        return $this->mark_recipe;
    }

    public function setMarkRecipe(?Recipe $mark_recipe): self
    {
        $this->mark_recipe = $mark_recipe;

        return $this;
    }
}
