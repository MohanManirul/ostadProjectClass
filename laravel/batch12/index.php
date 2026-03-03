<?php
$name = 'Habib' ;
$marks = 67 ;

//--- if-else -----
if($marks>=40){
    $status = 'Pass' ;
}else{
   $status = 'Fail' ; 
}

//--- nested if else ---
if($marks >= 80){
    $grade = 'A+' ;    
}elseif($marks <= 79 && $marks >= 70){
    $grade = 'A' ;
}elseif($marks <= 69 && $marks >= 60){
    $grade = 'A-' ;
}elseif($marks <= 59 && $marks >= 50){
    $grade = 'B' ;
}elseif($marks <= 49 && $marks >= 40){
    $grade = 'C' ;
}

//----- scholarship ----

$comment = ($marks >= 60) ? 'Good Result' : 'Need Improvement' ;

$scholarship = ($marks>=80)? 'Yes' : (($marks>=60)? 'Maybe' : 'No') ;

//-------- switch case ------

switch($grade){

    case 'A+':
        $message = 'Execellent';
        break;

    case 'A':
        $message = 'Very Good';
        break;

    case 'A-':
        $message = 'Good';
        break;

    case 'B':
        $message = 'Average';
        break;

    case 'C':
        $message = 'Poor';
        break;

    default:
    $message = 'Fail';
}

$report = sprintf(
    "Name : %s\nMarks: %d\nGrade: %s\nStatus: %s\nScholarship: %s\nComment: %s\n",
    $name,
    $marks,
    $grade,
    $status,
    $scholarship,
    $comment
);

// --- printf ----
printf("------- Student Result ------\n") ;
printf($report) ;
printf("Message : %s\n", $message) ;

