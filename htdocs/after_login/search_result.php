
<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/define.php');
  require_once('../common/sql_genre.php');
  require_once('../common/sql_book.php');

  unsetSESSION('search');
  
  //search.php 以外から遷移した場合
  if(isset($_POST) && $_POST) $_SESSION['search'] = sanitize($_POST);

  //$_SESSION['search']が取得できていない場合は、search.phpに戻る
  if(!isset($_SESSION['search']) || !$_SESSION['search']) header('Location: seach.php');

  //検索
  $result = [];
  try{
    $book = new BookModel();
    $_SESSION['search']['result'] = $book -> SearchBooks($_SESSION['search']['bookname'], $_SESSION['search']['genre'], $_SESSION['search']['level']);
  }
  catch(Exception $e){
    var_dump($e);
    // header('Location: ./index.php');
    exit();

    $book = NULL;
  }
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

  <!-- nav開始 -->
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
  <!-- nav終了 -->

  <div class="container">
    <div class="my-3">
      <h2>書籍修正・削除</h2>

      <p>検索結果</p>

      <?PHP if(!isset($_SESSION['search']['result']) || !$_SESSION['search']['result']):?>
        <p>該当する書籍は見つかりませんでした</p>

      <?PHP else:?>
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">書籍名称</th>
              <th scope="col">ジャンル</th>
              <th scope="col">対象レベル</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1?>
            <?php foreach($_SESSION['search']['result'] as $key => $value):?>
              <tr>
                <th scope="row"><?=$i?></th>
                <td><?=$value["name"]?></td>
                <td><?=$value["genre"]?></td>
                <td><?=$value["level"]?></td>
                <td>
                  <div class="row">
                    <div class="col-sm-auto">
                      <form action="book_edit.php" method="POST">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <input type="submit" class="btn btn-outline-primary" value="修正">
                      </form>
                    </div>
                    <div class="col-sm-auto">
                      <form action="book_delete_check.php" method="POST">
                        <input type="hidden" name="id" value="<?=$value['id']?>">
                        <input type="submit" class="btn btn-outline-primary" value="削除">
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              <?php $i++?>
            <?php endforeach?>
          </tbody>
        </table>
      <?php endif?>

      <?PHP if(isset($_SESSION['result'])) unset($_SESSION['result'])?>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
