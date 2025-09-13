<?php

$questions = [

    ['question' => " what is 2+2 " , "correct" => "4"],
    ['question' => " what is the capital of bd " , "correct" => "dhaka"],
    ['question' => " what is the native language of bd " , "correct" => "bangla"]
    
];

$answers = [] ;

function evaluateQuiz( array $questions , array $answers ):int
{
    $score = 0 ;
    foreach(  $questions as $index => $question  ){
        if(  $answers[$index] === $question["correct"] ){
            $score++ ;
        }
    }
    return $score ;
}


foreach( $questions as $index => $question ){
    echo ($index+1). ". " .$question["question"];
       $answers[] = trim(readline("Your Answer : ")) ;
}


$score = evaluateQuiz(  $questions ,  $answers ) ;

echo "\nYou Scored $score  out of " .count($questions)."\n" ;

if($score === count($questions)){
    echo "Execellen Job !\n" ;
}elseif( ( $score >= 1 ) && ( $score < 3 ) ){
    echo "Good Efort !\n" ;
}else{
    echo "Better Luck Next time !\n" ;
}