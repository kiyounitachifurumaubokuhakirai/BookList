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
        <a href="" class="nav-link">スタッフ編集・削除</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link active">未読メッセージ</a>
      </li>

    </ul>
  </div>

  <div class="container">
    <div class="my-5">

      <h2>メッセージ</h2>

      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">内容</th>
            <th scope="col">要望者</th>
            <th scope="col">要望日</th>
            <th scope="col">解決済みか</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>あああああ</td>
            <td>いいいいい</td>
            <td>20020/02/14</td>
            <td>未解決</td>
            <td>
              <div class="row">
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">修正</button>
                </div>
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">削除</button>
                </div>
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">解決</button>
                </div>
              </div>
            </td>

          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>20020/02/11</td>
            <td>未解決</td>
            <td>
              <div class="row">
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">修正</button>
                </div>
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">削除</button>
                </div>
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">解決</button>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <th scope="row">3</th>
            <td >Larry the Bird</td>
            <td>@twitter</td>
            <td>20020/02/11</td>
            <td>解決</td>
            <td>
              <div class="row">
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">修正</button>
                </div>
                <div class="col-sm-auto">
                  <button type="button" class="btn btn-outline-primary">削除</button>
                </div>
              </div>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>