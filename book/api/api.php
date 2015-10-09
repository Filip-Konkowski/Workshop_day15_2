<?php
//dirname(__FILE__) --> wyciąga nam ścieżkę katalogu a po kropce dodajemy że ma wyjść jeden
// katalog wyżej a następnie wejść do katalogu konfig
require_once(dirname(__FILE__) . '/../config/db.php');

// łączymy sie z baza danych
$db = new mysqli('db_host', 'db_user', 'db_password', 'db_db', 'db_port');
if ($db->connect_error){
    echo $db->connect_error . ' ' . $db->connect_errno;
}
echo 'dziala';


//przetworzyc odebrane dane ajaxem z formularza PUT/POST/DELETE/GET

//tworzymy obiekt klasy book i wykonujemy operacje