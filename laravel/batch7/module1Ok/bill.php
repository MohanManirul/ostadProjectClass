<?php
echo "Enter units consumed : ";

$units = (int) readline();

if( $units <= 100 ){
    $bill = $units * 5 ;
}elseif( $units <= 200 ){
    $bill = $units * 5 + ( $units -100 ) * 10 ;
}else{
    $bill = $units * 5 + $units * 10 + ( $units -200 ) * 20 ;
}

echo "Total bill : $$bill\n";