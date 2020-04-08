<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');
  require_once(dirname(__FILE__).'/common/sql_request.php');

  unset($_SESSION['err']);

  try{
    $request = new RequestModel();
    $request -> registryRequest($_SESSION['request']['name'], $_SESSION['request']['request']);
  }
  catch(Exception $e){
    var_dump($e);
    exit();
  }

  unset($_SESSION["request"]);

  $request = NULL;
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
        <a href="" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="search_books.php" class="nav-link">書籍検索</a>
      </li>
      <li class="nav-item">
        <a href="request.php" class="nav-link">書籍リクエスト</a>
      </li>
      <?PHP if(isset($_SESSION["login"]['is_login']) && $_SESSION["login"]['is_login']==TRUE):?>
        <li class="nav-item">
          <?PHP if(isset($_SESSION['login']['is_all_completed']) && !$_SESSION['login']['is_all_completed']):?>
            <a href="./after_login/message.php" class="nav-link">未読リクエスト <span class="badge badge-secondary">New</span></a>
          <?PHP else:?>
            <a href="./after_login/message.php" class="nav-link">未読リクエスト</a>
          <?PHP endif?>
        </li>
      <?PHP endif?>
      <li class="nav-item">
        <a href="staff_login.php" class="nav-link">スタッフ管理</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">
      <p>登録が完了しました</p>
    </div>
  </div>
</body>
</html>