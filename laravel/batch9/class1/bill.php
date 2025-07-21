<?php

// 0 to 100 units = 5 taka
// 101 to 200 units = 10 taka
// above 201 = 15 taka 

echo "Enter Units Consumed : " ;
$units = (int)readline()  ;

if($units <= 100){
    $bill = 100 * 5 ;    
}else if($units <= 200){
    $bill = 100 * 5 +  ( $units- 100) * 10 ;
}else{
    $bill = 100 * 5 + 100 * 10 + ( $units - 200) * 15 ;
}

echo "Total bill : $ $bill" ;