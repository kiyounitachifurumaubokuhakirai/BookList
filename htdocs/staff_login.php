<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('./common/define.php');
  
  if(isset($_SESSION["login"]['is_login']) && $_SESSION["login"]['is_login']==TRUE)  header('Location: ./after_login/message.php');

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="staff_register.php" class="nav-link">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_login.php" class="nav-link active">ログイン</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">

      <h2>ログイン</h2>

      <?php if(isset($_SESSION['err']['login']['incorrect'])):?>
        <p class="badge badge-danger"><?=$_SESSION['err']['login']['incorrect']?></p>
      <?php endif?>

      <form action="staff_login_check.php" method="POST">
        <div class="form-group row">
          <label for="user" class="col-sm-2 col-form-label">ユーザー名</label>
          <div class="col-sm-10">
            <?php if(isset($_SESSION['err']['login']['user'])):?>
              <input type="text" class="form-control col-form-label is-invalid" id="user" name="user" placeholder=<?=$_SESSION['err']['login']['user']?>>
            <?php else:?>
              <?php if(isset($_SESSION['login']['user'])):?>
                <input type="text" class="form-control" id="user" name="user" value="<?=$_SESSION['login']['user']?>">
              <?php else:?>
                <input type="text" class="form-control" id="user" name="user">
              <?php endif?>
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="pass" class="col-sm-2 col-form-label">パスワード</label>
          <div class="col-sm-10">
            <?php if(isset($_SESSION['err']['login']['pass'])):?>
              <input type="password" class="form-control col-form-label is-invalid" id="pass" name="pass" placeholder=<?=$_SESSION['err']['login']['pass']?>>
            <?php else:?>
              <input type="password" class="form-control" id="user" name="pass">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">ログイン</button>
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