<?php

/*
    __DIR__ ব্যবহার করলে শুরুতেই / থাকবে, কারণ এটা absolute path রিটার্ন করে।
    echo __DIR__;   // বর্তমান ফাইলের ফোল্ডার path দেখাবে
    echo __FILE__;  // বর্তমান ফাইলের পুরো path (ফাইল নাম সহ) দেখাবে

    var_dump($filePath);
    🔹 file_put_contents() কী?

PHP-এর একটি বিল্ট-ইন ফাংশন যা কোনো ফাইলের ভেতর ডেটা লিখতে ব্যবহার করা হয়।
এটা এক লাইনে ফাইল ওপেন + ডেটা লিখে + ফাইল বন্ধ করে দেয়।

👉 মানে fopen(), fwrite(), fclose() — এই তিনটার shortcut হলো file_put_contents()।

-- file_exists() কী? PHP-র একটা built-in function, যেটা দিয়ে চেক করা হয় কোনো ফাইল (বা ডিরেক্টরি) আছে কিনা।
এটা true বা false রিটার্ন করে।

🔹 json_encode() কী?

PHP-তে json_encode() হলো এমন একটা ফাংশন যেটা PHP এর array / object কে JSON string এ রূপান্তর করে।
    -- PHP-তে json_decode() হলো এমন একটি ফাংশন যা JSON string কে PHP array বা object এ রূপান্তর করে।
    -- true দিলে associative array, false দিলে object

    -- json_decode() ফাংশন JSON string কে PHP variable (array বা object) এ রূপান্তর করে।

*/

trait FileHandler {
    private $filePath = __DIR__ . "/../../data/vehicles.json";

    public function readFile() {
        if(!file_exists($this->filePath)){
            file_put_contents($this->filePath, json_encode([]));
        }
        return json_decode(file_get_contents($this->filePath), true);
    }

    public function writeFile($data) {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}


/*
private $filePath → একটি class property, যা শুধু সেই ক্লাসের ভেতর থেকে অ্যাক্সেস করা যাবে।

__DIR__ → একটি magic constant; এটি বর্তমান PHP ফাইল যেখানে আছে সেই ফোল্ডারের absolute path রিটার্ন করে।

/var/www/project/app/controllers

"/../../data/vehicles.json" → মানে হলো বর্তমান ফাইল থেকে ২টা ফোল্ডার উপরে গিয়ে data ফোল্ডারের মধ্যে থাকা vehicles.json ফাইল।
👉 কাজ: এই লাইনটি $filePath প্রোপার্টিতে vehicles.json ফাইলের path সংরক্ষণ করে, যাতে পরে ডেটা পড়া/লেখা করা যায়।


🔹 কখন Trait ব্যবহার করবেন?

Trait সাধারণত তখন ব্যবহার করা হয় যখন:

Multiple classes–এ একই ধরনের function দরকার হয়

ধরুন, User, Admin, Customer – এই তিনটা class–এ একই logActivity() বা sendEmail() method দরকার।

Inheritance করলে একটাই parent class পাওয়া যায়, কিন্তু একাধিক জায়গায় একই code reuse করতে চাইলে Trait ভালো সমাধান।

Code DRY (Don't Repeat Yourself) রাখতে চাইলে

বারবার একই function লিখতে না হয়ে trait–এ একবার লিখে রেখে যেকোনো class–এ reuse করা যায়।

Multiple inheritance-এর সীমাবদ্ধতা কাটাতে

PHP তে এক class শুধু একটিই parent class extend করতে পারে।

কিন্তু Trait use করলে আপনি একাধিক Trait এক class–এ ব্যবহার করতে পারবেন।
*/