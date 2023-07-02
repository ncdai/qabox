<?php
require_once 'models/UserModel.php';
require_once 'config.inc';

session_start();

class UserController
{
  private $userModel;

  public function __construct()
  {
    $this->userModel = new UserModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function getLogin()
  {
    if (isset($_SESSION['user'])) {
      header('Location: /');
      return;
    }

    include 'views/login/index.php';
  }

  public function postLogin()
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $this->userModel->getUserByUsername($username);

    if (!$user) {
      header('Location: /login');
      return;
    }

    if ($user['Password'] != $password) {
      header('Location: /login');
      return;
    }

    $_SESSION['user'] = $user;
    header('Location: /');
  }

  public function logout()
  {
    unset($_SESSION['user']);
    header('Location: /');
  }

  public function getUpdateRole() {
    include 'views/user/update-role/index.php';
  }

  public function postUpdateMyRole() {
    $UserID = $_SESSION['user']['UserID'];
    $Role = $_POST['Role'];

    $success = $this->userModel->updateRole($UserID, $Role);

    if ($success) {
      $_SESSION['user']['Role'] = $Role;

      $response = [
        'status' => 'success',
        'message' => "Update role successfully"
      ];
    } else {
      $response = [
        'status' => 'error',
        'message' => "Update role failed"
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }

  function __destruct()
  {
    $this->userModel->closeConnection();
  }
}