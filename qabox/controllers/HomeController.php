<?php

session_start();

class HomeController
{
  public function __construct()
  {
  }

  public function getHome()
  {
    // echo json_encode($_SESSION['user']);

    // if (isset($_SESSION['user'])) {
    //   header('Location: /');
    //   return;
    // }

    include 'views/home/index.php';
  }

  function __destruct()
  {
  }
}