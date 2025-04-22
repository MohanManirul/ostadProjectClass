<?php

define("FACTOR" , 9/5) ;
define("OFFSET" , 32) ;
// এখানে offset বলতে কি বুঝ
// এই কোডে OFFSET বলতে বোঝানো হয়েছে একটি নির্দিষ্ট মান, যা তাপমাত্রা রূপান্তরের (temperature conversion) ক্ষেত্রে প্রয়োজন হয়, বিশেষ করে Celsius থেকে Fahrenheit-এ বা উল্টো করে হিসাব করার সময়।

// কেন define() ব্যবহার করা হলো?

// কারণ FACTOR আর OFFSET হলো এমন মান (value) যা কোডে বারবার ব্যবহার করা হবে, কিন্তু এই মান কখনো পরিবর্তন করা হবে না। এগুলো constant, মানে এগুলোর ভ্যালু একবার সেট করে দিলে পরে আর বদলানো যাবে না।

echo "Enter temperature value: ";
$temperature = (float) readline() ;


// readline() ফাংশন টার্মিনাল থেকে যেই ইনপুট নেয়, সেটা string টাইপের ইনপুট নেয়।
// যেমন, যদি ইউজার 37.5 টাইপ করে, তাহলে readline() আসলে string "37.5" হিসেবে ফেরত দেয়।
// এজন্য এই string-কে আমরা float (decimal সংখ্যা) এ কনভার্ট করে নিচ্ছি।

echo "Convert to (1: Fahrenheit , 2: Celcius): ";
$choice = (int) readline() ;

switch($choice){
    
    case 1 : 
        $result = $temperature * FACTOR + OFFSET ;
        echo "Temperature in Farenheit: $result \n";
        break ;
        
    case 2 : 
        $result = ( $temperature - OFFSET ) /FACTOR ;
        echo "Temperature in Celcius: $result \n";
        break ;
    
    default :       
        echo "Invalid Choice ! \n";
        break ;
    

}