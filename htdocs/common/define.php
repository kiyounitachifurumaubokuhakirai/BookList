<?php

  //Database接続関連
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'Booklist');
  define('DB_USER', 'root');
  //define('DB_PASS', '');   //for windows
  define('DB_PASS', 'root');   //for mac

  //エラーリクエスト関連
  define('MSG_ERR', '%sに誤りがあります。');
  define('MSG_EXCEPTION', '申し訳ございません、エラーが発生しました。');

  //サニタイズ
  function sanitize($before){
    $after=[];
    foreach($before as $key => $value){
      $after[$key]=htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    return $after;
  }


  //不要な$_SESSIONを削除==========================================
  //  不要な（引数以外）の$_SESSIONを削除する
  //  引数：現在使用している＄_SESSION名称
  //=============================================================
  function unsetSESSION($SessionName){
    //err
    if(isset($_SESSION['err'])){
      foreach($_SESSION['err'] as $key => $value){
        if($key != $SessionName){
          if(isset($_SESSION['err']['staff'])) unset($_SESSION['err']['staff']);
          if(isset($_SESSION['err']['request'])) unset($_SESSION['err']['request']);
          if(isset($_SESSION['err']['genre'])) unset($_SESSION['err']['genre']);
          if(isset($_SESSION['err']['search'])) unset($_SESSION['err']['search']);
          if(isset($_SESSION['err']['book'])) unset($_SESSION['err']['book']);
        } 
      }
    }

    //staff
    if($SessionName != 'staff'){
      if(isset($_SESSION['staff'])) unset($_SESSION['staff']);
    }

    //request
    if($SessionName != 'request'){
      if(isset($_SESSION['request'])) unset($_SESSION['staff']);
    }

    //genre
    if($SessionName != 'genre'){
      if(isset($_SESSION['genre'])) unset($_SESSION['staff']);
    }

    //search
    if($SessionName != 'search'){
      if(isset($_SESSION['search'])) unset($_SESSION['staff']);
    }

    //book
    if($SessionName != 'book'){
      if(isset($_SESSION['book'])) unset($_SESSION['staff']);
    }

  }
?>