<!-- save as form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POST Method Example</title>
</head>
<body>
    <h2>Submit Your Info</h2>

    <?php
    // POST method দিয়ে ডাটা এসেছে কি না চেক করা
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';

        echo "<h3>Submitted Data:</h3>";
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br><hr>";
    }
    ?>

    <!-- HTML Form -->
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
