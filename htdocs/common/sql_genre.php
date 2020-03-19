<?php
  require_once('sql_parent.php');

  class genreModel extends BaseModel {

    //コンストラクタ
    public function __construct() {
      parent::__construct();    //親クラスのコンストラクタを呼び出す
    }



    //デストラクタ
    public function __destruct() {
      parent::__destruct();   //親クラスのデストラクタを呼び出す
    }



    //ジャンル登録
    public function addGenre($genre) : void {
      $sql = 'INSERT INTO genre_list (genre) VALUES(?)';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $genre;
      $stmt->execute($data);
    }



    //全ジャンル取得（削除されたもの（is_deleted=1）は除く）
    public function getAllGenre() : array {
      $sql = 'SELECT id, genre FROM genre_list WHERE is_deleted=0 ORDER BY genre ASC';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute();

      $genre = [];

      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $genre[] = $rec;
      }

      return $genre;
    }



    //ジャンル名検索（曖昧検索）
    public function searchLikeGenre($genre) : array {
      $likeGenre = [];

      $sql = "SELECT * FROM genre_list WHERE is_deleted=0 and genre like ?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = "%".$genre."%";
      $stmt->execute($data);

      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $likeGenre[] = $rec;
      }

      return $likeGenre;
    }



      //ジャンル名検索（id検索）
    public function searchGenreFromID($id)  {
      $sql = "SELECT genre FROM genre_list WHERE id=?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $id;
      $stmt->execute($data);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //削除  (is_deleted = 1 とする)
    public function deleteGenre($genre_id) : void {
      $sql = 'UPDATE genre_list set is_deleted=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $genre_id;
      $stmt->execute($data);
    }
    
  }
?>