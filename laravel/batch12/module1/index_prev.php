<?php
$name = "Manirul";

//echo 'Hello $name';    // Hello $name browser + terminal
echo "Hello $name";      // Hello Manirul browser + terminal

echo "Line1\nLine2";     // terminal e নতুন লাইনে যাবে browser e zabe na

echo "Line1<br/>Line2<br/>"; // 

// String interpolation মানে হলো — 👉 string-এর ভিতরেই variable-এর value ঢুকিয়ে দেওয়া (automatic replace করা)। ✅ PHP তে String Interpolation (শুধু double quote এ কাজ করে) . ❌ Single quote এ কাজ করে না . কারণ single quote ' ' variable চিনে না। 
$age = 25;
echo "I am {$age} years old";

/** 
 * 📌 JavaScript এও same concept
    * let name = "Rahim";
    * console.log(`Hello ${name}`);
    *এখানে backtick ( ) + ${} = interpolation।
 * 
 * **/

