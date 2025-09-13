
<?php

/* 
-- এ লাইনটি একটি কনস্ট্যান্ট TASKS_FILE তৈরি করছে এবং এর মান 'tasks.json' সেট করছে 
- const ব্যবহার করা হয়েছে কারণ TASKS_FILE এর মান পরিবর্তন হবে না। অর্থাৎ, 'tasks.json' ফাইলের নাম প্রোগ্রামের চলাকালীন কোনো সময় বদলানোর দরকার নেই।
*/
const TASKS_FILE = 'tasks.json'; 

 /* 
-- file_put_contents হলো একটি PHP ফাংশন যা নির্দিষ্ট ফাইলে ডেটা লিখে দেয়। এটি ফাইল তৈরি বা ওপেন করে ভিতরে লেখা কাজ করে। 
-- json_encode হলো একটি PHP ফাংশন যা PHP অ্যারে বা অবজেক্টকে JSON ফরম্যাটের স্ট্রিংয়ে রূপান্তর করে।
-- JSON_PRETTY_PRINT হলো একটি অপশন যা json_encode-এর সাথে ব্যবহার করলে JSON ডেটাকে সুন্দরভাবে, indentation সহ পড়তে সুবিধাজনকভাবে ফরম্যাট করে।

*/

function saveTasks(array $tasks):void
{
    file_put_contents(TASKS_FILE, json_encode($tasks,JSON_PRETTY_PRINT)) ;
}


 /* 
 -- file_get_contents হলো একটি PHP ফাংশন যা নির্দিষ্ট ফাইলের সম্পূর্ণ কন্টেন্ট একবারে পড়ে একটি স্ট্রিং হিসেবে ফিরিয়ে দেয়। .
 -- json_decode হলো একটি PHP ফাংশন যা JSON স্ট্রিংকে PHP অ্যারে বা অবজেক্টে রূপান্তর করে।
 -- json_decode($data, true) হলো PHP ফাংশন যা JSON স্ট্রিং $data-কে অ্যাসোসিয়েটিভ অ্যারে হিসেবে রূপান্তর করে।
 */

function loadTasks(){
    if(!file_exists(TASKS_FILE)){
        return [] ;
    }
    $data =  file_get_contents(TASKS_FILE);
    return $data ? json_decode($data,true) : [] ;
}

$tasks = loadTasks();

echo '<pre>';
var_dump($tasks);
echo '</pre>';

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

// echo '<pre>';
// var_dump($_SERVER['REQUEST_METHOD']);
// echo '</pre>';

/* 
-- $_SERVER হলো একটি PHP সুপারগ্লোবাল অ্যারে যা সার্ভার এবং এক্সিকিউশন এনভায়রনমেন্ট সম্পর্কিত ইনফরমেশন রাখে।
-- $_SERVER['REQUEST_METHOD'] হলো একটি PHP এক্সপ্রেশন যা বর্তমান HTTP রিকোয়েস্টের মেথড (যেমন GET, POST) ফেরত দেয়।
-- header('Location:' . $_SERVER['PHP_SELF']); এই লাইনটি বর্তমান পেজকে রিফ্রেশ বা রিডাইরেক্ট করে আবার নিজের URL-এ পাঠায়।
-- $_POST হলো একটি PHP সুপারগ্লোবাল অ্যারে যা HTTP POST রিকোয়েস্ট থেকে পাঠানো ডেটা ধারণ করে।
-- unset হলো একটি PHP ফাংশন যা ভেরিয়েবল বা অ্যারের আইটেমকে মেমোরি থেকে মুছে দেয়।
-- array_values হলো একটি PHP ফাংশন যা অ্যারের সব ভ্যালুগুলোকে নতুন অ্যারেতে সাজিয়ে ফেরত দেয়, ইনডেক্স পুনঃনির্ধারণ করে।
-- isset($_POST['task']) চেক করে POST রিকোয়েস্টে 'task' নামে ইনপুট ফিল্ড আছে কি না এবং সেটির মান সেট করা আছে কি না।
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['task']) && !empty(trim($_POST['task']))){
        // var_dump($_POST['task']) ; // browser e data dekhabo
        // exit ;
        $tasks[] = [
            "task" => trim($_POST['task']),
            "done" => false
        ];
        saveTasks($tasks) ;
        header('Location:' . $_SERVER['PHP_SELF']) ;
        exit ;
    }elseif(isset($_POST['delete'])){
        unset($tasks[$_POST['delete']]);
        $tasks = array_values($tasks) ;
        saveTasks($tasks) ;
        header('Location:' . $_SERVER['PHP_SELF']) ;
        exit ;
    }elseif(isset($_POST['toggle'])){

        $tasks[$_POST['toggle']]['done'] = !$tasks[$_POST['toggle']]['done'];
        saveTasks($tasks) ;
        header('Location:' . $_SERVER['PHP_SELF']) ;
        exit ;
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
                 <!-- : শুরু করে কোড ব্লক এবং শেষে endif; দিয়ে ব্লক শেষ করা হয়। এটা HTML-এর মধ্যে PHP লিখতে সহজ করে। -->
                <?php if(empty($tasks)) : ?>
                    <li>No tasks yet. Add one above!</li>
                <?php else :?>
                   <?php foreach($tasks as $index => $task):?>
                    <li class="task-item">
                            <form method="POST" style="flex-grow: 1;">
                                <input type="hidden" name="toggle" value="<?= $index?>">
                           
                                <button type="submit" style="border: none; background: none; cursor: pointer; text-align: left; width: 100%;">
                                <span class="task  <?php echo $task['done']? 'task-done' : '' ?>">
                                <?= $index?>  <?= $task['task']?> 
                                </span>
                            </button>
                        </form>
               
                        <form method="POST">
                            <input type="hidden" name="delete" value="<?= $index?>">
                            <button  type="submit" class="button button-outline" style="margin-left: 10px;">Delete</button>
                        </form>
                    </li>
               
                 <?php endforeach ;?>
               <?php endif ; ?>
                   

            </ul>

        </div>
    </div>
</body>
</html>