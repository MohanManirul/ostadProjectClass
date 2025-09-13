<?php


// C/5 = ((F-32) / 9); 

const FACTOR =  9/5 ;
const OFFSET = 32 ;


echo "Enter Your Temparature : " ;
$temparature = (float)readline();

echo "Convert to (F: Farenheit, C: Celcius)" ;

$choice = readline();


switch($choice){
    case "F":
        $result = $temparature * FACTOR + OFFSET ;
        echo "Temparature in Farenheit : $result"  ;
        break;
    
    
    case "C":
        $result = ($temparature - OFFSET) / FACTOR ;
        echo "Temparature in Celcius : $result"  ;
        break;
    
    default :
        echo "Invalid Choice "  ;
        break;
    
    
}