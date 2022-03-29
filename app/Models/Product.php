<?php

namespace App\Models;

class Product
{
    private ?int $id;
    private $title;
    private $description;
    private $price;
    private $available;

    public function __construct(?int $id, $title, $description, $price, $available)
    {

        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->available = $available;
    }

    public function getId():?int
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }


    public function getAvailable()
    {
        return $this->available;
    }

}