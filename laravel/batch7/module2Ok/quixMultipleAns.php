<?php
// 1. Asks a set of predefined questions to the user.
$questions = [
    [
        'question' => 'What is 2+2?',
        'options'  => ['3', '4', '5', '6'],
        'correct'  => '4'
    ],
    [
        'question' => 'What is the capital of France?',
        'options'  => ['London', 'Paris', 'Rome', 'Berlin'],
        'correct'  => 'Paris'
    ],
    [
        'question' => 'Who wrote "Hamlet"?',
        'options'  => ['Shakespeare', 'Dickens', 'Hemingway', 'Tolstoy'],
        'correct'  => 'Shakespeare'
    ]
];

function evaluateQuiz(array $questions, array $answers): int
{
    $score = 0;
    foreach ($questions as $index => $question) {
        if ($answers[$index] === $question['correct']) {
            $score++;
        }
    }
    return $score;
}

$answers = [];

// Display questions with options
foreach ($questions as $index => $question) {
    echo ($index + 1) . ". " . $question['question'] . "\n";
    foreach ($question['options'] as $key => $option) {
        echo "  " . ($key + 1) . ". $option\n";
    }

    // Get user input
    do {
        $input = (int)trim(readline("Your answer (1-4): "));
    } while ($input < 1 || $input > 4);  // Validate input range

    $answers[] = $question['options'][$input - 1]; // Store selected option
}

// Calculate score and provide feedback
$score = evaluateQuiz($questions, $answers);
echo "\nYou scored $score out of " . count($questions) . ".\n";

if ($score === count($questions)) {
    echo "Excellent Job!\n";
} elseif ($score > 1) {
    echo "Good Effort!\n";
} else {
    echo "Better luck next time!\n";
}
