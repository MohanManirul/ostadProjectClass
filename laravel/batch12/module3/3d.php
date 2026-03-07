<?php

$categories = [
    "Electronics" => [
        ["id" => 1, "name" => "Laptop", "price" => 70000 ,"color" => ["Black","Silver","Gray"] ],
        ["id" => 2, "name" => "Smartphone", "price" => 25000,"color" => ["Black","Silver","Gray"]],
        ["id" => 3, "name" => "Tablet", "price" => 20000,"color" => ["Black","Silver","Gray"]],
        ["id" => 4, "name" => "Smart Watch", "price" => 5000,"color" => ["Black","Silver","Gray"]],
        ["id" => 5, "name" => "Headphones", "price" => 3000,"color" => ["Black","Silver","Gray"]],
    ],
    
    "Clothing" => [
        ["id" => 6, "name" => "T-Shirt", "price" => 800,"color" => ["Black","Silver","Gray"]],
        ["id" => 7, "name" => "Jeans", "price" => 2000,"color" => ["Black","Silver","Gray"]],
        ["id" => 8, "name" => "Jacket", "price" => 3500,"color" => ["Black","Silver","Gray"]],
        ["id" => 9, "name" => "Shirt", "price" => 1500,"color" => ["Black","Silver","Gray"]],
        ["id" => 10, "name" => "Sweater", "price" => 2500,"color" => ["Black","Silver","Gray"]],
    ],
    
    "Books" =>[
        ["id" => 11, "name" => "PHP Book", "price" => 600,"color" => ["Black","Silver","Gray"]],
        ["id" => 12, "name" => "Laravel Guide", "price" => 900,"color" => ["Black","Silver","Gray"]],
        ["id" => 13, "name" => "JavaScript Basics", "price" => 700,"color" => ["Black","Silver","Gray"]],
        ["id" => 14, "name" => "React Handbook", "price" => 800,"color" => ["Black","Silver","Gray"]],
        ["id" => 15, "name" => "Web Development", "price" => 1000,"color" => ["Black","Silver","Gray"]], 
        ]
    ] ;

    foreach($categories as $category => $products){
        echo "Category Name : " . $category . "<br>" ;
           
        foreach($products as $key => $product ){
            echo "&nbsp;&nbsp;&nbsp;". $product['name'] . "-" . $product['price'] . "<br>" ;

            echo "&nbsp;&nbsp;&nbsp;" . "Colors: " ;
            foreach($product['color'] as  $color ){
                echo "&nbsp;&nbsp;&nbsp;" . $color . " " ;
            }
        }
        echo "<br><br>" ;
    }