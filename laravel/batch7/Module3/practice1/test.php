<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    // ফর্ম থেকে পাঠানো 'task' মান
    $task = $_POST['task'];
    echo "Submitted task: " . htmlspecialchars($task);
}
?>

<form method="POST">
    <input type="text" name="task" value="Buy milk">
    <button type="submit">Submit</button>
</form>
