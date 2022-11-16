<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_recipe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe_user;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="ingredient_recipe")
     */
    private $recipe_ingredient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recipe_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $number_person;

    /**
     * @ORM\OneToMany(targetEntity=Step::class, mappedBy="step_recipe")
     */
    private $recipe_step;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="comment_recipe")
     */
    private $recipe_comment;

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="mark_recipe")
     */
    private $recipe_mark;

    /**
     * @ORM\Column(type="integer")
     */
    private $preparation_time;

    /**
     * @ORM\Column(type="integer")
     */
    private $cooking_time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    public function __construct()
    {
        $this->recipe_ingredient = new ArrayCollection();
        $this->recipe_step = new ArrayCollection();
        $this->recipe_comment = new ArrayCollection();
        $this->recipe_mark = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeUser(): ?User
    {
        return $this->recipe_user;
    }

    public function setRecipeUser(?User $recipe_user): self
    {
        $this->recipe_user = $recipe_user;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getRecipeIngredient(): Collection
    {
        return $this->recipe_ingredient;
    }

    public function addRecipeIngredient(Ingredient $recipeIngredient): self
    {
        if (!$this->recipe_ingredient->contains($recipeIngredient)) {
            $this->recipe_ingredient[] = $recipeIngredient;
            $recipeIngredient->setIngredientRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(Ingredient $recipeIngredient): self
    {
        if ($this->recipe_ingredient->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getIngredientRecipe() === $this) {
                $recipeIngredient->setIngredientRecipe(null);
            }
        }

        return $this;
    }

    public function getRecipeName(): ?string
    {
        return $this->recipe_name;
    }

    public function setRecipeName(string $recipe_name): self
    {
        $this->recipe_name = $recipe_name;

        return $this;
    }

    public function getNumberPerson(): ?int
    {
        return $this->number_person;
    }

    public function setNumberPerson(int $number_person): self
    {
        $this->number_person = $number_person;

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getRecipeStep(): Collection
    {
        return $this->recipe_step;
    }

    public function addRecipeStep(Step $recipeStep): self
    {
        if (!$this->recipe_step->contains($recipeStep)) {
            $this->recipe_step[] = $recipeStep;
            $recipeStep->setStepRecipe($this);
        }

        return $this;
    }

    public function removeRecipeStep(Step $recipeStep): self
    {
        if ($this->recipe_step->removeElement($recipeStep)) {
            // set the owning side to null (unless already changed)
            if ($recipeStep->getStepRecipe() === $this) {
                $recipeStep->setStepRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getRecipeComment(): Collection
    {
        return $this->recipe_comment;
    }

    public function addRecipeComment(Comment $recipeComment): self
    {
        if (!$this->recipe_comment->contains($recipeComment)) {
            $this->recipe_comment[] = $recipeComment;
            $recipeComment->setCommentRecipe($this);
        }

        return $this;
    }

    public function removeRecipeComment(Comment $recipeComment): self
    {
        if ($this->recipe_comment->removeElement($recipeComment)) {
            // set the owning side to null (unless already changed)
            if ($recipeComment->getCommentRecipe() === $this) {
                $recipeComment->setCommentRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mark>
     */
    public function getRecipeMark(): Collection
    {
        return $this->recipe_mark;
    }

    public function addRecipeMark(Mark $recipeMark): self
    {
        if (!$this->recipe_mark->contains($recipeMark)) {
            $this->recipe_mark[] = $recipeMark;
            $recipeMark->setMarkRecipe($this);
        }

        return $this;
    }

    public function removeRecipeMark(Mark $recipeMark): self
    {
        if ($this->recipe_mark->removeElement($recipeMark)) {
            // set the owning side to null (unless already changed)
            if ($recipeMark->getMarkRecipe() === $this) {
                $recipeMark->setMarkRecipe(null);
            }
        }

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparation_time;
    }

    public function setPreparationTime(int $preparation_time): self
    {
        $this->preparation_time = $preparation_time;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->cooking_time;
    }

    public function setCookingTime(int $cooking_time): self
    {
        $this->cooking_time = $cooking_time;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
