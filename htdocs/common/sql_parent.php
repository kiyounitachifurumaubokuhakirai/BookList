<?php
  require_once('define.php');

  class BaseModel {
    /**  @var object PDOインスタンス*/
    protected $bdh;

    //コンストラクタ
    public function __construct() {
      $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf-8';
      try{
        $this->dbh = new PDO($dsn, DB_USER, DB_PASS);
        $this->dbh->setAttribute(PDO::ATTR_ERROMODE, PDO::ERRORMODE_EXCEPTION);
      }
      catch(exception $e){  //Databaseへの接続へ失敗した場合
        echo $e->getMessage();
        header('');
        exit();
      }
    }

    //デストラクタ
    function __destruct() {
      $this->dbh = null;
    }

    //トランザクションを開始
    public function begin() : void {
      $this->dbh->beginTransaction();
    }
  }
?>