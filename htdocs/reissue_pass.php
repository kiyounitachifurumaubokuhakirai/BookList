<?php
  if (!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_staff.php');

  //staff関連以外の$_SESSIONを削除
  unsetSESSION('staff');

?>

<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>パスワード再登録</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="staff_register.php" class="nav-link active">パスワード再登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_login.php" class="nav-link">ログイン</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">

      <h2>登録者かの確認</h2>

      <?PHP if (isset($_SESSION['err']['temp1']['consistent']) && $_SESSION['err']['temp1']['consistent']) :?>
        <p class="badge badge-danger"><?= $_SESSION['err']['temp1']['consistent'] ?></p>
      <?PHP endif?>

      <form action="reissue_pass_check1.php" method="post">
        <div class="form-row">

          <label for="first_name" class="col-sm-3 col-form-label">氏名　<span class="badge badge-danger">必須</span></label>
          <div class="form-group col-sm-4">
            <?php if(isset($_SESSION['err']['temp1']['last_name'])):?>
              <label for="last_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp1']["last_name"]?></span></label>
              <input type="text" class="form-control is-invalid" id="last_name" name="last_name" placeholder="姓">
            <?PHP elseif (isset($_SESSION['err']['temp1']['consistent']) && $_SESSION['err']['temp1']['consistent']) :?>
              <input type="text" class="form-control is-invalid" id="last_name" name="last_name" placeholder="姓"
                value="<?php if(isset($_SESSION['staff']['last_name'])) echo $_SESSION['staff']['last_name'] ?>">
            <?php else:?>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="姓"
                value="<?php if(isset($_SESSION['staff']['last_name'])) echo $_SESSION['staff']['last_name'] ?>">
            <?php endif?>
          </div>
          <div class="form-group col-sm-4">
            <?php if(isset($_SESSION['err']['temp1']['first_name'])):?>
              <label for="first_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp1']["first_name"]?></span></label>
              <input type="text" class="form-control is-invalid" id="first_name" name="first_name" placeholder="名">
            <?PHP elseif (isset($_SESSION['err']['temp1']['consistent']) && $_SESSION['err']['temp1']['consistent']) :?>
              <input type="text" class="form-control is-invalid" id="first_name" name="first_name" placeholder="名"
                value="<?php if(isset($_SESSION['staff']['first_name'])) echo $_SESSION['staff']['first_name'] ?>">
            <?php else:?>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="名"
                value="<?php if(isset($_SESSION['staff']['first_name'])) echo $_SESSION['staff']['first_name'] ?>">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="user_name" class="col-sm-3 col-form-label">ユーザー名　<span class="badge badge-secondary">任意</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['temp1']['user_name'])):?>
              <label for="user_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp1']["user_name"]?></span></label>
              <input type="text" class="form-control col-form-label is-invalid" id="user_name" name="user_name" placeholder="256文字以内">
            <?php else:?>
              <input type="text" class="form-control col-form-label" id="user_name" name="user_name" placeholder="256文字以内"
                  value="<?php if(isset($_SESSION['staff']['user_name'])) echo $_SESSION['staff']['user_name'] ?>">
            <?php endif?>
          </div>
        </div>
          
        <div class="form-group row">
          <label for="tuka" class="col-sm-3 col-form-label">合言葉　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['temp1']['tuka'])):?>
              <label for="tuka" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp1']["tuka"]?></span></label>
              <input type="text" class="form-control col-sm-8 is-invalid" id="tuka" name="tuka">
            <?PHP elseif (isset($_SESSION['err']['temp1']['consistent']) && $_SESSION['err']['temp1']['consistent']) :?>
              <input type="text" class="form-control col-sm-8 is-invalid" id="tuka" name="tuka"
                value="<?php if(isset($_SESSION['staff']['tuka'])) echo $_SESSION['staff']['tuka'] ?>">
            <?php else:?>
              <input type="text" class="form-control col-sm-8 col-form-label" id="tuka" name="tuka"
                value="<?php if(isset($_SESSION['staff']['tuka'])) echo $_SESSION['staff']['tuka'] ?>">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">確認</button>
          </div>
        </div>
      </form>

    </div>
  </div>

  
</body>
</html>