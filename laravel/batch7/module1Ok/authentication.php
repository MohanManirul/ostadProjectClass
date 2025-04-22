<?php

//define ব্যবহার করলে Global (স্ক্রিপ্টের সবখানে অ্যাক্সেস করা যায়) । variable সাধারণত লোকাল স্কোপে কাজ করে

define("USERNAME", "admin"); 
define("PASSWORD", "12345");

echo "Enter Username : ";
$inputUserName = readline();

echo "Enter Password : ";
$inputPassword = readline();

// নতুন if দিয়ে empty চেক
if (empty($inputUserName) || empty($inputPassword)) {
    echo "Username বা Password খালি রাখা যাবে না! \n";
} else {
    if ($inputUserName === USERNAME && $inputPassword === PASSWORD) {
        echo "Login Successful! \n";
    } else {
        echo "Invalid Username or Password \n";
    }
}
