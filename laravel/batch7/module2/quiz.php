<?php

    function evaluateQuiz(array $questions , array $answers):int
    {
        $score = 0 ;
        foreach( $questions as $index => $question){
            if($answers[$index] === $question['correct']){
                $score++ ;
            }
        }
       return $score ;
    }

    // example questions
    $questions = [

        ['question' => 'what is 2+2', 'correct'=>'4'],
        ['question' => 'what is the capital of France', 'correct'=>'Paris'],
        ['question' => 'who wrotes "Hamlet"', 'correct'=>'Shakespeare'],

    ];

    $answers = [] ;
    foreach($questions as $index => $question ){
        echo( $index + 1 ) . ". " . $question['question'] . "\n";
        $answers[] = trim(readline("Your answer: ")) ;

    }

    // calculate score and provide feedback
    $score = evaluateQuiz( $questions , $answers ) ;

    echo "\nYou scored $score out of " . count($questions) . ".\n" ;

    if( $score === count($questions) ){
        echo "Execellent Job !\n";
    }elseif( $score > 1){
        echo "Good Effort !\n";
    }else{
        echo "Better Luck next time !\n";
    }