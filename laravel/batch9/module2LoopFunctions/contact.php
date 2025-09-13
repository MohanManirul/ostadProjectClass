<?php

// &$contacts মানে হলো reference parameter ।

// 👉 যখন তুমি ফাংশনের parameter এ & ব্যবহার করো, তখন ওই ভ্যারিয়েবলটা copy হয়ে যায় না, বরং reference হিসেবে পাঠানো হয়।
// মানে, ফাংশনের ভিতরে তুমি যদি $contacts পরিবর্তন করো, তাহলে বাইরের $contacts ও পরিবর্তিত হবে।
// 🔑 সংক্ষেপে:

// & ছাড়া → বাইরের $contacts অপরিবর্তিত থাকবে।

// & সহ → ফাংশনের ভিতরে পরিবর্তন করলে বাইরের $contacts ও আপডেট হবে।

    $contacts = [] ;
    
    // print_r($contacts);
    // var_dump($contacts);
    // var_export($contacts);

    function addContact(array &$contacts , string $name , string $email, string $phone):void
    {
        $contacts[] = ['name' => $name , 'email' => $email, 'phone' => $phone ] ;
    }

    // function to display all contacts 
    function displayContacts(array $contacts): void {
        if (empty($contacts)) {
            echo "No contacts available.\n";
        } else {
            foreach ($contacts as $contact) {
                echo "Name: {$contact['name']}, 
                     Email: {$contact['email']},
                     Phone: {$contact['phone']}\n";
                }
            }
        }

    // terminal based intreface || code this first

    while(true){
        echo "\nContact Management Menu:\n" ;
        echo "1. Add Contact\n2. View Contacts\n3. Exit\n" ;
        $choice = (int)readline("Choice an option: ") ;

        if($choice  === 1 ){
            $name = readline("Enter name: ") ;
            $email = readline("Enter email: ") ;
            $phone = readline("Enter phone number: ") ;
            addContact( $contacts , $name , $email , $phone );
            echo "$name name added to contacts.\n" ;
            echo "$email email added to contacts.\n" ;
            echo "$phone phone added to contacts.\n" ;
        }elseif( $choice  === 2 ){
            displayContacts($contacts) ;
        }elseif( $choice  === 3 ){
            echo "Exiting...\n" ;
            break;
        }else{
            echo "Invalid choice. Please try again.\n" ;
        }
    }