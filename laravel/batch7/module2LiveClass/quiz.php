<?php

function evaluateQuiz(array $questions , array $answers):int
{
    $score = 0 ;
    foreach($questions as $index => $question){
        if($answers[$index] === $question['correct']){
            $score++ ;
        }

    }
    return $score;
}


$questions = [
    ['questions'=> 'what is 2+2' , 'correct'=>'4'],
    ['questions'=> 'what is the capital of france' , 'correct'=>'Paris'],
    ['questions'=> 'who wrotes "Hamlet" ' , 'correct'=>'Shakespeare']
];

$answers = [] ;

foreach($questions as $index => $question){
    echo($index+1). "." . $question['questions']. "\n" ;
    $answers[] = trim(readline("Your Answer : ")) ;
}
// 1.what is 2+2 

$score = evaluateQuiz($questions , $answers );
// $score = 3;

echo "\nYou scored $score out of" .count($questions). ".\n";

if($score === count($questions)){
    echo "Excellent Job !\n";
}elseif($score>=1){
    echo "Good Effort !\n";
}else{
    echo "You result is failed !\n";
}