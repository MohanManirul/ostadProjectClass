<?php

// Input data
$name = "Rahim";
$marks = 67;

// ---------- If Else ----------
if ($marks >= 40) {
    $status = "Pass";
} else {
    $status = "Fail";
}

// ---------- Nested If Else (Grade) ----------
if ($marks >= 80) {
    $grade = "A+";
} elseif ($marks >= 70) {
    $grade = "A";
} elseif ($marks >= 60) {
    $grade = "A-";
} elseif ($marks >= 50) {
    $grade = "B";
} elseif ($marks >= 40) {
    $grade = "C";
} else {
    $grade = "F";
}

// ---------- Ternary Operator ----------
$comment = ($marks >= 60) ? "Good Result" : "Need Improvement";

// ---------- Nested Ternary ----------
$scholarship = ($marks >= 80) ? "Yes" : (($marks >= 60) ? "Maybe" : "No");

// ---------- Switch Case ----------
switch ($grade) {
    case "A+":
        $message = "Excellent!";
        break;
    case "A":
        $message = "Very Good!";
        break;
    case "A-":
        $message = "Good!";
        break;
    case "B":
        $message = "Average!";
        break;
    case "C":
        $message = "Poor!";
        break;
    default:
        $message = "Failed!";
}

// ---------- sprintf ----------
$report = sprintf(
    "Name: %s\nMarks: %d\nGrade: %s\nStatus: %s\nScholarship: %s\nComment: %s\n",
    $name,
    $marks,
    $grade,
    $status,
    $scholarship,
    $comment
);

// ---------- printf ----------
printf("------ Student Result ------\n");
printf($report);
printf("Message: %s\n", $message);

?>
