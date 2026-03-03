<?php
// 3D array: [Department][Student][Details]
$departments = [
    "IT" => [
        ["id" => 1, "name" => "Rahim", "course" => "Laravel"],
        ["id" => 2, "name" => "Karim", "course" => "PHP"]
    ],
    "CSE" => [
        ["id" => 3, "name" => "Salma", "course" => "Vue.js"],
        ["id" => 4, "name" => "Nabila", "course" => "React"]
    ]
];

// Access a single value
echo $departments["IT"][0]["name"]; // Rahim

echo "<br><br>All Students:<br>";

// Loop through 3D array
foreach ($departments as $dept => $students) {
    echo "Department: " . $dept . "<br>";
    foreach ($students as $student) {
        echo "ID: " . $student["id"] . 
             ", Name: " . $student["name"] . 
             ", Course: " . $student["course"] . "<br>";
    }
    echo "<br>";
}
?>