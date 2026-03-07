<?php

$categories = [
    "Electronics" => [
        ["id" => 1, "name" => "Laptop", "price" => 70000],
        ["id" => 2, "name" => "Smartphone", "price" => 25000],
        ["id" => 3, "name" => "Tablet", "price" => 20000],
        ["id" => 4, "name" => "Smart Watch", "price" => 5000],
        ["id" => 5, "name" => "Headphones", "price" => 3000],
    ],
    
    "Clothing" => [
        ["id" => 6, "name" => "T-Shirt", "price" => 800],
        ["id" => 7, "name" => "Jeans", "price" => 2000],
        ["id" => 8, "name" => "Jacket", "price" => 3500],
        ["id" => 9, "name" => "Shirt", "price" => 1500],
        ["id" => 10, "name" => "Sweater", "price" => 2500],
    ],
    
    "Books" =>[
        ["id" => 11, "name" => "PHP Book", "price" => 600],
        ["id" => 12, "name" => "Laravel Guide", "price" => 900],
        ["id" => 13, "name" => "JavaScript Basics", "price" => 700],
        ["id" => 14, "name" => "React Handbook", "price" => 800],
        ["id" => 15, "name" => "Web Development", "price" => 1000], 
        ]
    ] ;

    foreach($categories as $category => $products){
        echo "Category Name : " . $category . "<br>" ;
           
        foreach($products as $key => $product ){
            echo $product['name']. "-" .$product['price']. "<br>" ;
        }
        echo "<br>" ;
    }