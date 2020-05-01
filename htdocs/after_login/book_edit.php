<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_genre.php');
  require_once('../common/sql_level.php');
  require_once('../common/sql_book.php');
  require_once('../common/define.php');
    
  $post = [];
  $post = sanitize($_POST);

  if(isset($post["id"])){
    //修正する書籍情報を取得
    try{
      $book = new bookModel();
      $_SESSION['book'] = $book->searchBookWithID($post['id']);
    }
    catch(Exception $e){
      var_dump($e);
      // header('Location: ../index.php');
      exit();
    }
    $book = NULL;
  }


//全ジャンルを取得
try{
  $genre = new genreModel();
  $_SESSION['genre'] = $genre->getAllGenre();
}
catch(Exception $e){
  var_dump($e);
  // header('Location: ../index.php');
  exit();
}
$genre = NULL;

//全レベルを取得
try{
  $level = new levelModel();
  $_SESSION['level'] = $level->getAllLevel();
}
catch(Exception $e){
  var_dump($e);
  header('Location: ../index.php');
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

      <h2>書籍修正</h2>

      <form action="book_edit_check.php" method="POST">
        <div class="form-group row">
          <label for="bookname" class="col-sm-2 col-form-label">書籍名称</label>
          <div class="col-sm-10">
            <?PHP if(isset($_SESSION['err']['book']["name"]) && $_SESSION['err']['book']["name"]):?>
              <label for="name" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['book']["name"]?></span></label>
              <input type="text" class="form-control is-invalid" id="name" name="name">
            <?PHP elseif(isset($_SESSION['book']["name"]) && $_SESSION['book']["name"]):?>
              <input type="text" class="form-control col-form-label" id="name" name="name" value='<?=$_SESSION['book']['name']?>'>
            <?PHP else:?>
              <input type="text" class="form-control col-form-label" id="name" name="name">
            <?PHP endif?>
          </div>
          
        </div>

        <div class="form-group row">
          <label for="book_count" class="col-sm-2 col-form-label">冊数</label>
          <div class="col-sm-3">
            <select class="form-control col-form-label" id="book_count" name="book_count">
              <?php for($i=1; $i<=9; $i++):?>
                <?PHP if(isset($_SESSION['book']['book_count']) && $_SESSION['book']['book_count']==$i):?>
                  <option value='<?=$i?>' selected><?=$i?></option>
                <?PHP else:?>
                  <option value='<?=$i?>'><?=$i?></option>
                <?PHP endif?>
              <?PHP endfor?>
            </select>
          </div>
          <label for="book_count" class="col-sm-2 col-form-label">冊</label>
        </div>
        
        <div class="form-group row">
          <label for="genre" class="col-sm-2 col-form-label">ジャンル</label>
          <div class="col-sm-3">
            <select class="form-control col-form-label" id="genre" name="genre">
              <?PHP foreach($_SESSION['genre'] as $key => $value):?>
                <?PHP if(isset($_SESSION['book']['genre_id']) && ($_SESSION['book']['genre_id']==$value['id'])):?>
                  <option value="<?=$value['id']?>" selected><?=$value['genre']?></option>
                <?PHP else:?>
                  <option value="<?=$value['id']?>"><?=$value['genre']?></option>
                <?PHP endif?>
              <?PHP endforeach?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="level" class="col-sm-2 col-form-label">対象レベル</label>
          <div class="col-sm-3">
            <select class="form-control col-form-label" id="level" name="level">
              <?PHP foreach($_SESSION['level'] as $key => $value):?>
                <?PHP if(isset($_SESSION['book']['level_id']) && ($_SESSION['book']['level_id']==$value['id'])):?>
                  <option value="<?=$value['id']?>" selected><?=$value['level']?></option>
                <?PHP else:?>
                  <option value="<?=$value['id']?>"><?=$value['level']?></option>
                <?PHP endif?>
              <?PHP endforeach?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="ISBN" class="col-sm-2 col-form-label">ISBN</label>
          <div class="col-sm-8">
            <?PHP if(isset($_SESSION['err']['book']['isbn']) && $_SESSION['err']['book']['isbn']):?>
              <label for="isbn" class="col-form-label"><span class="badge badge-danger"><?=$_SESSION['err']['book']["isbn"]?></span></label>
              <input type="text" class="form-control is-invalid" id="isbn" name="isbn">
            <?PHP elseif(isset($_SESSION['book']['isbn']) && $_SESSION['book']['isbn']):?>
              <input type="text" class="form-control col-form-label" id="isbn" name="isbn" value='<?=$_SESSION['book']['isbn']?>'>
            <?PHP else:?>
              <input type="text" class="form-control col-form-label" id="isbn" name="isbn" placeholder="ハイフンあり">
            <?PHP endif?>
          </div>
        </div>

        <div class="form-group row">
          <label for="correction" class="col-sm-2 col-form-label">正誤表</label>
          <input type="file" class="form-control-file col-sm-8" id="correction" name="correction">
        </div>

        <div class="form-group row">
          <div class="form-check form-check-inline">
            <button type="reset" class="btn btn-secondary" onclick="location.href='search_result.php'">戻る</button>
          </div>
          <div class="form-check form-check-inline">
            <button type="submit" class="btn btn-primary">修正</button>
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