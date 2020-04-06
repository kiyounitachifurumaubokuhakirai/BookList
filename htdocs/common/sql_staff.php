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
    public function LoginCheck($staff, $pass) {
      $sql = 'SELECT id, password FROM staffs_list WHERE username=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $staff;
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      //認証処理
      if(password_verify($pass, $rec['password']))  return $rec['id'];

      return 0;
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



    //staffの名前を取得
    public function getStaffName($username, $non_hash_pass)  {
      $sql = "SELECT name, password FROM staffs_list WHERE username=?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $username;
      $stmt->execute($data);

      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        elseif(password_verify($non_hash_pass, $rec['password'])) return $rec['name'];
      }
    }



    //編集
    public function editStaff($id, $use_name, $new_pass) {
      $data = [];
      $data[] = $user_name;

      if($new_pass==""){
        $data[] = $new_pass;
        $sql = "UPDATE staffs_list SET username=?, password=? WHERE id=?";
      }
      else  $sql = "UPDATE staffs_list SET username=? WHERE id=?";

      $stmt = $this->dbh->prepare($sql);
      $stmt->execute($data);
    }




    //削除  (is_deleted = 1 とする)
    public function deleteStaff($id) : void {
      $sql = 'UPDATE staffs_list SET is_deleted=1 where id=?';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $id;
      $stmt->execute($data);
    }
  }

?>