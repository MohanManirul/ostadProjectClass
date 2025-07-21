<?php

echo "Enter a number : ";

$number = (int)readline();
echo "The Number Is". $number ;

// var_dump($number);

if($number > 0){
    echo "The number is positive.\n" ;
}elseif($number < 0){
    echo "The number is negative.\n" ;
}else{
    echo "The number is zero.\n" ;
}



 



