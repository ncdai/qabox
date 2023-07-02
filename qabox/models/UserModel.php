<?php

class UserModel
{
  private $conn;

  public function __construct($host, $username, $password, $dbname)
  {
    $this->conn = new mysqli($host, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getUserByUsername($username)
  {
    $sql = "SELECT * FROM USERS WHERE UserName = '$username'";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return null;
    }
  }

  public function updateRole($UserID, $Role)
  {
    $stmt = $this->conn->prepare("UPDATE USERS SET Role = ? WHERE UserID = ?");
    $stmt->bind_param("si", $Role, $UserID);
    $stmt->execute();

    $success = $stmt->affected_rows > 0;

    $stmt->close();

    return $success;
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}