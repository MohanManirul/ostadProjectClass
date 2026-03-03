<?php
$students = [
    ["id" => 1, "name" => "Rahim", "course" => "Laravel"],
    ["id" => 2, "name" => "Karim", "course" => "PHP"],
    ["id" => 3, "name" => "Salma", "course" => "Vue.js"]
];

// Access single value
echo $students[0]["name"]; // Rahim

echo "<br><br>All Students:<br>";

// Loop through 2D array
foreach ($students as $student) {
    echo "ID: " . $student["id"] . 
         ", Name: " . $student["name"] . 
         ", Course: " . $student["course"] . "<br>";
}
?>