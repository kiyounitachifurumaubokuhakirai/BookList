<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  //ファイルの読み込み
  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_staff.php');

$_SESSION['staff']['user_name'] = $_SESSION['staff']['temp2']['user_name'];
try
{
  $staff = new StaffModel();
  $staff -> reissueOfUsernameAndPass($_SESSION["staff"]['name'], $_SESSION["staff"]['user_name'], $_SESSION["staff"]['password']);
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
    <p>再登録が完了しました</p>
  </div>
</div>
</body>
</html>