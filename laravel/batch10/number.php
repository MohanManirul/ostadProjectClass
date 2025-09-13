<?php


echo "Enter Number : " ;
$number = (int)readline();

if( $number > 0 ){
    echo "The Number is positive" ;
}elseif( $number < 0 ){
     echo "The Number is negative" ;
}else{
     echo "The Number is zero" ;
}
