<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  //ファイルの読み込み
  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_staff.php');

  //SESSIONの削除
  if(isset($_SESSION['err']['temp2']))  unset($_SESSION['err']['temp2']);
  if(isset($_SESSION['staff']['temp2']))  unset($_SESSION['staff']['temp2']);

  //POSTデータをSESSIONへ
  $_SESSION['staff']['temp2'] = sanitize($_POST);

  /**
   * validity check
   * @必須項目の入力チェック
   * @登録データとの整合性
   */
  $validity = TRUE;

  //ユーザ名
  if (!$_SESSION['staff']['user_name'])
  {
    if(!$_SESSION['staff']['temp2']['user_name'])
    {
      $validity = false;
      $_SESSION['err']['temp2']['user_name'] = 'ユーザ名が入力されていません';
    } else{
      try
      {
        $staff = new StaffModel();
        if ($staff->checkRepetitionUser($_SESSION['staff']['temp2']['user_name'])) //ユーザ名が重複
        {
          $user = $staff->consistent($_SESSION['staff']['name'], $_SESSION['staff']['tuka']);
          if ($_SESSION['staff']['temp2']['user_name'] != $user) //他人のユーザー名か
          {
            $_SESSION['err']['temp2']['user_name'] = "他の人が使用しています";
            $validity = false;
          }
        }
      } catch (Exception $e)
      {
        var_dump($e);
        header('Location: ./index.php');
        exit();
      }
      $staff = null;
    }
  }

  //パスワード
  if (!preg_match('/^[a-zA-Z0-9]{8,256}+$/', $_SESSION['staff']['temp2']['password1']))
  {
    $validity = false;
    $_SESSION['err']['temp2']['password1'] = '半角英数で8文字以上256文字以内で設定して下さい';
  }

  //パスワード（再入力）
  if (!preg_match('/^[a-zA-Z0-9]{8,256}+$/', $_SESSION['staff']['temp2']['password2']))
  {
    $validity = false;
    $_SESSION['err']['temp2']['password2'] = '半角英数で8文字以上256文字以内で設定して下さい';
  }

  //パスワードの整合
  if ($_SESSION['staff']['temp2']['password1'] != $_SESSION['staff']['temp2']['password2'])
  {
    $validity = false;
    $_SESSION['err']['temp2']['password1'] = 'パスワードが一致しません';
    $_SESSION['err']['temp2']['password2'] = 'パスワードが一致しません';
  }

  if($validity == false){
    header('Location: reissue_pass_check1.php');
    exit();
  }
  // $_SESSION['staff']['user_name'] = $_SESSION['staff']['temp2']['user_name'];
  $_SESSION['staff']['password'] = $_SESSION['staff']['temp2']['password1'];
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>パスワード再登録(確認)</title>

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
    <h2>以下の内容で登録しますか？</h2>

    <form action=reissue_pass_action.php method="POST"> 

      <?PHP if (!$_SESSION['staff']['user_name']) :?>
        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">ユーザー名</label>
          <input type="text" readonly class="form-control-plaintext col-sm-10 col-form-label" id="user_name" name="user_name" value="<?=$_SESSION['staff']['temp2']['user_name']?>">
        </div>
      <?PHP endif?>

      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">パスワード</label>
        <input type="hidden"  class="form-control-plaintext col-sm-10 col-form-label" id="password" name="password" value="<?=$_SESSION['staff']['temp2']['password1']?>">
        設定したパスワード
      </div>

      <div class="form-group row">
        <div class="form-check form-check-inline">
          <button type="reset" class="btn btn-secondary" onclick="location.href='reissue_pass_check1.php'">戻る</button>
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