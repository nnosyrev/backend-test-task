<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Entity;

class Product
{
    private int $id;
    private string $uuid;
    private bool $isActive;
    private string $category;
    private string $name;
    private string $description;
    private string $thumbnail;
    private float $price;

    public function __construct(
        int $id,
        string $uuid,
        bool $isActive,
        string $category,
        string $name,
        string $description,
        string $thumbnail,
        float $price,
    ) {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->isActive = $isActive;
        $this->category = $category;
        $this->name = $name;
        $this->description = $description;
        $this->thumbnail = $thumbnail;
        $this->price = $price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }
}
