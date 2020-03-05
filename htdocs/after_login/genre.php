
<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/define.php');
  require_once('../common/sql_genre.php');

  try{
    $genre = new genreModel;
    $_SESSION['genre']  = $genre->getAllGenre();
  }
  catch(Exception $e){
    var_dump($e);
    // header('Location: ./index.php');
    exit();
  }

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
        <a href="message.php" class="nav-link">未読メッセージ</a>
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
      <h2>ジャンル</h2>

    <div class="my-2">
      <form class="form-inline" action="genre_register_check.php" method="POST">
        <div class="form-group mb-2">
          <label for="newGenre" class="sr-only">Genre</label>
          <input type="text" readonly class="form-control-plaintext" id="newGenre" value="新規登録">
        </div>
        <div class="form-group mx-sm-3 mb-2">
          <label for="genreName" class="sr-only">新規登録</label>
          <input type="text" class="form-control" id="genreName" name="genreName" placeholder="新規ジャンル名称">
        </div>
        <button type="submit" class="btn btn-primary mb-2">新規登録</button>
      </form>
    </div>

      <div class="my-2">
      <p>登録済ジャンル一覧</p>

        <table class="table table-hover">
        <tread>
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">ジャンル</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1?>
            <?php foreach($_SESSION['genre'] as $key => $value):?>
              <tr>
                <th scope="row"><?=$i?></th>
                <td><?=$value["genre"]?></td>
                <td>
                  <div class="row">
                    <div class="col-sm-auto">
                      <form action="genre_edit_check.php" method="POST">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <input type="hidden" name="genre" value="<?=$value['genre']?>">
                        <input type="submit" class="btn btn-outline-primary" value="修正"></button>
                      </form>
                    </div>
                    <div class="col-sm-auto">
                      <form action="genre_delete_check.php" method="POST">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <input type="hidden" name="genre" value="<?=$value['genre']?>">
                        <input type="submit" class="btn btn-outline-primary" value="削除"></button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              <?php $i++?>
            <?php endforeach?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

