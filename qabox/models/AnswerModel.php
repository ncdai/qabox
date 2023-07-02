<?php

class AnswerModel
{
  private $conn;

  public function __construct($host, $username, $password, $dbname)
  {
    $this->conn = new mysqli($host, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  private function refValues($arr)
  {
    $refs = array();

    foreach ($arr as $key => $value) {
      $refs[$key] = &$arr[$key];
    }

    return $refs;
  }

  private function getAnswersCount($username = null, $answer = null) {
    $query = "SELECT COUNT(*) AS total FROM ANSWERS a INNER JOIN USERS u ON a.UserID = u.UserID WHERE 1=1";

    $params = array();

    if ($username) {
      $query .= " AND u.UserName LIKE ?";
      $params[0] .= "s";
      $params[] = "%$username%";
    }

    if ($answer) {
      $query .= " AND a.Answer LIKE ?";
      $params[0] .= "s";
      $params[] = "%$answer%";
    }

    $stmt = $this->conn->prepare($query);
    if (!empty($params)) {
      call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
    }
    // call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total = $row['total'];

    $stmt->close();

    return $total;
  }

  public function searchAnswers($page = 1, $username = null, $answer = null) {
    $limit = ITEM_PER_PAGE;
    $offset = ($page - 1) * $limit;

    $query = "SELECT a.*, u.UserName FROM ANSWERS a INNER JOIN USERS u ON a.UserID = u.UserID WHERE 1=1";

    $params = array();

    if ($username) {
      $query .= " AND u.UserName LIKE ?";
      $params[0] .= "s";
      $params[] = "%$username%";
    }

    if ($answer) {
      $query .= " AND a.Answer LIKE ?";
      $params[0] .= "s";
      $params[] = "%$answer%";
    }

    $query .= " ORDER BY a.CreatedDate DESC LIMIT ? OFFSET ?";
    $params[0] .= "ii";
    $params[] = $limit;
    $params[] = $offset;

    $stmt = $this->conn->prepare($query);
    if (!empty($params)) {
      call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
    }
    $stmt->execute();

    $result = $stmt->get_result();

    $answers = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $answers[] = $row;
      }
    }

    $stmt->close();

    $total = $this->getAnswersCount($username, $answer);

    return [
      'total' => $total,
      'data' => $answers
    ];
  }

  // public function getAnswers() {
  //   $stmt = $this->conn->prepare("SELECT a.*, u.UserName FROM ANSWERS a INNER JOIN USERS u ON a.UserID = u.UserID ORDER BY a.CreatedDate DESC");
  //   $stmt->execute();

  //   $result = $stmt->get_result();

  //   $answers = [];

  //   if ($result->num_rows > 0) {
  //     while ($row = $result->fetch_assoc()) {
  //       $answers[] = $row;
  //     }
  //   }

  //   $stmt->close();

  //   return $answers;
  // }

  public function getAnswersByQuestionID($QuestionID) {
    $stmt = $this->conn->prepare("SELECT a.*, u.UserName FROM ANSWERS a INNER JOIN USERS u ON a.UserID = u.UserID WHERE a.QuestionID = ?");
    $stmt->bind_param("i", $QuestionID);
    $stmt->execute();

    $result = $stmt->get_result();

    $answers = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $answers[] = $row;
      }
    }

    $stmt->close();

    return $answers;
  }

  public function addAnswer($QuestionID, $Answer, $Reference, $UserID) {
    $stmt = $this->conn->prepare("INSERT INTO ANSWERS (QuestionID, Answer, Reference, UserID, CreatedDate) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("issi", $QuestionID, $Answer, $Reference, $UserID);
    $stmt->execute();

    $AnswerID = $stmt->insert_id;

    $stmt->close();

    return $AnswerID;
  }

  public function getAnswer($AnswerID) {
    $stmt = $this->conn->prepare("SELECT a.*, u.UserName FROM ANSWERS a INNER JOIN USERS u ON a.UserID = u.UserID WHERE a.AnswerID = ?");
    $stmt->bind_param("i", $AnswerID);
    $stmt->execute();

    $result = $stmt->get_result();

    $answer = null;

    if ($result->num_rows > 0) {
      $answer = $result->fetch_assoc();
    }

    $stmt->close();

    return $answer;
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}