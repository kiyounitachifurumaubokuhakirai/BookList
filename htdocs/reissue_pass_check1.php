<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  //ファイルの読み込み
  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_staff.php');

  if (isset($_SESSION['err']['temp2']) && $_SESSION['err']['temp2'])
  {
  } else
  {
    //SESSIONの削除
    if (isset($_SESSION['err']['temp1']))  unset($_SESSION['err']['temp1']);
    if (isset($_SESSION['staff']['temp1']))  unset($_SESSION['staff']['temp1']);

    //POSTデータをSESSIONへ
    $_SESSION['staff'] = sanitize($_POST);
    /**
     * validity check
     * @必須項目の入力チェック
     * @登録データとの整合性
     */
    $validity = TRUE;

    //氏名(名)
    if (!$_SESSION['staff']['first_name'])
    {
      $validity = FALSE;
      $_SESSION['err']['temp1']['first_name'] = '名前が入力されていません';
    }
    //氏名(姓)
    if (!$_SESSION['staff']['last_name'])
    {
      $validity = FALSE;
      $_SESSION['err']['temp1']['last_name'] = '姓が入力されていません';
    }
    //合言葉
    if (!$_SESSION['staff']['tuka'])
    {
      $validity = FALSE;
      $_SESSION['err']['temp1']['tuka'] = '合言葉が入力されていません';
    }

    //上記のvalidity check で引っかかっていない場合
    if ($validity == true)
    {
      try
      {
        $_SESSION['staff']['name'] = $_SESSION['staff']['last_name'].$_SESSION['staff']['first_name'];
        $staff = new StaffModel();
        $user = $staff->consistent($_SESSION['staff']['name'], $_SESSION['staff']['tuka']);

        if (is_NULL($user))
        {
          $validity = false;
          $_SESSION['err']['temp1']['consistent'] = '登録されていないか、入力のいずれかに誤りがあります。';
        } elseif ($_SESSION['staff']['user_name'] && ($_SESSION['staff']['user_name'] != $user))
        {
          $validity = false;
          $_SESSION['err']['temp1']['consistent'] = '登録されていないか、入力のいずれかに誤りがあります。';
        }
      } catch (Exception $e)
      {
        var_dump($e);
        header('Location: ./index.php');
        exit();
      }
      $staff = null;
    }
    if ($validity == false){
      header('Location: reissue_pass.php');
      exit();
    }
  }
?>




<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

  <div class="container my-3">

    <h2>以下の項目を入力して下さい</h2>

    <form action=reissue_pass_check2.php method="POST">

      <?PHP if (!$_SESSION['staff']['user_name']):?>
        <div class="form-group row">
          <label for="user_name" class="col-sm-3 col-form-label">新規ユーザー名　<span class="badge badge-danger">必須</span></label>
          <div class="col-sm-9">
            <?php if(isset($_SESSION['err']['temp2']['user_name'])):?>
              <label for="user_name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp2']["user_name"]?></span></label>
              <input type="text" class="form-control col-sm-8 col-form-label is-invalid" id="user_name" name="user_name" placeholder="256文字以内">
            <?php else:?>
              <input type="text" class="form-control col-sm-8 col-form-label" id="user_name" name="user_name" placeholder="256文字以内"
                  value="<?php if(isset($_SESSION['staff']['temp2']['user_name'])) echo $_SESSION['staff']['temp2']['user_name'] ?>">
            <?php endif?>
          </div>
        </div>
      <?PHP endif?>

      <div class="form-group row">
        <label for="password1" class="col-sm-3 col-form-label">新規パスワード　<span class="badge badge-danger">必須</span></label>
        <div class="col-sm-9">
          <?php if(isset($_SESSION['err']['temp2']['password1'])):?>
            <label for="password1" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp2']["password1"]?></span></label>
            <input type="password" class="form-control col-sm-8 is-invalid" id="password1" name="password1" placeholder="半角英数字8文字以上256文字以内">
          <?php elseif(isset($_SESSION['err']['temp2']['inconsistent'])):?>
            <label for="password1" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp2']["inconsistent"]?></span></label>
            <input type="password" class="form-control col-sm-8 is-invalid" id="password1" name="password1" placeholder="半角英数字8文字以上256文字以内">
          <?php else:?>
            <input type="password" class="form-control col-sm-8 col-form-label" id="password1" name="password1" placeholder="半角英数字8文字以上256文字以内">
          <?php endif?>
        </div>
      </div>

      <div class="form-group row">
        <label for="password2" class="col-sm-3 col-form-label">新規パスワード（再入力）　<span class="badge badge-danger">必須</span></label>
        <div class="col-sm-9">
          <?php if(isset($_SESSION['err']['temp2']['password2'])):?>
            <label for="password2" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp2']["password2"]?></span></label>
            <input type="password" class="form-control col-sm-8 is-invalid" id="password2" name="password2" placeholder="半角英数字8文字以上256文字以内">
          <?php elseif(isset($_SESSION['err']['temp2']['inconsistent'])):?>
            <label for="password2" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['temp2']["inconsistent"]?></span></label>
            <input type="password" class="form-control col-sm-8 cis-invalid" id="password2" name="password2" placeholder="半角英数字8文字以上256文字以内">
          <?php else:?>
            <input type="password" class="form-control col-sm-8 col-form-label" id="password2" name="password2" placeholder="半角英数字8文字以上256文字以内">
          <?php endif?>
        </div>
      </div>

      <div class="form-group row">
        <div class="form-check form-check-inline">
          <button type="submit" class="btn btn-primary">確認</button>
        </div>
      </div>

    </form>

  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>