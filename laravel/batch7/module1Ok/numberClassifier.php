<?php

// fgets(STDIN) // 	সরাসরি এক লাইন ইনপুট নিতে
// readline();  লাইন ইনপুট নিতে, বেশি কন্ট্রোলের জন্য
// php://stdin  স্ট্রীম ম্যানেজ করার জন্য
// argv (arguments) স্ক্রিপ্ট রান করার সময় ইনপুট নিতে

echo "Enter a number : " ;
$number = (int) readline(); 

if( $number > 0 ){
    echo "The number is positive.\n";
}elseif($number < 0 ){
    echo "The number is negative.\n";
}else{
    echo "The number is zero.\n";    
}
