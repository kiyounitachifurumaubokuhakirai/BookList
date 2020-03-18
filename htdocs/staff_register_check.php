<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');

  unset($_SESSION['err']);
  unset($_SESSION['staff']);

  $post = [];
  $post = sanitize($_POST);


  foreach($post as $key => $value){
    $_SESSION['staff'][$key] = $post[$key];
  }

  $validity = TRUE;

  //氏名(名)
  if(!$_SESSION['staff']['first_name']){
    $validity = FALSE;
    $_SESSION['err']['staff']['first_name'] = '名前が入力されていません';
  }
  //氏名(姓)
  if(!$_SESSION['staff']['last_name']){
    $validity = FALSE;
    $_SESSION['err']['staff']['last_name'] = '姓が入力されていません';
  }
  //ユーザ名
  if(!$_SESSION['staff']['user_name']){
    $validity = FALSE;
    $_SESSION['err']['staff']['user_name'] = 'ユーザー名が入力されていません';
  }
  //パスワード1
  if((!$_SESSION['staff']['password1']) || (strlen($_SESSION['staff']['password1'])<8)){
    $validity = FALSE;
    $_SESSION['err']['staff']['password1'] = '半角英数字8文字以上で設定して下さい';
  }
  elseif(!preg_match('/^[a-zA-Z0-9]+$/', $_SESSION['staff']['password1'])){
    $validity = FALSE;
    $_SESSION['err']['staff']['password1'] = '半角英数字で設定して下さい';
  }
  //パスワード2
  if(!$_SESSION['staff']['password2'] || strlen($_SESSION['staff']['password2'])<8){
    $validity = FALSE;
    $_SESSION['err']['staff']['password2'] = '半角英数字8文字以上で設定して下さい';
  }
  elseif(!preg_match('/^[a-zA-Z0-9]+$/', $_SESSION['staff']['password2'])){
    $validity = FALSE;
    $_SESSION['err']['staff']['password2'] = '半角英数字で設定して下さい';
  }
  //パスワードの整合
  if($_SESSION['staff']['password1'] != $_SESSION['staff']['password2']){
    $_SESSION['err']['staff']['inconsistent'] = 'パスワードが一致しません。';
    $validity = FALSE;
  }

  if($validity == FALSE){
    header('Location: staff_register.php');
    exit();
  }

  $_SESSION['staff']['staff_name'] = $_SESSION['staff']['last_name'].$_SESSION['staff']['first_name'];
  $_SESSION['staff']['password'] = $_SESSION['staff']['password1'];
?>



<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REQUEST(確認)</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
<div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <?php if(isset($_SESSION["login"]['is_login']) && $_SESSION["login"]['is_login']==TRUE):?>
        <li class="nav-item">
          <a href="./after_login/message.php" class="nav-link">未読リクエスト
            <?PHP if(isset($_SESSION['login']['is_all_completed']) && !$_SESSION['login']['is_all_completed']):?> <span class="badge badge-secondary">New</span><?PHP endif?>
          </a>
        </li>
        <li class="nav-item">
          <a href="./after_login/book_register.php" class="nav-link">書籍登録</a>
        </li>
        <li class="nav-item">
          <a href="./after_login/search.php" class="nav-link">書籍修正</a>
        </li>
        <li class="nav-item">
          <a href="./after_login/genre.php" class="nav-link">ジャンル登録・修正・削除</a>
        </li>
        <li class="nav-item">
          <a href="staff_register.php" class="nav-link active">スタッフ新規登録</a>
        </li>
        <li class="nav-item">
          <a href="./after_login/staff_edit_delete.php" class="nav-link">スタッフ編集・削除</a>
        </li>
        <li class="nav-item">
          <a href="./after_login/logout.php" class="nav-link">ログアウト</a>
        </li>
      <?php else:?>
        <li class="nav-item">
          <a href="staff_register.php" class="nav-link active">スタッフ新規登録</a>
        </li>
        <li class="nav-item">
          <a href="staff_login.php" class="nav-link">ログイン</a>
        </li>
      <?php endif?>
  </ul>
  </div>

  <div class="container my-3">
    <h2>以下の内容で登録しますか？</h2>

    <form action=staff_register_action.php method="POST"> 
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">氏名</label>
        <input type="text" readonly class="form-control-plaintext col-sm-10 col-form-label" id="name" name="name" value="<?=$_SESSION['staff']['staff_name']?>">
      </div>

      <div class="form-group row">
        <label for="user_name" class="col-sm-2 col-form-label">ユーザー名</label>
        <input type="text" readonly class="form-control-plaintext col-sm-10 col-form-label" id="user_name" name="user_name" value="<?=$_SESSION['staff']['user_name']?>">
      </div>

      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">パスワード</label>
        <input type="hidden"  class="form-control-plaintext col-sm-10 col-form-label" id="password" name="password" value="<?=$_SESSION['staff']['password1']?>">
        設定したパスワード
      </div>

      <div class="form-group row">
        <div class="form-check form-check-inline">
          <button type="reset" class="btn btn-secondary" onclick="location.href='staff_register.php'">戻る</button>
        </div>
        <div class="form-check form-check-inline">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </div>

    </form>

  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>