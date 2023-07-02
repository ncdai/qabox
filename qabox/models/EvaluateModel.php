<?php

class EvaluateModel
{
  private $conn;

  public function __construct($host, $username, $password, $dbname)
  {
    $this->conn = new mysqli($host, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getEvaluates() {
    $stmt = $this->conn->prepare("SELECT e.*, u.UserName, a.Answer FROM ANSWER_EVALUATES e INNER JOIN USERS u ON e.UserID = u.UserID INNER JOIN ANSWERS a ON e.AnswerID = a.AnswerID ORDER BY e.CreatedDate DESC");
    $stmt->execute();

    $result = $stmt->get_result();

    $evaluates = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $evaluates[] = $row;
      }
    }

    $stmt->close();

    return $evaluates;
  }

  public function getEvaluatesByAnswerID($AnswerID) {
    // JOIN USERS
    $stmt = $this->conn->prepare("SELECT e.*, u.UserName FROM ANSWER_EVALUATES e INNER JOIN USERS u ON e.UserID = u.UserID WHERE e.AnswerID = ? ORDER BY e.CreatedDate DESC");
    $stmt->bind_param("i", $AnswerID);
    $stmt->execute();

    $result = $stmt->get_result();

    $evaluates = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $evaluates[] = $row;
      }
    }

    $stmt->close();

    return $evaluates;
  }

  public function addEvaluate($AnswerID, $RateCategory, $UserID) {
    $stmt = $this->conn->prepare("INSERT INTO ANSWER_EVALUATES (AnswerID, RateCategory, UserID, CreatedDate) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("isi", $AnswerID, $RateCategory, $UserID);
    $stmt->execute();

    $EvaluateID = $stmt->insert_id;

    $stmt->close();

    return $EvaluateID;
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}