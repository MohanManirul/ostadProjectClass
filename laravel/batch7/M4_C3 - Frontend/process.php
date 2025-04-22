<!-- process.php -->
<?php
// Check if values exist in $_GET
if (isset($_GET['name']) && isset($_GET['age'])) {
    $name = htmlspecialchars($_GET['name']);
    $age = (int) $_GET['age'];

    echo "<h2>Form Submitted with GET Method</h2>";
    echo "Name: " . $name . "<br>";
    echo "Age: " . $age;
} else {
    echo "No data received!";
}
?>
