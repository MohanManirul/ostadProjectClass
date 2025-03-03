<?php

define("USERNAME", "admin"); //define ব্যবহার করলে Global (স্ক্রিপ্টের সবখানে অ্যাক্সেস করা যায়)  । variable সাধারণত লোকাল স্কোপে কাজ করে
define("PASSWORD", "12345");

echo "Enter Username : " ;

$inputUserName = readline();

echo "Enter Password : " ;

$inputPassword = readline();

if( $inputUserName === USERNAME &&  $inputPassword === PASSWORD ){
    echo "Login Successfull ! \n" ;
}else{
    echo "Invalid Username or Password \n" ;
}
