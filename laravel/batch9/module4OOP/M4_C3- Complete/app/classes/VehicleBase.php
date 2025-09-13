<?php

abstract class VehicleBase {
    protected $name;
    protected $type;
    protected $price;
    protected $image;

    public function __construct($name, $type, $price, $image)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->image = $image;
    }

    abstract public function getDetails();

    // class e na dekhaleo hobe
    public function anotherFunction(){
        return "ok" ;
    }
}

/* 
    blueprint use korte
    কিছু common কোড শেয়ার + subclass কে কিছু method
    -- Abstract class থেকে object তৈরি হয় না
    -- একটিই abstract class extend করা যায়
    -- abstract class এ method এর declaration এবং definition (implementation) দুটোই থাকতে পারে
    আংশিক নকশা (কিছু ready, কিছু implement করতে হবে)
    abstract class এ যে মেথড টি abstrac সেটিকে অবসস্যই child class এ 
    Implement করতে হবে

*/