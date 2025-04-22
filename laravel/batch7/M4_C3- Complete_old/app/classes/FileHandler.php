<?php

/*---
__DIR__ হলো PHP-র একটি ম্যাজিক কনস্ট্যান্ট (magic constant), যার কাজ হলো:
👉 বর্তমান স্ক্রিপ্ট ফাইল যেখানে আছে, সেই ডিরেক্টরির সম্পূর্ণ পাথ (full path) রিটার্ন করা।
ধরো, তুমি একটি ফাইল লিখেছো /var/www/html/project/index.php এই লোকেশনে।
echo __DIR__;
আউটপুট হবে: /var/www/html/project
এটি কবে ব্যবহার হয়?
✅ যখন তুমি কোনো ফাইল ইনক্লুড করছো (include / require) এবং চাইছো রিলেটিভ পাথের পরিবর্তে একদম নির্ভুল (absolute) পাথ দিতে।
 --*/
   
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
