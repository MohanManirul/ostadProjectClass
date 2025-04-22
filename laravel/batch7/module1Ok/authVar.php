<?php

$username = "admin";
$password = "12345";

echo "Enter Username : ";
$inputUserName = readline();

echo "Enter Password : ";
$inputPassword = readline();

if ($inputUserName === $username && $inputPassword === $password) {
    echo "Login Successful! \n";
} else {
    echo "Invalid Username or Password \n";
}
