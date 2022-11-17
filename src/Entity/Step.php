<?php

namespace App\Entity;

use App\Repository\StepRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StepRepository::class)
 */
class Step
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipe_step")
     * @ORM\JoinColumn(nullable=false)
     */
    private $step_recipe;

    public function __toString(){
        return $this->text; // Remplacer champ par une propriété "string" de l'entité
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getStepRecipe(): ?Recipe
    {
        return $this->step_recipe;
    }

    public function setStepRecipe(?Recipe $step_recipe): self
    {
        $this->step_recipe = $step_recipe;

        return $this;
    }
}
