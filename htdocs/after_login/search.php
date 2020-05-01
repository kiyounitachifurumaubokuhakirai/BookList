<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/define.php');
  require_once('../common/sql_genre.php');
  require_once('../common/sql_level.php');

  unsetSESSION('search');

  try{
    $genre = new genreModel();
    $_SESSION['genre'] = $genre->getAllGenre();

  }
  catch(Exception $e){
    var_dump($e);
    header('Location: ./index.php');
    exit();
  }
  $genre = NULL;

  try{
    $level = new levelModel();
    $_SESSION['level'] = $level->getAllLevel();

  }
  catch(Exception $e){
    var_dump($e);
    // header('Location: ./index.php');
    exit();
  }
  $level = NULL;
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>書籍修正・削除</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="../index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="message.php" class="nav-link">未読リクエスト
          <?PHP if($_SESSION['login']['is_all_completed'] == FALSE):?> <span class="badge badge-secondary">New</span><?PHP endif?>
        </a>
      </li>
      <li class="nav-item">
        <a href="book_register.php" class="nav-link">書籍登録</a>
      </li>
      <li class="nav-item">
        <a href="search.php" class="nav-link active">書籍修正・削除</a>
      </li>
      <li class="nav-item">
        <a href="genre.php" class="nav-link">ジャンル登録・修正・削除</a>
      </li>
      <li class="nav-item">
        <a href="../staff_register.php" class="nav-link">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_edit.php" class="nav-link">スタッフ編集</a>
      </li>
      <li class="nav-item">
        <a href="staff_delete.php" class="nav-link">スタッフ削除</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link">ログアウト</a>
      </li>
    </ul>
  </div>
  <div class="container">
    <div class="my-3">

      <h2>修正または削除する書籍を検索</h2>

      <form action="search_result.php" method='POST'>
        <div class="form-group row">
          <label for="bookname" class="col-sm-2 col-form-label">書籍名称</label>
          <input type="text" class="form-control col-sm-10 col-form-label" id="bookname" name="bookname">
        </div>

        <div class="form-group row">
          <label for="genre" class="col-sm-2 col-form-label">ジャンル</label>
          <select class="form-control col-sm-3 col-form-label" id="genre" name="genre">
            <option value="0">全て</option>
            <?php foreach($_SESSION['genre'] as $key => $value):?>
              <option value="<?=$value['id']?>"><?=$value['genre']?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group row">
          <label for="level" class="col-sm-2 col-form-label">対象レベル</label>
          <select class="form-control col-sm-3 col-form-label" id="level" name="level">
            <option value="0">全て</option>
            <?PHP foreach($_SESSION['level'] as $key => $value):?>
              <option value="<?=$value['id']?>"><?=$value['level']?></option>
            <?PHP endforeach?>
          </select>
        </div>

        <div class="form-group row">
          <div class="col-sm-10">
            <input type="submit" class="btn btn-primary" value="検索">
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