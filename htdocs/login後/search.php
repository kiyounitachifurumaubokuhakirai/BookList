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
    <title>書籍検索</title>

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

      <h2>修正または削除する書籍を検索</h2>

      <form>
        <div class="form-group row">
          <label for="bookname" class="col-sm-2 col-form-label">書籍名称</label>
          <input type="text" class="form-control col-sm-10 col-form-label" id="bookname">
        </div>
        
        <div class="form-group row">
          <label for="genre" class="col-sm-2 col-form-label">ジャンル</label>
          <select class="form-control col-sm-3 col-form-label" id="genre">
            <option>PHP</option>
            <option>JAVA</option>
          </select>
        </div>

        <div class="form-group row">
          <label for="level" class="col-sm-2 col-form-label">対象レベル</label>
          <select class="form-control col-sm-3 col-form-label" id="level">
            <option>初級</option>
            <option>中級</option>
            <option>上級</option>
          </select>
        </div>

        <div class="form-group row">
          <label for="ISBN" class="col-sm-2 col-form-label">ISBN</label>
          <input type="text" class="form-control col-sm-8 col-form-label" id="ISBN" placeholder="ハイフンあり">
        </div>

        <fieldset class="form-group">
          <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">検索条件</legend>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="orsearch" value="option1" checked>
                <label class="form-check-label" for="orsearch">OR検索</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="andsearch" value="option2">
                <label class="form-check-label" for="andsearch">AND検索</label>
              </div>
            </div>
          </div>
        </fieldset>

        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">検索</button>
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