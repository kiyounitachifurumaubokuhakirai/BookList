<?php
  require_once('sql_parent.php');

  class StaffModel extends BaseModel {

    //コンストラクタ
    public function __construct() {
      parent::__construct();    //親クラスのコンストラクタを呼び出す
    }



    //デストラクタ
    public function __destruct() {
      parent::__destruct();   //親クラスのデストラクタを呼び出す
    }



    //login check
    public function LoginCheck($staff, $pass) : bool {
      $flag=FALSE;

      $sql = 'SELECT password FROM staffs_list WHERE username=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $staff;
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      //認証処理
      if(password_verify($pass, $rec['password']))  $flag = TRUE;

      return $flag;
    }



    //staff追加
    public function AddStaff($staff_name, $user_name, $non_hash_pass){
      $hash_pass = password_hash($non_hash_pass, PASSWORD_DEFAULT);

      $sql = 'INSERT INTO staffs_list (name, username, password) VALUES(?, ?, ?)';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $staff_name;
      $data[] = $user_name;
      $data[] = $hash_pass;
      $stmt->execute($data);
    }


  }
?>