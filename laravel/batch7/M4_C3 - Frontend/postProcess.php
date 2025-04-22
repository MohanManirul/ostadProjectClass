<!-- process.php -->
<?php
// Check if values exist in $_POST
if (isset($_POST['name']) && isset($_POST['age'])) {
    $name = htmlspecialchars($_POST['name']);
    $age = (int) $_POST['age'];

    echo "<h2>Form Submitted with POST Method</h2>";
    echo "Name: " . $name . "<br>";
    echo "Age: " . $age;
} else {
    echo "No data received!";
}
?>
