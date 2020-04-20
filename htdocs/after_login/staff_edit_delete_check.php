<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_staff.php');

  // unsetSESSION('');
  if(isset($_SESSION['staff'])) unset($_SESSION['staff']);
  if(isset($_SESSION['err'])) unset($_SESSION['err']);

  $_SESSION['staff'] = sanitize($_POST);

  //validity check
  $validity = TRUE;

  //編集する場合
  if($_SESSION['staff']["command"] == "edit"){

    //新規パスワード（任意）が異なっている場合
    if($_SESSION['staff']["newPass"] != $_SESSION['staff']["newPass2"]){
      $validity = FALSE;
      $_SESSION['err']['staff']['newPass'] = '新規パスワードが異なっています';
    }

    //ユーザー名
    if(!$_SESSION['staff']["user_name"]){
      $validity = FALSE;
      $_SESSION['err']['staff']['user_name'] = 'ユーザー名が空白です';
    }
  }

  //現パスワード（必須）が空白の時
  if(!$_SESSION['staff']["oldPass"]){
    $validity = FALSE;
    $_SESSION['err']['staff']['oldPass'] = '現パスワードが空白です';
  }
  //現パスワード（必須）が間違えている
  else{
    try{
      $staff = new StaffModel();
      if($staff->LoginCheck($_SESSION["login"]['user'], $_SESSION['staff']["oldPass"]) == 0){
        $validity = FALSE;
        $_SESSION['err']['staff']['oldPass'] = '現パスワードが間違えています';
      }
    }
    catch(Exception $e){
      var_dump($e);
      header('Location: ../index.php');
    }
    $staff = NULL;
  }

  if($validity == FALSE){
    header('Location: staff_edit_delete.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
      <?PHP if($_SESSION['staff']["command"]=="edit"):?>  編集確認
      <?PHP else:?> 削除確認
      <?PHP endif?>
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
<div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="../index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="message.php" class="nav-link">未読リクエスト
          <?PHP if($_SESSION['login']['is_all_completed'] == FALSE):?> <span class="badge badge-secondary">New</span><?PHP endif?>
        </a>
      </li>
      <li class="nav-item">
        <a href="book_register.php" class="nav-link">書籍登録</a>
      </li>
      <li class="nav-item">
        <a href="search.php" class="nav-link">書籍修正</a>
      </li>
      <li class="nav-item">
        <a href="genre.php" class="nav-link">ジャンル登録・修正・削除</a>
      </li>
      <li class="nav-item">
        <a href="../staff_register.php" class="nav-link">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_edit_delete.php" class="nav-link active">スタッフ編集・削除</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link">ログアウト</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">
      <?PHP if($_SESSION['staff']["command"]=="edit"):?>  <h2>以下の内容で編集しますか？</h2>
      <?PHP else:?> <h2>以下の内容を削除しますか？</h2>
      <?PHP endif?>

      <form action="" method="POST">
        <div class="form-group row">
          <label for="staff_name" class="col-sm-3 col-form-label">氏名</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="staff_name" value="<?= $_SESSION['staff']["staff_name"]?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="user_name" class="col-sm-3 col-form-label">ユーザー名</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="user_name" value="<?=$_SESSION['staff']["user_name"]?>">
          </div>
        </div>

        <?PHP if(($_SESSION['staff']["command"] == "edit") && $_SESSION['staff']["newPass"]):?>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">新規パスワード</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="password">設定したパスワード
            </div>
          </div>
        <?PHP endif?>

        <div class="form-group row">
          <div class="form-check form-check-inline">
            <button type="submit" class="btn btn-secondary" formaction="staff_edit_delete.php">戻る</button>
          </div>
          <div class="form-check form-check-inline">
            <?PHP if($_SESSION['staff']["command"]=="edit"):?>
              <button type="submit" class="btn btn-primary" formaction="staff_edit_action.php">修正</button>
            <?PHP else:?>
              <button type="submit" class="btn btn-primary" formaction="staff_delete_action.php">削除</button>
            <?PHP endif?>
          </div>
        </div>
      </form>

    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>