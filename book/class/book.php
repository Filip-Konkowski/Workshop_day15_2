<?php


class Book {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createBook($data){
        $this->db->query("INSERT INTO books (author, title, description) VALUES ('{$data['bookAuthor']}', '{$data['bookName']}', '{$data['bookDescription']}' )");
        //INSERT INTO books(`author`, `title`, `description`) VALUES ('" . $data['bookAuthor'] . "', '" . $data['bookName'] . "', '" . $data['bookDescription'] . "')");
        //$res = $db->query($sql);
        //$this->db->query($sql);
    }
    public function getBooks($id = null){
        $list= [];
        if ($result = $this->db->query("SELECT * FROM books" . ($id === null ? '' : ' WHERE id=' . $id))) {
            if ($result->num_rows > 0 ) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $list[] = $row;
                }

                /* Frees the memory associated with a result
                free result set */
                $result->free();
            }
        }
        return $list;
    }
    public function getAllBooks(){
        $list= [];
        $sql = 'SELECT * FROM books';
        $result = $this->db->query($sql);
        if ($result = true) {
            if ($result->num_rows > 0 ) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $list[] = $row;
                }

                /* Frees the memory associated with a result
                free result set */
                $result->free();
            }
        }
        return $list;
    }

    public function deleteBooks($id = null){
        $this->db->query("DELETE FROM books ".($id === null ? '' : 'WHERE id=' . $id)); // usuwa książke lub książki z bazy w zależności od tego czy ajax przekazał id lub nie
    }
}