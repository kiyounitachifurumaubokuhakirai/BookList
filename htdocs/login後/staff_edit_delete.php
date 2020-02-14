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
    <title>スタッフ編集・削除</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">書籍登録</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">書籍修正</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link active">スタッフ編集・削除</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">未読メッセージ <span class="badge badge-secondary">New</span></a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">ログアウト</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-5">

      <h2>スタッフ編集・削除</h2>

      <form>
        <div class="form-group row">
          <label for="staff_name" class="col-sm-2 col-form-label">氏名</label>
          <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="staff_name" value="未来のかたち本町2校">
          </div>
        </div>

        <div class="form-group row">
          <label for="user_name" class="col-sm-2 col-form-label">ユーザー名</label>
          <div class="col-sm-10">
            <input type="text" class="form-control col-form-label" id="user_name" placeholder="256文字以内（削除の場合は空白）">
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">パスワード</label>
          <div class="col-sm-10">
            <input type="password" class="form-control col-form-label" id="password" placeholder="半角英数字8文字以上（削除の場合は空白）">
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-sm-2 col-form-label">パスワード（再入力）</label>
          <div class="col-sm-10">
            <input type="password" class="form-control col-form-label" id="password2" placeholder="半角英数字8文字以上（削除の場合は空白）">
          </div>
        </div>

        <div class="form-group row">
          <div class="form-check form-check-inline">
            <button type="submit" class="btn btn-primary">修正</button>
          </div>
          <div class="form-check form-check-inline">
            <button type="submit" class="btn btn-primary">削除</button>
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