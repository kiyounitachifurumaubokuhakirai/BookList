<?php
  require_once('sql_parent.php');

  class levelModel extends BaseModel {

    //コンストラクタ
    public function __construct() {
      parent::__construct();    //親クラスのコンストラクタを呼び出す
    }



    //デストラクタ
    public function __destruct() {
      parent::__destruct();   //親クラスのデストラクタを呼び出す
    }



    //レベル登録
    public function addLevel($level) : void {
      $sql = 'INSERT INTO level_list (level) VALUES(?)';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $level;
      $stmt->execute($data);
    }



    //全レベル取得（削除されたもの（is_deleted=1）は除く）
    public function getAllLevel() : array {
      $sql = 'SELECT id, level FROM level_list WHERE is_deleted=0 ORDER BY level DESC';
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



    //レベル名検索（曖昧検索）
    public function searchLikeLevel($level) : array {
      $likeGenre = [];

      $sql = "SELECT * FROM level_list WHERE is_deleted=0 and level like ?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = "%".$level."%";
      $stmt->execute($data);

      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $likeLevel[] = $rec;
      }

      return $likeLevel;
    }



      //レベル名検索（id検索）
    public function searchLevelFromID($id)  {
      $sql = "SELECT level FROM level_list WHERE id=?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $id;
      $stmt->execute($data);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //削除  (is_deleted = 1 とする)
    public function deleteLevel($level_id) : void {
      $sql = 'UPDATE level_list set is_deleted=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $level_id;
      $stmt->execute($data);
    }
    
  }
?>