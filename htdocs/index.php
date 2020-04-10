<?php
  if(!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once(dirname(__FILE__).'/common/sql_genre.php');

  if(!$_SESSION["login"]['user']){
    try{
      $_SESSION['genre'] = [];
      $genres = new genreModel();
      $_SESSION['genre'] = $genres -> getAllGenre();
    }
    catch(Exception $e){
      var_dump($e);
      exit();
    }
    $genres= NULL;
  }


  header('Location: search_books.php');
?>
