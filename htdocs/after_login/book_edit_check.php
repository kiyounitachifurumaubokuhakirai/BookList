<?php
  if (!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/define.php');
  require_once('../common/sql_genre.php');
  require_once('../common/sql_level.php');
  require_once('../common/sql_book.php');


  if (isset($_SESSION['err'])) unset($_SESSION['err']);

  $post = [];
  $post = sanitize($_POST);

  foreach ($post as $key => $value)
  {
    $_SESSION['book'][$key] = $value;
  }

  //validity Check
  $validityCheck = TRUE;

  if (!$_SESSION['book']['name'])
  {
    $_SESSION['err']['book']['name'] = '書籍名称が入力されていません';
    $validityCheck = FALSE;
  }

  if (!$_SESSION['book']['isbn'])
  {
    $_SESSION['err']['book']['isbn'] = 'ISBNが入力されていません';
    $validityCheck = FALSE;
  }

  if ($validityCheck == FALSE)  header('Location: book_edit.php');

?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>書籍修正</title>

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
      <h2>以下の内容で修正しますか？</h2>


    <form action="book_edit_action.php" method="POST"> 
      <div class="form-group row">
        <label for="bookname" class="col-sm-2 col-form-label">書籍名称</label>
        <input type="text" readonly class="form-control-plaintext col-sm-10 col-form-label" id="bookname" name="bookname" value="<?=$_SESSION['book']['name']?>">
      </div>

      <div class="form-group row">
        <label for="booknumber" class="col-sm-2 col-form-label">冊数</label>
        <input type="text" readonly class="form-control-plaintext col-sm-8 col-form-label" id="booknumber" name="booknumber" value="<?=$_SESSION['book']['book_count']?>"> 
      </div>

      <div class="form-group row">
        <label for="genre" class="col-sm-2 col-form-label">ジャンル</label>
        <input type="text" readonly class="form-control-plaintext col-sm-10 col-form-label" id="genre" value="<?=$_SESSION['book']['genre']?>">
        <input type="hidden" id="genre" name='genre' value="<?=$_SESSION['book']['genre']?>">
      </div>

      <div class="form-group row">
        <label for="level" class="col-sm-2 col-form-label">対象レベル</label>
        <input type="text" class="form-control-plaintext col-sm-10 col-form-label" id="level" value="<?=$_SESSION['book']['level']?>">
        <input type="hidden" name="level" value="<?=$_SESSION['book']['level']?>">
      </div>

      <div class="form-group row">
        <label for="ISBN" class="col-sm-2 col-form-label">ISBN</label>
        <input type="text" class="form-control-plaintext col-sm-10 col-form-label" id="ISBN" name="ISBN" value="<?=$_SESSION['book']['isbn']?>">
      </div>

      <?PHP if(isset($_SESSION['book']['correction']) && $_SESSION['book']['correction']):?>
        <div class="form-group row">
          <label for="correction" class="col-sm-2 col-form-label">正誤表</label>
          <input type="file"  class="form-control-plaintext col-sm-10 col-form-label" id="correction" name="correction" value="<?=$_SESSION['book']['correction']?>">
        </div>
      <?PHP endif?>

      <div class="form-group row">
        <div class="form-check form-check-inline">
          <input type="reset" class="btn btn-secondary" onclick="location.href='book_edit.php'" value="戻る">
        </div>
        <div class="form-check form-check-inline">
          <input type="submit" class="btn btn-primary" value="修正">
        </div>
      </div>

    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>