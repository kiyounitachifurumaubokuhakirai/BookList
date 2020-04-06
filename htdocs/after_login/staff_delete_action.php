<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_staff.php');

  
  if(!isset($_SESSION["login"]) || !$_SESSION["login"]['is_login']){
    header('Location: ../index.php');
    exit();
  }

  try{
    $staff = new StaffModel;
    $staff->deleteStaff($_SESSION["login"]['is_login']);
  }
  catch(Exception $e){
    var_dump($e);
    header('Location: ../index.php');
    exit();
  }
  $staff = NULL;

  //セッション変数を全て解除
  $_SESSION = [];

  // セッションを切断するにはセッションクッキーも削除する。
  // Note: セッション情報だけでなくセッションを破壊する。
  if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
  
  //セッションを破棄
  session_destroy();

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スタッフ削除</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="staff_register.php" class="nav-link">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_login.php" class="nav-link active">ログイン</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">

      <h2>スタッフ削除</h2>

      <p>削除しました</p>

    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>