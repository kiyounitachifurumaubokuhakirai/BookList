<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/define.php');
  require_once('./common/sql_book.php');

  $post = [];
  $post = sanitize($_POST);

  $result = [];

  try{
    $book = new BookModel;

    if($post['gridRadios'] == 'or') $result = $book -> orSearchBooks($post['bookname'], $post['genre'], $post['level']);
    else $result = $book -> andSearchBooks($post['bookname'], $post['genre'], $post['level']);
  }
  catch(Exception $e){
    var_dump($e);
    // header('Location: ./index.php');
    exit();
  }

  unset($_SESSION["staff"]);
  $book = NULL;

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>検索結果</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="search_books.php" class="nav-link active">書籍検索</a>
      </li>
      <li class="nav-item">
        <a href="request.php" class="nav-link">書籍リクエスト</a>
      </li>
      <?PHP if(isset($_SESSION["login"]['is_login']) && $_SESSION["login"]['is_login']==TRUE):?>
        <li class="nav-item">
          <?PHP if(isset($_SESSION['login']['is_all_completed']) && !$_SESSION['login']['is_all_completed']):?>
            <a href="./after_login/message.php" class="nav-link">未読リクエスト <span class="badge badge-secondary">New</span></a>
          <?PHP else:?>
            <a href="./after_login/message.php" class="nav-link">未読リクエスト</a>
          <?PHP endif?>
        </li>
      <?PHP endif?>
      <li class="nav-item">
          <a href="staff_login.php" class="nav-link">スタッフ管理</a>
        </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">

      <h2>検索結果</h2>

      <?PHP if(!$result):?>
        <p>該当する書籍は見つかりませんでした</p>

      <?PHP else:?>
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">書籍名称</th>
              <th scope="col">ジャンル</th>
              <th scope="col">対象レベル</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1?>
            <?php foreach($result as $key => $value):?>
              <tr>
                <th scope="row"><?=$i?></th>
                <td><?=$value["name"]?></td>
                <td><?=$value["genre"]?></td>
                <td><?=$value["level"]?></td>
              </tr>
              <?php $i++?>
            <?php endforeach?>
          </tbody>
        </table>
      <?php endif?>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>