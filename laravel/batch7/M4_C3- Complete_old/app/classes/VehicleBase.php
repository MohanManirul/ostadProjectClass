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
}

/*
Abstract Class কী? 

 একটা abstract class হলো এমন ক্লাস যা থেকে ইনস্ট্যান্স তৈরি করা যায় না, কিন্তু সেটা extend করে child ক্লাস তৈরি করা যায়।

এটা এমন একটা বেস ক্লাস যেটা কিছু default behavior (implemented method) দিতে পারে, আবার কিছু abstract method রেখে child ক্লাসকে বাধ্য করতে পারে সেগুলো override করতে।

** একটি abstract class কে একাধিক ক্লাস অবশ্যই extend করতে পারে।

✅ কখন abstract class ব্যবহার করব? 

 একাধিক ক্লাসের জন্য common code & structure থাকলে
যখন কয়েকটা ক্লাসে কিছু কোড common থাকবে, কিন্তু কিছু behavior আলাদা হবে — তখন abstract class পারফেক্ট।

❌ কখন abstract class ব্যবহার না করাই ভালো?


*/