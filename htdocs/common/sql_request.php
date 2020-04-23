<?php
  require_once('sql_parent.php');

  class RequestModel extends BaseModel {

    //コンストラクタ
    public function __construct() {
      parent::__construct();    //親クラスのコンストラクタを呼び出す
    }



    //デストラクタ
    public function __destruct() {
      parent::__destruct();   //親クラスのデストラクタを呼び出す
    }



    /**
     * リクエストを登録
     */
    public function registryRequest($contributor, $request) : void {
      $sql = 'INSERT INTO requests_list (contributor, request) VALUES(?, ?)';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $contributor;
      $data[] = $request;
      $stmt->execute($data);
    }



    //削除  (is_deleted = 1 とする)
    public function deleteRequest($request_id) : void {
      $sql = 'UPDATE requests_list set is_deleted=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $request_id;
      $stmt->execute($data);
    }



    //完了 (os_completed = 1 とする)
    public function completeRequest($request_id) : void {
      $sql = 'UPDATE requests_list set is_completed=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $request_id;
      $stmt->execute($data);
    }



    //編集
    public function editRequest($book_id, $book_name, $genre, $level, $isbn, $correction) : void {
      $sql = "UPDATE books 
              set book_name ='".$book_name."',
                  genre='".$genre."', 
                  level='".$level."',
                  isbn='".$isbn."',
                  correction='".$correction."' 
              where id=?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $book_id;
      $stmt->execute($data);
    }



    //検索（要：修正）
    public function searchBooks(){

    }



    //全データ取得（削除されたもの（is_deleted=1）は除く）
    public function getAllrequest() : array {
      $sql = 'SELECT id, request, contributor, is_completed, update_date_time
              FROM requests_list
              WHERE is_deleted=0
              ORDER BY is_completed ASC, update_date_time DESC ';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute();

      $requests = [];
      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        $requests[] = $rec;
      }

      return $requests;
    }



    //未完了のリクエストがあるか否か  (未完了がある：0, 未完了がない：1)
    public function isAllCompletedRequest() : bool {
      $sql = 'SELECT id FROM requests_list WHERE is_completed=0 AND is_deleted=0';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute();

      $requests = [];
      while(TRUE){
      $rec = [];
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if($rec == FALSE) break;
      $requests[] = $rec;
      }

      if($requests)  return FALSE; //未完了がある
      else  return TRUE;
    }
    
  }