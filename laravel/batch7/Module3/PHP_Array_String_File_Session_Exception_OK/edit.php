<?php

// Define a constant for the tasks file
define("TASKS_FILE", "tasks.json");

// Function to load tasks
function loadTasks(): array {
    if (!file_exists(TASKS_FILE)) {
        return [];
    }

    $data = file_get_contents(TASKS_FILE);
    return $data ? json_decode($data, true) : [];
}

// Load tasks from the file
$tasks = loadTasks();

// Function to save tasks
function saveTasks(array $tasks): void {
    file_put_contents(TASKS_FILE, json_encode($tasks, JSON_PRETTY_PRINT));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task']) && !empty(trim($_POST['task']))) { 
        // Add a new task
        $tasks[] = [
            'task' => htmlspecialchars(trim($_POST['task'])),
            'done' => false
        ];
        saveTasks($tasks);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['delete'])) {
        // Delete a task
        unset($tasks[$_POST['delete']]);
        $tasks = array_values($tasks);
        saveTasks($tasks);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['toggle'])) {
        // Toggle task completion
        $tasks[$_POST['toggle']]['done'] = !$tasks[$_POST['toggle']]['done'];
        saveTasks($tasks);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['edit_index']) && isset($_POST['edit_task']) && !empty(trim($_POST['edit_task']))) {
        // Edit and update task
        $tasks[$_POST['edit_index']]['task'] = htmlspecialchars(trim($_POST['edit_task']));
        saveTasks($tasks);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    <style>
        body { margin-top: 20px; }
        .task-card {
            border: 1px solid #ececec;
            padding: 20px;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .task { color: #555; }
        .task-done { text-decoration: line-through; color: #888; }
        .task-item { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
        ul { padding-left: 0; }
        button { cursor: pointer; }
        .edit-form { display: none; }
    </style>
    <script>
        function showEditForm(index) {
            document.getElementById('edit-form-' + index).style.display = 'block';
            document.getElementById('task-text-' + index).style.display = 'none';
            document.getElementById('edit-btn-' + index).style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="task-card">
            <h1>To-Do App</h1>

            <!-- Add Task Form -->
            <form method="POST">
                <div class="row">
                    <div class="column column-75">
                        <input type="text" name="task" placeholder="Enter a new task" required>
                    </div>
                    <div class="column column-25">
                        <button type="submit" class="button-primary">Add Task</button>
                    </div>
                </div>
            </form>

            <!-- Task List -->
            <h2>Task List</h2>
            <ul>
                <?php if (empty($tasks)): ?>
                    <li>No tasks yet. Add one above!</li>
                <?php else: ?>
                    <?php foreach ($tasks as $index => $task): ?>
                        <li class="task-item">
                            <!-- Toggle Task Form -->
                            <form method="POST" style="flex-grow: 1;">
                                <input type="hidden" name="toggle" value="<?= $index ?>">
                                <button type="submit" style="border: none; background: none; cursor: pointer; text-align: left; width: 100%;">
                                    <span id="task-text-<?= $index ?>" class="task <?= $task['done'] ? 'task-done' : '' ?>">
                                        <?= htmlspecialchars($task['task']) ?>
                                    </span>
                                </button>
                            </form>

                            <!-- Edit Button -->
                            <button id="edit-btn-<?= $index ?>" class="button button-outline" onclick="showEditForm(<?= $index ?>)">Edit</button>

                            <!-- Edit Task Form -->
                            <form method="POST" id="edit-form-<?= $index ?>" class="edit-form">
                                <input type="hidden" name="edit_index" value="<?= $index ?>">
                                <input type="text" name="edit_task" value="<?= htmlspecialchars($task['task']) ?>" required>
                                <button type="submit" class="button button-outline">Save</button>
                            </form>

                            <!-- Delete Form -->
                            <form method="POST">
                                <input type="hidden" name="delete" value="<?= $index ?>">
                                <button type="submit" class="button button-outline" style="margin-left: 10px;">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>
</html>
