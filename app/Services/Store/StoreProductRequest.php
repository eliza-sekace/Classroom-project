<?php

namespace App\Services\Store;


class StoreProductRequest
{
    private ?int $id;
    private string $title;
    private string $description;
    private int $available;
    private int $price;


    public function __construct(?int $id, $title, $description, $available, $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->available = $available;
        $this->price = $price;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAvailable()
    {
        return $this->available;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }



}