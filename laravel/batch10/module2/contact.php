<?php


$contacts = [] ;

// name  
// email 
// phone

function addContact( array &$contacts , string $name , string $email , string $phone ):void
{
   $contacts[] = [ "name" => $name , "email" => $email , "phone" => $phone  ];  
}


function displayContacts(array $contacts)
{
    if(empty($contacts)){
        echo "No Contacts Available. \n" ;
    }else{
        foreach( $contacts as $contact ){
            echo    "Name : {$contact['name']} ,
                     Email : {$contact['email']} ,
                     Phone : {$contact['phone']}\n" ;
        }
    }
}

while(true){
    
    echo "\nContact Mnaagement System:\n" ;
    echo "1. Add Contact\n2. View Contacts\n3. Exit\n";

    $choice = (int)readline("Choice an Option : ");

    if( $choice === 1 ){

         $name = (string)readline("Enter Your Name : ");
         $email = (string)readline("Enter Your Email : ");
         $phone = (string)readline("Enter Your Phone : ");

        addContact( $contacts , $name  , $email , $phone );

        echo "$name name added to contacts .\n" ; 
        echo "$email email added to contacts .\n" ; 
        echo "$phone phone added to contacts .\n" ; 
        
    }elseif( $choice === 2 ){

        displayContacts( $contacts ) ;

    }elseif( $choice === 3 ){
        echo "Exiting... \n" ;
    }else{
        echo "Invalid Choice . Please try again . \n" ; 
    }

}