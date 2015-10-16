<?php
//dirname(__FILE__) --> wyciąga nam ścieżkę katalogu a po kropce dodajemy że ma wyjść jeden
// katalog wyżej a następnie wejść do katalogu konfig
require_once(dirname(__FILE__) . '/../config/db.php');
require_once(dirname(__FILE__) . '/../class/book.php');

// łączymy sie z baza danych
$db = new mysqli(DB_HOST,  DB_USER, DB_PASSWORD, DB_DB, DB_PORT);

if ($db->connect_error){
    $error = $db->connect_error . '(' . $db->connect_errno . ')';
    $json = json_encode(['error' => $error]);
    echo $json;
}
else{
    $db->set_charset('utf8');
    // przetwarzamy odebrane dane ajaxem z formularza PUT/POST/DELETE/GET
    $method = ($_SERVER["REQUEST_METHOD"]);
    $book = new Book($db);
    switch ($method){
        case "GET":
            $data = $_GET;

            $ret['bookInfo']=$book->getBooks($data['id']);  //pobieramy dane o jednej ksiazce po id i przypisujemy ja do bookInfo
            $ret['success'] = 'Podano poprawne info';
            $ret['bookInfoAll']=$book->getBooks();
            break;
        case "POST":
            $data = $_POST;
            $book->createBook($data);

            $ret['success'] = "Ksiazka zostala poprawnie dodana";
            $ret['bookList'] = $book->getBooks();
            break;
        case "PUT":
            //parse_str(file_get_contents("php://input"), $data);
            break;
        case "DELETE":
            parse_str(file_get_contents("php://input"), $data);
//            $avc = $_sss
            $book->deleteBooks($data['id']);
            $ret['success'] = "Ksiazka zostala poprawnie usunięta";
            $ret['bookList'] = $book->getBooks(); // po usunieciu książki znowy pokazuje liste ksiażek (aktualną)
            break;
    };

    echo json_encode($ret);
}


//przetworzyc odebrane dane ajaxem z formularza PUT/POST/DELETE/GET



//tworzymy obiekt klasy book i wykonujemy operacje