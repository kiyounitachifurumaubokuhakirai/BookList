<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/define.php');
  require_once('../common/sql_request.php');

  unsetSESSION('');

  if(!$_SESSION['login']['user']){
    $_SESSION['err']['login']['incorrect'] = '先ずはログインして下さい';
    header('location: ../staff_login.php');
  }

  if(isset($_SESSION['request']) && $_SESSION['request']) unset($_SESSION['request']);

  try{
    $request = new RequestModel;
    $_SESSION['request'] = $request -> getAllrequest();
    $_SESSION['login']['is_all_completed'] = $request -> isAllCompletedRequest();

  }
  catch(Exception $e){
    var_dump($e);
    header('Location: ../index.php');
    exit();
  }

  $request = NULL;
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スタッフ編集</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
  <div class="container mt-5">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="../index.php" class="nav-link">HOME</a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link active" >未読リクエスト
          <?PHP if($_SESSION['login']['is_all_completed'] == FALSE):?> <span class="badge badge-secondary">New</span><?PHP endif?>
        </a>
      </li>
      <li class="nav-item">
        <a href="book_register.php" class="nav-link">書籍登録</a>
      </li>
      <li class="nav-item">
        <a href="search.php" class="nav-link">書籍修正・削除</a>
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
        <a href="logout.php" class="nav-link">ログアウト</a>
      </li>
    </ul>
  </div>

  <div class="container">
    <div class="my-3">

      <h2>リクエスト</h2>

      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">内容</th>
            <th scope="col">要望者</th>
            <th scope="col">更新日時</th>
            <th scope="col">解決済か</th>
            <th scope="col">ACTION</th>
          </tr>
        </thead>

        <tbody>
          <?PHP $i=1?>
          <?PHP foreach($_SESSION['request'] as $key => $value):?>
            <tr>
              <th scope="row"><?=$i?></th>
              <td><?=$value['request']?></td>
              <td><?=$value['contributor']?></td>
              <td><?=$value['update_date_time']?></td>
              <td>
                <?PHP
                  if($value['is_completed']==0) echo '未解決';
                  else echo '解決';
                ?>
              <td>
                <div class="row">
                  <div class="col-sm-auto">
                    <form action="message_complete_delete.php" method="POST">
                      <input type="hidden" name="delete" value=<?=$value['id']?>>
                      <input type="submit" value="削除" class="btn btn-outline-primary">
                    </form>
                  </div>
                  <?PHP if($value['is_completed']==0):?>
                    <div class="col-sm-auto">
                      <form action="message_complete_delete.php" method="POST">
                        <input type="hidden" name="complete" value=<?=$value['id']?>>
                        <input type="submit" value="解決" class="btn btn-outline-primary">
                      </form>
                    </div>
                  <?PHP endif?>
                </div>
              </td>
            </tr>
            <?PHP $i++?>
          <?PHP endforeach?>
        </tbody>

      </table>
    </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>