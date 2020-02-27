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
    <title>スタッフ新規登録</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link active">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_login.php" class="nav-link">ログイン</a>
      </li>
      <li class="nav-item">
        <a href="./after_login/message.php" class="nav-link">未読メッセージ <span class="badge badge-secondary">New</span></a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-5">

      <h2>スタッフ新規登録</h2>

      <form action="staff_register_check.php" method="post">
        <div class="form-row">

          <label for="first_name" class="col-sm-3 col-form-label">氏名　<span class="badge badge-danger">必須</span></label>
          <div class="form-group col-sm-4">
            <?php if(isset($_SESSION['err']['staff']['last_name'])):?>
              <input type="text" class="form-control alert alert-danger" id="last_name" name="last_name" placeholder=<?=$_SESSION['err']['staff']['last_name']?>>
            <?php else:?>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="姓"
                value="<?php if(isset($_SESSION['staff']['last_name'])) echo $_SESSION['staff']['last_name'] ?>">
            <?php endif?>
          </div>
          <div class="form-group col-sm-4">
            <?php if(isset($_SESSION['err']['staff']['first_name'])):?>
              <input type="text" class="form-control alert alert-danger" id="first_name" name="first_name" placeholder=<?=$_SESSION['err']['staff']['first_name']?>>
            <?php else:?>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="名"
                value="<?php if(isset($_SESSION['staff']['first_name'])) echo $_SESSION['staff']['first_name'] ?>">
            <?php endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="user_name" class="col-sm-3 col-form-label">ユーザー名　<span class="badge badge-danger">必須</span></label>
          <?php if(isset($_SESSION['err']['staff']['username'])):?>
            <input type="text" class="form-control col-sm-8 col-form-label alert alert-danger" id="user_name" name="user_name" placeholder="<?=$_SESSION['err']['staff']['username']?>">
          <?php else:?>
            <input type="text" class="form-control col-sm-8 col-form-label" id="user_name" name="user_name" placeholder="256文字以内"
                value="<?php if(isset($_SESSION['staff']['user_name'])) echo $_SESSION['staff']['user_name'] ?>">
          <?php endif?>
        </div>

        <div class="form-group row">
          <label for="password1" class="col-sm-3 col-form-label">パスワード　<span class="badge badge-danger">必須</span></label>
          <?php if(isset($_SESSION['err']['staff']['password1'])):?>
            <input type="password" class="form-control col-sm-8 col-form-label alert alert-danger" id="password1" name="password1" placeholder="<?=$_SESSION['err']['staff']['password1']?>">
          <?php elseif(isset($_SESSION['err']['staff']['inconsistent'])):?>
            <input type="password" class="form-control col-sm-8 col-form-label alert alert-danger" id="password1" name="password1" placeholder="<?=$_SESSION['err']['staff']['inconsistent'] ?>">
          <?php else:?>
            <input type="password" class="form-control col-sm-8 col-form-label" id="password1" name="password1" placeholder="半角英数字8文字以上">
          <?php endif?>
        </div>

        <div class="form-group row">
          <label for="password2" class="col-sm-3 col-form-label">パスワード（再入力）　<span class="badge badge-danger">必須</span></label>
          <?php if(isset($_SESSION['err']['staff']['password2'])):?>
            <input type="password" class="form-control col-sm-8 col-form-label alert alert-danger" id="password2" name="password2" placeholder="<?=$_SESSION['err']['staff']['password2']?>">
          <?php elseif(isset($_SESSION['err']['staff']['inconsistent'])):?>
            <input type="password" class="form-control col-sm-8 col-form-label alert alert-danger" id="password2" name="password2" placeholder="<?=$_SESSION['err']['staff']['inconsistent'] ?>">
          <?php else:?>
            <input type="password" class="form-control col-sm-8 col-form-label" id="password2" name="password2" placeholder="半角英数字8文字以上">
          <?php endif?>
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