<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_staff.php');

  unset($_SESSION['err']);
  unset($_SESSION['login']);

  $post = [];
  $post = sanitize($_POST);


  foreach($post as $key => $value){
    $_SESSION['login'][$key] = $post[$key];
  }

  $validity = TRUE;

  //ユーザ名
  if(!$_SESSION['login']['user']){
    $validity = FALSE;
    $_SESSION['err']['login']['user'] = 'ユーザー名が入力されていません';
  }
  //パスワード
  if(!$_SESSION['login']['pass']){
    $validity = FALSE;
    $_SESSION['err']['login']['pass'] = 'パスワードが入力されていません';
  }

  if($validity == FALSE){
    header('Location: staff_login.php');
    exit();
  }

  try{
    $staff = new StaffModel;
    if($staff->LoginCheck($_SESSION["login"]['user'], $_SESSION["login"]['pass'])){
      header('Location: ./after_login/message.php');
    }
    else{
      $_SESSION['err']['login']['incorrect'] = 'ユーザー名とパスワードが一致しません';
      header('Location: staff_login.php');
    }
  }
  catch(Exception $e){
    var_dump($e);
    header('Location: ./index.php');
    exit();
  }

  $staff = NULL;

?>
