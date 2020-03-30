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



    //ジャンル名検索（曖昧検索） $idによるgenreは除く
    public function searchLikeGenre($id, $genre) : array {
      $likeGenre = [];
      $data = [];

      if($id){
        $data[] = $id;
        $sql = "SELECT * FROM genre_list WHERE is_deleted=0 and id!=? and genre like ?";
      } 
      else  $sql = "SELECT * FROM genre_list WHERE is_deleted=0 and genre like ?";
      
      $data[] = "%".$genre."%";
      $stmt = $this->dbh->prepare($sql);
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



    //ジャンル名検索 (重複確認) $idによるgenreは除く
      //TRUE  : 重複あり
      //FALSE : 重複なし
    public function searchGenre($id, $genre) : bool {
      $data = [];
      if($id){
        $sql = "SELECT * FROM genre_list WHERE is_deleted=0 and id!=? and genre=?";
        $data[] = $id;
      }
      else  $sql = "SELECT * FROM genre_list WHERE is_deleted=0 and genre=?";
      $data[] = $genre;
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($data);

      $repetition = [];
      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $repetition[] = $rec;
      }

      if($repetition) return TRUE;
      else  return FALSE;
    }



    //削除  (is_deleted = 1 とする)
    public function deleteGenre($genre_id) : void {
      $sql = 'UPDATE genre_list SET is_deleted=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $genre_id;
      $stmt->execute($data);
    }



    //編集
    public function editGenre($id, $name) : void {
      $sql = 'UPDATE genre_list SET genre=? WHERE id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $name;
      $data[] = $id;
      $stmt->execute($data);
    }

  }
?>