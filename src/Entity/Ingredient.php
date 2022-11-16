<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipe_ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient_recipe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ingredient_name;

   /**
     * @ORM\Column(type="string", length=75)
     */ 
    private $quantity;

    // /**
    //  * Constructor
    //  */ 
    // public function __construct(){
    //     $this->createdAt = new \Integer();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredientRecipe(): ?Recipe
    {
        return $this->ingredient_recipe;
    }

    public function setIngredientRecipe(?Recipe $ingredient_recipe): self
    {
        $this->ingredient_recipe = $ingredient_recipe;

        return $this;
    }

    public function getIngredientName(): ?string
    {
        return $this->ingredient_name;
    }

    public function setIngredientName(string $ingredient_name): self
    {
        $this->ingredient_name = $ingredient_name;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
