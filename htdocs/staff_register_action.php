<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_staff.php');

  if (isset($_SESSION['err'])) unset($_SESSION['err']);

  try
  {
    $staff = new StaffModel();
    $staff -> AddStaff($_SESSION["staff"]['staff_name'], $_SESSION["staff"]['user_name'], $_SESSION["staff"]['password'], $_SESSION["staff"]['tuka']);
  } catch(Exception $e)
  {
    var_dump($e);
    header('Location: ./index.php');
    exit();
  }

  unset($_SESSION["staff"]);
  $staff = NULL;

?>


<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録完了</title>

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
      <p>登録が完了しました</p>
    </div>
  </div>
</body>
</html>