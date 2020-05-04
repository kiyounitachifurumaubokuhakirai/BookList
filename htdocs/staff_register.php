<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('./common/define.php');

  //$_SESSION['staff']が存在しない時はHOMEに戻る
  if (isset($_SESSION["login"]) && $_SESSION['login'])
  {
    //staff関連以外の$_SESSIONを削除
    unsetSESSION('staff');
  } else
  {
    header ('Location: seach_books.php');
  }
  
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スタッフ新規登録</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <?php if(isset($_SESSION["login"]['is_login']) && $_SESSION["login"]['is_login']):?>
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
          <a href="./after_login/staff_edit.php" class="nav-link">スタッフ編集</a>
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

  <div class="container">
    <div class="my-3">

      <h2>スタッフ新規登録</h2>

      <form action="staff_register_check.php" method="post">
        <div class="form-row">

          <label for="first_name" class="col-sm-3 col-form-label">氏名　<span class="badge badge-danger">必須</span></label>
          <div class="form-group col-sm-4">
            <?php if(isset($_SESSION['err']['staff']['last_name'])):?>
              <label for="last_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["last_name"]?></span></label>
              <input type="text" class="form-control is-invalid" id="last_name" name="last_name" placeholder="姓">
            <?php else:?>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="姓"
                value="<?php if(isset($_SESSION['staff']['last_name'])) echo $_SESSION['staff']['last_name'] ?>">
            <?php endif?>
          </div>
          <div class="form-group col-sm-4">
            <?php if(isset($_SESSION['err']['staff']['first_name'])):?>
              <label for="first_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["first_name"]?></span></label>
              <input type="text" class="form-control is-invalid" id="first_name" name="first_name" placeholder="名">
            <?php else:?>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="名"
                value="<?php if(isset($_SESSION['staff']['first_name'])) echo $_SESSION['staff']['first_name'] ?>">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="user_name" class="col-sm-3 col-form-label">ユーザー名　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['staff']['user_name'])):?>
              <label for="user_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["user_name"]?></span></label>
              <input type="text" class="form-control col-form-label is-invalid" id="user_name" name="user_name" placeholder="256文字以内">
            <?php else:?>
              <input type="text" class="form-control col-form-label" id="user_name" name="user_name" placeholder="256文字以内"
                  value="<?php if(isset($_SESSION['staff']['user_name'])) echo $_SESSION['staff']['user_name'] ?>">
            <?php endif?>
          </div>
        </div>
          
        <div class="form-group row">
          <label for="password1" class="col-sm-3 col-form-label">パスワード　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['staff']['password1'])):?>
              <label for="password1" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["password1"]?></span></label>
              <input type="password" class="form-control col-sm-8 is-invalid" id="password1" name="password1" placeholder="半角英数字8文字以上256文字以内">
            <?php elseif(isset($_SESSION['err']['staff']['inconsistent'])):?>
              <label for="password1" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["inconsistent"]?></span></label>
              <input type="password" class="form-control col-sm-8 is-invalid" id="password1" name="password1" placeholder="半角英数字8文字以上256文字以内">
            <?php else:?>
              <input type="password" class="form-control col-sm-8 col-form-label" id="password1" name="password1" placeholder="半角英数字8文字以上256文字以内">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="password2" class="col-sm-3 col-form-label">パスワード（再入力）　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['staff']['password2'])):?>
              <label for="password2" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["password2"]?></span></label>
              <input type="password" class="form-control col-sm-8 is-invalid" id="password2" name="password2" placeholder="半角英数字8文字以上256文字以内">
            <?php elseif(isset($_SESSION['err']['staff']['inconsistent'])):?>
              <label for="password2" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["inconsistent"]?></span></label>
              <input type="password" class="form-control col-sm-8 cis-invalid" id="password2" name="password2" placeholder="半角英数字8文字以上256文字以内">
            <?php else:?>
              <input type="password" class="form-control col-sm-8 col-form-label" id="password2" name="password2" placeholder="半角英数字8文字以上256文字以内">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="tuka" class="col-sm-3 col-form-label">合言葉　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['staff']['tuka'])):?>
              <label for="tuka" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['staff']["tuka"]?></span></label>
              <input type="text" class="form-control is-invalid" id="tuka" name="tuka" placeholder="50文字以内">
            <?php else:?>
              <input type="text" class="form-control col-form-label" id="tuka" name="tuka" placeholder="50文字以内"
                value="<?php if(isset($_SESSION['staff']['tuka'])) echo $_SESSION['staff']['tuka'] ?>">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">登録</button>
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