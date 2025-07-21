<?php

const TASKS_FILE = 'tasks.json';

function loadTasks():array
{
    if(!file_exists((TASKS_FILE))){
        return [] ;
    }

    $data = file_get_contents(TASKS_FILE) ;
    return $data ? json_decode($data,true) : [] ;
}

// file_exists(TASKS_FILE)
// → চেক করে ফাইলটি (tasks.json) আছে কিনা।
// → না থাকলে খালি অ্যারে [] রিটার্ন করে।

// file_get_contents(TASKS_FILE)
// → যদি ফাইল থাকে, তাহলে তার ভিতরের ডেটা (JSON ফরম্যাটে থাকা string) পড়ে।

// json_decode($data, true)
// → JSON ডেটাকে অ্যারে (associative array) বানায়।

// যদি $data ফাঁকা হয় (মানে ফাইল ফাঁকা), তাহলে আবার খালি অ্যারে [] রিটার্ন করে।


$tasks = loadTasks();

function saveTasks(array $tasks):void
{
    file_put_contents(TASKS_FILE, json_encode($tasks,JSON_PRETTY_PRINT));
}

// echo "<pre>";
// var_dump($tasks);
// echo "</pre>";
// 👉 এখানে loadTasks() ফাংশন কল করে $tasks ভ্যারিয়েবলে টাস্কগুলোর ডেটা রাখা হচ্ছে।
// মানে, এখন $tasks হলো অ্যারে যেটি tasks.json ফাইল থেকে এসেছে।

// Parameter: array $tasks → এই ফাংশনে একটা টাস্ক অ্যারে ইনপুট নেয়।

// json_encode(..., JSON_PRETTY_PRINT)
// → অ্যারেটিকে সুন্দরভাবে (human readable) JSON ফরম্যাটে কনভার্ট করে।

// file_put_contents(...)
// → JSON ডেটাটিকে tasks.json ফাইলে লিখে ফেলে (save করে)।


    //     $task = $_POST['task'];
    // echo "Task received: " . htmlspecialchars($task);

    // echo $_POST ;

    // echo কেবল string প্রিন্ট করতে পারে।


// echo $_SERVER['REQUEST_METHOD'] ;
//  exit ;



// isset() শুধু চেক করে ভ্যারিয়েবল আছে কিনা এবং null নয় কিনা।
// $_SERVER['PHP_SELF'] হলো বর্তমান স্ক্রিপ্টের নাম (যেমন: /index.php)
// যেটা ব্যবহার করলে নিজের এই পেইজে redirect হয়।
// unset($variable); এটি $variable কে মেমোরি থেকে মুছে ফেলে

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){      

    if(isset($_POST['task']) && !empty(trim($_POST['task']))){

      echo $tasks[] = [
        'task' => htmlspecialchars(trim($_POST['task'])),
        'done' => false
       ] ;
       saveTasks($tasks) ;
        header('Location: ' . $_SERVER['PHP_SELF']); //header("Location: thankyou.php"); header("Location: pages/success.php"); header("Location: https://example.com/welcome.php");
        exit;

    }elseif(isset($_POST['delete'])){

        unset($tasks[$_POST['delete']]);
        $tasks = array_values($tasks);
        saveTasks($tasks) ;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;

    }elseif(isset($_POST['toggle'])){

        $tasks[$_POST['toggle']]['done'] = !$tasks[$_POST['toggle']]['done'];
        saveTasks($tasks) ;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;

    }
}

?>
<!-- UI -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    <style>
        body {
            margin-top: 20px;
        }
        .task-card {
            border: 1px solid #ececec; 
            padding: 20px;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
        }
        .task{
            color: #888;
        }
        .task-done {
            text-decoration: line-through;
            color: #888;
        }
        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        ul {
            padding-left: 20px;
        }
        button {
            cursor: pointer;
        }
    </style>
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
            <ul style="list-style: none; padding: 0;">
                <!-- TODO: Loop through tasks array and display each task with a toggle and delete option -->
                <!-- If there are no tasks, display a message saying "No tasks yet. Add one above!" -->
                <?php if(empty($tasks)): ?>
                     <li>No tasks yet. Add one above!</li>
                    <!-- if there are tasks, display each task with a toggle and delete option -->
                <?php else: ?>
                    <?php foreach($tasks as $index=>$task): ?>
                        <li class="task-item">
                            <form method="POST" style="flex-grow: 1;">
                                <input type="hidden" name="toggle" value="<?= $index ?>">
                           
                                <button type="submit" style="border: none; background: none; cursor: pointer; text-align: left; width: 100%;">
                                    <span class="task <?= $task['done'] ? 'task-done' : '' ?>">
                                        <?= htmlspecialchars(($task['task'])) ?>
                                    </span>
                                </button>
                            </form>

                        <form method="POST">
                            <input type="hidden" name="delete" value="<?=$index?>">
                            <button type="submit" class="button button-outline" style="margin-left: 10px;">Delete</button>
                        </form>
                    </li>
                    <?php endforeach ?>
                <?php endif ;?>
                 
            </ul>
        </div>
    </div>
</body>
</html>