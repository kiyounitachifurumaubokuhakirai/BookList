<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_genre.php');

  if(isset($_SESSION["err"])) unset($_SESSION["err"]);

  $_SESSION['genre']= [];
  $_SESSION['genre'] = sanitize($_POST);


  if(isset($_SESSION['err']['genre_register'])) unset($_SESSION['err']['genre_register']);
  
  if(!$_SESSION['genre']['genreName']){
    $_SESSION['err']['genre'] = 'ジャンル名称が空白です。';
    header('Location: genre.php');
  }
  
  try{
    $genre = new genreModel();

    //重複チェック
    if($genre->searchGenre("", $_SESSION['genre']['genreName'])){
      $_SESSION['err']['genre'] = 'ジャンル名称が既に存在します。';
      header('Location: genre.php');
    }
    //類似検索
    $_SESSION['genre']['likeGenre'] = [];
    $_SESSION['genre']['likeGenre'] = $genre->searchLikeGenre("", $_SESSION['genre']['genreName']);
  }

  catch(Exception $e){
    var_dump($e);
    header('Location: ../index.php');
    exit();
  }

  $genre = NULL;

  if(!$_SESSION['genre']['likeGenre'])  header('Location: genre_register_action.php');

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ジャンル登録・修正・削除</title>

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
        <a href="search.php" class="nav-link">書籍修正</a>
      </li>
      <li class="nav-item">
        <a href="genre.php" class="nav-link active">ジャンル登録・修正・削除</a>
      </li>
      <li class="nav-item">
        <a href="../staff_register.php" class="nav-link">スタッフ新規登録</a>
      </li>
      <li class="nav-item">
        <a href="staff_edit_delete.php" class="nav-link">スタッフ編集・削除</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link">ログアウト</a>
      </li>
    </ul>
  </div>
  <div class="container">
    <div class="my-3">

      <h2>類似HIT</h2>

    <div class="my-2">
      <h5><span class="badge badge-danger">下記の類似が見つかりました。新規登録しますか？</span></h5>
    </div>

    <div class="my-2">
      <p>新規ジャンル：『<?=$_SESSION['genre']['genreName']?>』</p>
    </div>

    <div class="form-group row">
      <div class="form-check form-check-inline">
        <form action="">
          <input type="reset" class="btn btn-secondary" onclick="location.href='genre.php'" value="戻る">
        </form>
      </div>
      <div class="form-check form-check-inline">
        <form action="genre_register_action.php">
          <input type="submit" class="btn btn-primary" value="登録">
        </form>          
      </div>
    </div>

    <div class="my-3">
      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">ジャンル</th>
          </tr>
        </thead>
        <tbody>
        <?PHP $i = 1?>
        <?php foreach($_SESSION['genre']['likeGenre'] as $key => $value):?>
          <tr>
            <th scope="row"><?=$i?></th>
            <td><?=$value["genre"]?></td>
          </tr>
          <?PHP $i++?>
        <?php endforeach?>
     </table>
    </div>

  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>