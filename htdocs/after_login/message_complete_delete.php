<?php
  if (!isset($_SESSION)) session_start();
  session_regenerate_id(TRUE);

  require_once('../common/sql_request.php');

  $post = [];
  $post = sanitize($_POST);

  try
  {
    $request = new RequestModel();
    foreach ($post as $key => $value)
    {
      if ($key == 'delete') $request -> deleteRequest($value);
      elseif ($key == 'complete')  $request -> completeRequest($value);
    }
  } catch(Exception $e)
  {
    var_dump($e);
    header('Location: ../index.php');
    exit();
  }
  $request = NULL;

  header('Location: message.php');
?>