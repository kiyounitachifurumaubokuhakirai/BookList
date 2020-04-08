<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_staff.php');

  // unsetSESSION('');

  try{
    $staff = new StaffModel();
    $staffName = $staff->getStaffName($_SESSION["login"]['user'], $_SESSION["login"]['pass']);
  }
  catch(Exception $e){
    var_dump($e);
    // header('Location: ../index.php');
    exit();
  }
  $staff = NULL;
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スタッフ編集・削除</title>

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

      <h2>スタッフ編集・削除</h2>

      <form method="POST" action="staff_edit_delete_check.php">
        <div class="form-group row">
          <label for="staff_name" class="col-sm-3 col-form-label">氏名</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext col-form-label" id="staff_name" name="staff_name" value="<?=$staffName?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="user_name" class="col-sm-3 col-form-label">ユーザー名</label>
          <div class="col-sm-8">
            <?php if(isset($_SESSION['err']['staff']['user_name'])):?>
              <input type="text" class="form-control is-invalid" id="user_name" name="user_name" placeholder="<?=$_SESSION['err']['staff']['user_name']?>">
            <?php else:?>
              <input type="text" class="form-control col-form-label" id="user_name" name="user_name" value="<?=$_SESSION['login']['user'] ?>">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="oldPass" class="col-sm-3 col-form-label">現状パスワード　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-8">
            <?php if(isset($_SESSION['err']['staff']['oldPass'])):?>
              <input type="password" class="form-control is-invalid" id="oldPass" name="oldPass" placeholder="<?=$_SESSION['err']['staff']['oldPass']?>">
            <?PHP else:?>
              <input type="password" class="form-control col-form-label" id="oldPass" name="oldPass" placeholder="半角英数字8文字以上">
            <?PHP endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-sm-3 col-form-label">新規パスワード</label>
          <div class="col-sm-8">
            <?PHP if(isset($_SESSION['err']['staff']['newPass'])):?>
              <input type="password" class="form-control is-invalid" id="password" name="newPass" placeholder="<?=$_SESSION['err']['staff']['newPass']?>">
            <?PHP else:?>
              <input type="password" class="form-control col-form-label" id="password" name="newPass" placeholder="半角英数字8文字以上（変更する場合のみ）">
            <?PHP endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="password2" class="col-sm-3 col-form-label">新規パスワード（再入力）</label>
          <div class="col-sm-8">
            <?PHP if(isset($_SESSION['err']['staff']['newPass'])):?>
              <input type="password" class="form-control is-invalid" id="password2" name="newPass2" placeholder="<?=$_SESSION['err']['staff']['newPass']?>">
            <?PHP else:?>
              <input type="password" class="form-control col-form-label" id="password2" name="newPass2" placeholder="半角英数字8文字以上（変更する場合のみ）">
            <?PHP endif?>
          </div>
        </div>

        <div class="form-group row">
          <div class="form-check form-check-inline">
            <button type="submit" class="btn btn-primary" name="command" value="edit">編集</button>
          </div>
          <div class="form-check form-check-inline">
            <button type="submit" class="btn btn-primary" name="command" value="delete">削除</button>
          </div>
        </div>

    </div>
  </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>