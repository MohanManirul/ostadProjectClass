<?php
$names = [
    "Md. Manirul Islam", "Fatima Noor", "Rashed Khan", "Nadia Akter", "Sajid Hossain",
    "Tania Rahman", "Rifat Ahmed", "Sohana Begum", "Jahid Hasan", "Sumaiya Khatun",
    "Fahim Al Mamun", "Nafisa Jahan", "Shahriar Karim", "Mousumi Sultana", "Arifur Rahman",
    "Mim Nahid", "Tareq Chowdhury", "Rumana Akter", "Habib Ullah", "Lamia Rahman",
    "Sabbir Hossain", "Shirin Akter", "Kamrul Hasan", "Sadia Parvin", "Rakibul Islam",
    "Farhana Ahmed", "Jewel Rana", "Nabila Hossain", "Imran Mahmud", "Afsana Rahman",
    "Rony Karim", "Moushumi Chowdhury", "Shakil Ahmed", "Rina Akter", "Fahad Hossain",
    "Sumona Islam", "Sabbah Rahman", "Mahfuzur Rahman", "Nusrat Jahan", "Tanzim Ahmed",
    "Sonia Akter", "Shahriar Hossain", "Lina Parvin", "Arman Karim", "Roksana Sultana",
    "Hasibul Islam", "Shapla Akter", "Fahim Reza", "Anika Chowdhury", "Tamim Rahman",
    "Nishat Jahan", "Rifat Hasan", "Farzana Akter", "Tanvir Rahman", "Mim Chowdhury",
    "Sajib Hossain", "Nadia Karim", "Shahin Ahmed", "Rumana Sultana", "Arif Rahman"
];

$totalNames = count($names) ;


for($a = 0 ; $a<$totalNames ; $a++){
    echo $a .". ". $names[$a] ."\n" ;
}