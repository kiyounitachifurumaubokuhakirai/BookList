<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);
?>

<!DOCTYPE html>
<html lang="jp">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>REQUEST</title>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h2 class="display-5">ようこそ！</h2>
        <p class="lead">このページでは未来のかたち本町2校内にない書籍をリクエストできます</p>
      </div>
    </div>

    <div class="container mt-5">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="index.php" class="nav-link">HOME</a>
        </li>
        <li class="nav-item">
          <a href="index.php" class="nav-link">書籍検索</a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link active">書籍リクエスト</a>
        </li>
        <li class="nav-item">
          <a href="staff_login.php" class="nav-link">スタッフ管理</a>
        </li>
      </ul>
    </div>

    <div class="container my-5">
      <h2>書籍リクエスト</h2>

      <form action="request_check.php" method="POST"> 
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">氏名</label>
          <input type="text" class="form-control col-sm-10 col-form-label" id="name" name="name" placeholder="任意">
        </div>

        <div class="form-group row">
          <label for="request" class="col-sm-2 col-form-label">リクエスト内容　<span class="badge badge-danger">必須</span></label>
          <?php if(isset($_SESSION['err']['request'])) :?>
            <textarea  name="request" rows="3" id="request" class="form-control col-sm-10 col-form-label 
                alert alert-danger" placeholder="<?=$_SESSION['err']['request']?>"></textarea>
          <?php else:?> 
            <textarea  name="request" rows="3" id="request" class="form-control col-sm-10 col-form-label" placeholder="1000文字以内"></textarea>
          <?php endif?>

        </div>

        <div class="fosrm-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">送信</button>
          </div>
        </div>
      </form>

    </div>

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>