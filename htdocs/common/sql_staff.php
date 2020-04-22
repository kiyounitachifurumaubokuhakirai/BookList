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


    /** staff登録
     * @param string $staff_name 氏名
     * @param string $user_name ユーザー名
     * @param string $non_hash_pass パスワード
     * @param string $tuka 合言葉
    */
    public function AddStaff ($staff_name, $user_name, $non_hash_pass, $tuka)
    {
      $hash_pass = password_hash($non_hash_pass, PASSWORD_DEFAULT);

      $sql = 'INSERT INTO staffs_list (name, username, password, tuka) VALUES(?, ?, ?, ?)';
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $staff_name;
      $data[] = $user_name;
      $data[] = $hash_pass;
      $data[] = $tuka;
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



    //ユーザ名の重複check（is_delete=1 の場合は重複としない）
    // TRUE : 重複あり
    // FALSE  : 重複なし
    public function b_check_repetition_of_user($user) : bool {
      $sql = "SELECT username FROM staffs_list WHERE is_deleted=0 AND username=?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $user;
      $stmt->execute($data);

      $repetition = FALSE;
      while(TRUE){
        $rec = [];
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == FALSE) break;
        else  $repetition=TRUE;
      }
      return $repetition;
    }



    /**
     * 登録されているかチェック
     * 削除済み(is_delete=1 の場合は登録なし) 
     * @param string $name 登録者の名前
     * @param string $tuka 合言葉
     * @return string $username 整合性が取れた場合はユーザ名
     */
    public function consistent(string $name, string $tuka)
    {
      $sql = "SELECT username FROM staffs_list WHERE is_deleted=0 AND name=? AND tuka=?";
      $stmt = $this->dbh->prepare($sql);
      $data = [];
      $data[] = $name;
      $data[] = $tuka;
      $stmt->execute($data);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
  }






?>