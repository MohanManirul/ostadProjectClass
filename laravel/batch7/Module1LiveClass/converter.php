<?php
// C/5 = F-32 /9 ;

define("FACTOR", 9/5);
define("OFFSET", 32);

echo "Temparature Value : ";

$temparature = (float)readline() ;
echo "Convert to (F: Fahrenheit, C: Celcius) : ";
$choice = readline();

switch($choice){
    case "F":
        $result = $temparature * FACTOR + OFFSET;
        echo "Temparature in Fahrenheit : $result\n";
        break ;
    
    case "C":
        $result = ($temparature- OFFSET) / FACTOR ;
        echo "Temparature in Celcius : $result\n";
        break ;
    
    default:
        echo "Invalid Choice" ;
        break ;

}



