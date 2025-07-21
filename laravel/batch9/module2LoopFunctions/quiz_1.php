<?php

$questions = [
    ['questions' => 'what is 2+2 ' , 'correct'=>'4'],
    ['questions' => 'what is the capital of bd ' , 'correct'=>'dhaka'],
    ['questions' => ' who wrotes agnibina ' , 'correct'=>'nazrul'],
];

$answers = [] ;

foreach($questions as $index => $question)
    {
      echo ($index + 1 ). "." .$question['questions']. "\n";
      $answers[] = trim(readline("Your Answer : ")) ;

    }


    function evaluateQuiz(array $questions , array $answers  ):int
    {
        $score = 0 ;
        foreach($questions as $index => $question){

            echo "User Answer : " . $answers[$index] . "\n" ;
            echo "Correct Answer : " . $question['correct'] . "\n" ;

            if( $answers[$index] === $question['correct'] ){
                $score++ ;
            }
        }
   
        // var_dump($score);
        return "hello" ; 

    }

  
    $myScore = evaluateQuiz($questions , $answers) ;
   
    echo "\n You scored $myScore out of ". count($questions). ".\n";


    if( $myScore  === count($questions)){
        echo "Ecellent Job : ! \n" ;
    }elseif($myScore >= 1){
        echo "Good effort ! \n";
    }else{
        echo "Your result is fail , Try Latter \n" ;
    }

    