<?php
$score = 0;

$questions = [
    [
        'question' => "1. What is the primary purpose of the const in PHP?",
        'options' => [
            'a' => 'To declare multiple same named variable',
            'b' => 'To define a constant variable',
            'c' => 'To create a function',
            'd' => 'To include external files'
        ],
        'answer' => 'b'
    ],
    [
        'question' => "2. What will be the output of the following PHP code?\n\n<?php\n  echo (10 + 5) * 2;\n?>",
        'options' => [
            'a' => '20',
            'b' => '30',
            'c' => '15',
            'd' => '25'
        ],
        'answer' => 'b'
    ],
    [
        'question' => "3. Which statement about printf() in PHP is true?",
        'options' => [
            'a' => 'It outputs formatted text directly to the browser',
            'b' => 'It returns a formatted string without printing it',
            'c' => 'It can only handle integers',
            'd' => 'It requires a minimum of two arguments'
        ],
        'answer' => 'a'
    ]
];

$i = 0;
while ($i < count($questions)) {
    $q = $questions[$i];
    echo "\n" . $q['question'] . "\n";

    foreach ($q['options'] as $key => $option) {
        echo "  $key) $option\n";
    }

    $userAnswer = strtolower(readline("Your answer (a/b/c/d): "));

    if ($userAnswer === $q['answer']) {
        echo "✅ Correct!\n";
        $score++;
    } else {
        echo "❌ Wrong! Correct answer: {$q['answer']}) {$q['options'][$q['answer']]}\n";
    }

    $i++;
}

echo "\n🎉 Quiz finished! Your score: $score / " . count($questions) . "\n";
