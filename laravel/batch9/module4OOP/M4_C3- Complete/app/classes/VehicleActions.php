<?php


interface VehicleActions {
   public function addVehicle($data);
   public function editVehicle($id, $data);
   public function deleteVehicle($id);
   public function getVehicles();
}

/*
-- PHP তে interface-এ method-এর declaration এবং definition দুইই একসাথে থাকতে পারে না।
Interface হলো একটি কন্ট্রাক্ট (contract) বা চুক্তি যা বলে দেয় যে, কোন ক্লাসে কোন মেথডগুলো অবশ্যই থাকতে হবে।

Interface এ শুধু মেথডের declaration থাকে, body/implementation থাকে না।

এটি মূলত একটি blueprint হিসেবে কাজ করে।

আপনি জানেন গাড়ি start করতে পারবে, কিন্তু engine কিভাবে কাজ করে তা দেখানোর দরকার নেই।

*/