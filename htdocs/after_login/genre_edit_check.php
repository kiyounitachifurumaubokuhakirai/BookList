<?php
  if (!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_genre.php');

  $_SESSION['genre'] = [];
  $_SESSION['genre'] = sanitize($_POST);

  if (isset($_SESSION['err']))  unset($_SESSION['err']);

  //validity check
  $validity = TRUE;

  if (!$_SESSION['genre']["newGenre"])
  {
    $_SESSION['err']['genre'] = 'ジャンル名称が空白です。';
    $validity = FALSE;
  } elseif ($_SESSION['genre']['oldGenre']==$_SESSION['genre']['newGenre'])
  {
    $_SESSION['err']['genre'] = 'ジャンル名称が同じです。';
    $validity = FALSE;
  }
  // exit();
  try
  {
    $genre = new genreModel();
    //重複チェック
    if ($genre->searchGenre($_SESSION['genre']['id'], $_SESSION['genre']['newGenre']))
    {
      $_SESSION['err']['genre'] = 'ジャンル名称が既に存在します。';
      $validity = FALSE;
    }
    //類似チェック
    $likeGenre = [];
    $likeGenre = $genre->searchLikeGenre($_SESSION['genre']['id'], $_SESSION['genre']['newGenre']);
  } catch(Exception $e)
  {
    var_dump($e);
    // header('Location: ../index.php');
    exit();
  }
  $genre = NULL;

  if($validity==FALSE)  header('Location: genre_edit.php');
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ジャンル修正</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
  <!-- nav 開始 -->
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
        <a href="staff_edit.php" class="nav-link">スタッフ編集</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="nav-link">ログアウト</a>
      </li>
    </ul>
  </div>
  <!-- nav 終了 -->

  <div class="container">
    <div class="my-3">

      <h2>ジャンル修正</h2>

      <div class="my-2">
        <form action="genre_edit_action.php" method="POST">
          <!-- <input type="hidden" name="id" value="<?=$post['id']?>"> -->
          <div class="form-group row">
            <label for="oldGenre" class="col-sm-2 col-form-label">現ジャンル名称</label>
            <div class="col-sm-10">
              <input type="text"  readonly class="form-control-plaintext" id="oldGenre" value="<?=$_SESSION['genre']["oldGenre"]?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="newGenre" class="col-sm-2 col-form-label">新名称</label>
            <div class="col-sm-10">
              <input type="text" readonly class="form-control-plaintext" id="newGenre" value="<?=$_SESSION['genre']["newGenre"]?>" >
            </div>
          </div>

          <div class="form-group row">
            <div class="form-check form-check-inline">
              <input type="reset" class="btn btn-secondary" value="戻る" onclick="location.href='genre.php'">
              <input type="submit" class="btn btn-primary" value="修正">
            </div>
          </div>
        </form>
      </div>

      <!-- 類似するgenreがある場合 start -->
      <?PHP if($likeGenre):?>
        <div class="my-2">
          <h5><span class="badge badge-danger">下記の類似が見つかりました。</span></h5>
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
            <?php $i = 1?>
            <?php foreach($_SESSION['genre']['likeGenre'] as $key => $value):?>
              <tr>
                <th scope="row"><?=$i?></th>
                <td><?=$value["genre"]?></td>
              </tr>
              <?php $i++?>
            <?php endforeach?>
          </table>
        </div>
      <?PHP endif?>
      <!-- 類似するgenreがある場合 end -->

    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>