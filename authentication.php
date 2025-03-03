<?php

define("USERNAME", "admin");
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
