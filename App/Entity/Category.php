<?php

namespace App\Entity;

class Category
{
  protected ?int $id = null;
  protected string $name;
  protected ?int $parent_id = null;


  /**
   * Get the value of id
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId(?int $id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set the value of name
   */
  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of parent_id
   */
  public function getParentId(): ?int
  {
    return $this->parent_id;
  }

  /**
   * Set the value of parent_id
   */
  public function setParentId(?int $parent_id): self
  {
    $this->parent_id = $parent_id;

    return $this;
  }
}