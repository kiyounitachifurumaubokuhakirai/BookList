<?php
  require_once('sql_parent.php');
  require_once('sql_genre.php');

  class BookModel extends BaseModel {

    //コンストラクタ
    public function __construct() {
      parent::__construct();    //親クラスのコンストラクタを呼び出す
    }



    //デストラクタ
    public function __destruct() {
      parent::__destruct();   //親クラスのデストラクタを呼び出す
    }



    //登録
    public function registryBook($book_name, $book_number, $genre, $level, $isbn, $correction, $picture) : void {
      $data = [];
      $data[] = $book_name;
      $data[] = $book_number;
      $data[] = $genre;
      $data[] = $level;
      $data[] = $isbn;

      if($correction != ""){
        $data[] = $correction;
        if($picture != ""){
          $data[] = $picture;
          $sql = 'INSERT INTO book_list (name, book_count, genre_id, level_id, isbn, correction, picture) VALUES(?, ?, ?, ?, ?, ?, ?)';
        }
        else{
          $sql = 'INSERT INTO book_list (name, book_count, genre_id, level_id, isbn, correction) VALUES(?, ?, ?, ?, ?, ?)';
        }
      }
      elseif($correction == ""){
        if($picture != ""){
          $data[] = $picture;
          $sql = 'INSERT INTO book_list (name, book_count, genre_id, level_id, isbn, picture) VALUES(?, ?, ?, ?, ?, ?)';
        }
        else  $sql = 'INSERT INTO book_list (name, book_count, genre_id, level_id, isbn) VALUES(?, ?, ?, ?, ?)';
      }

      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($data);
    }



    //削除  (is_deleted = 1 とする)
    public function deleteBook($book_id) : void {
      $sql = 'UPDATE book_list set is_deleted=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $book_id;
      $stmt->execute($data);
    }



    //編集
    public function editBook($book_id, $book_name, $book_number, $genre, $level, $isbn, $correction, $picture) : void {
        $data = [];
        $data[] = $book_name;
        $data[] = $book_number;
        $data[] = $genre;
        $data[] = $level;
        $data[] = $isbn;
  
        if($correction != ""){
          $data[] = $correction;
          if($picture != ""){
            $data[] = $picture;
            $sql = 'UPDATE book_list SET name=?, book_count=?, genre_id=?, level_id=?, isbn=?, correction=?, picture=? WHERE id=?';
          }
          else{
            $sql = 'UPDATE book_list SET name=?, book_count=?, genre_id=?, level_id=?, isbn=?, correction=? WHERE id=?';
          }
        }
        elseif($correction == ""){
          if($picture != ""){
            $data[] = $picture;
            $sql = 'UPDATE book_list SET name=?, book_count=?, genre_id=?, level_id=?, isbn=?, picture=? WHERE id=?';
          }
          else  $sql = 'UPDATE book_list SET name=?, book_count=?, genre_id=?, level_id=?, isbn=? WHERE id=?';
        }
  
        $data[] = $book_id;

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($data);
      }



    //OR検索（要：修正）
    public function orSearchBooks($bookname, $genre_id, $level_id) : array {
      $data = [];
      $data[] = $genre_id;
      $data[] = $level_id;

      //sql
      $sql = 'SELECT b.id, b.name, g.genre, l.level
                FROM book_list b
                INNER JOIN genre_list g ON b.genre_id = g.id
                INNER JOIN level_list l ON b.level_id = l.id
                WHERE b.is_deleted=0';
      if($bookname != ""){
        $sql .= ' AND (b.genre_id=? OR b.level_id=? OR b.name=?)';
        $data[] = $bookname;
      }
      else{
        $sql .= ' AND (b.genre_id=? OR b.level_id=?)';
      }
      $sql .= ' ORDER BY b.genre_id ASC';

      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($data);

      $result = [];
    
      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $result[] = $rec;
      }

      return $result;
    }


    //AND検索（要：修正）
    public function andSearchBooks($bookname, $genre_id, $level_id) : array {
      $data = [];
      $data[] = $genre_id;
      $data[] = $level_id;

      //sql
      $sql = 'SELECT b.id, b.name, g.genre, l.level
              FROM book_list b
              INNER JOIN genre_list g ON b.genre_id = g.id
              INNER JOIN level_list l ON b.level_id = l.id
              WHERE b.is_deleted=0';

      if($bookname != ""){
        $sql .= ' AND (b.genre_id=? AND b.level_id=? AND b.name=?)';
        $data[] = $bookname;
      }
      else{
        $sql .= 'AND (genre_id AND level_id=?)';
      }
      $sql .= ' ORDER BY b.genre_id ASC';

      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($data);

      $result = [];

      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $result[] = $rec;
      }

      return $result;
    }


    //idによる検索  ←　修正、削除で使用
    public function searchBookWithID($id) : array {
      $sql = 'SELECT b.id, b.name, b.book_count, b.genre_id, g.genre, b.level_id, l.level, b.isbn
          FROM book_list b
          INNER JOIN genre_list g ON b.genre_id = g.id
          INNER JOIN level_list l ON b.level_id = l.id
          WHERE b.id=?';

      $data = [];
      $data[] = $id;

      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($data);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
  }