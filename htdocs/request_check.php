<?php
  session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');

  unset($_SESSION['err']);
  unset($_SESSION['request']);

  $post = [];
  $post = sanitize($_POST);

  // var_dump($_POST);
  // exit();
  
  foreach($post as $key => $value){
    $_SESSION['request'][$key] = $post[$key];
  }

  $validity = TRUE;

  if(!$_SESSION['request']['request']){
    $validity = FALSE;
    $_SESSION['err']['request'] = 'リクエスト内容がありません';
  }
  elseif(strlen($_SESSION['request']['request'])>1000){
    $validity = FALSE;
    $_SESSION['err']['request'] = 'リクエスト内容は1000文字以内でお願いします';
  }

  if($validity == FALSE){
    header('Location: request.php');
    exit();
  }

  if(!is_null($_SESSION['request']['name'])){
    $_SESSION['request']['name'] = '匿名';
  }

  var_dump($validity);
  var_dump(!is_null($_SESSION['request']['request']));
  var_dump($_SESSION['request']['request']);
  var_dump(strlen($_SESSION['request']['request']));
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
        <a href="" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">書籍検索</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link active">書籍リクエスト</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">スタッフ管理</a>
      </li>
    </ul>
  </div>

  <div class="container my-5">
    <h2>以下の内容でリクエストしますか？</h2>

    <form action=request_action.php method="POST"> 
      <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">氏名</label>
        <input type="text" readonly class="form-control-plaintext col-sm-10 col-form-label" id="name" name="name" value="<?=$_SESSION['request']['name']?>">
      </div>

      <div class="form-group row">
        <label for="request" class="col-sm-2 col-form-label">リクエスト内容</label>
        <textarea readonly class="form-control-plaintext col-sm-10 col-form-label" id="request" name="request" rows="3" ><?=$_SESSION['request']['request']?></textarea>
      </div>

      <div class="form-group row">
        <div class="col-sm-10">
          <input type="submit" class="btn btn-primary" value="送信">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
        <input type="button" class="btn btn-secondary" value="戻る" onclick="location.href='./request.php';">
        </div>
      </div>
    </form>

  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>