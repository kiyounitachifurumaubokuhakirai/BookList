<?php

  //Database接続関連
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'Booklist');
  define('DB_USER', 'root');
  //define('DB_PASS', '');   //for windows
  define('DB_PASS', 'root');   //for mac

  //エラーメッセージ関連
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

?>