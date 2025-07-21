<?php

const USERNAME = "admin";
const PASSWORD = 12345 ;

echo "Enter Username : ";
$Username = readline();

echo "Enter Password : " ;
$Password = (int)readline() ;

if(empty($Username) || empty($Password)){
    echo "Usename Or Password is Blank" ;
} else{
    if($Username === USERNAME && $Password === PASSWORD){
        echo "Login Succesfull ! User Dashboard";
    }else{
        echo "Invalid Username Or Password" ;
    }
}  