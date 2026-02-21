<?php

const USERNAME = 'admin';
const PASSWORD = 123456 ;

echo 'Enter Username : ' ;
$username = readline();

echo 'Enter Password : ';
$password = (int)readline();

if( empty( $username || $password ) ){
    echo 'Username Or Password is Blank' ;
}else{
    if( $username === USERNAME && $password === PASSWORD ){
        echo 'Login Successfull ! User Dashboard' ;
    }else{
        echo 'Invalid usename Or Password' ;
    }
}
