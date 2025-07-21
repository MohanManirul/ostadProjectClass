<?php


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
// trim() PHP-তে একটি string function, যা একটি স্ট্রিংয়ের শুরু ও শেষের ফাঁকা জায়গা (whitespace) মুছে ফেলে।
// (array $questions , array $answers) = parameter

function evaluateQuiz(array $questions , array $answers):int
{
    $score = 0 ;
    foreach($questions as $index => $question){

        echo "User Answer    : " . $answers[$index] . "\n";
        echo "Correct Answer : " . $question['correct'] . "\n\n";

        if($answers[$index] === $question['correct']){
            $score++ ;
        }

    }
    return $score;
}




$score = evaluateQuiz($questions , $answers ); // arguments নিচ্ছে
// $score = 3;

echo "\nYou scored $score out of" .count($questions). ".\n"; 

// এখানে .count($questions). ব্যবহার করার কারণ হলো string concatenation (যোগ) করা।

if($score === count($questions)){
    echo "Excellent Job !\n";
}elseif($score>=1){
    echo "Good Effort !\n";
}else{
    echo "You result is failed !\n";
}