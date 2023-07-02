<?php

class QuestionModel
{
  private $conn;

  public function __construct($host, $username, $password, $dbname)
  {
    $this->conn = new mysqli($host, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function addQuestion($Question, $Tags, $UserID)
  {
    $stmt = $this->conn->prepare("INSERT INTO QUESTIONS (Question, Tags, UserID, CreatedDate) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ssi", $Question, $Tags, $UserID);

    $result = $stmt->execute();

    $QuestionID = null;

    if ($result) {
      $QuestionID = $stmt->insert_id;
    }

    $stmt->close();

    return $QuestionID;
  }

  public function getQuestion($QuestionID)
  {
    $stmt = $this->conn->prepare("SELECT q.*, u.UserName FROM QUESTIONS q INNER JOIN USERS u ON q.UserID = u.UserID WHERE q.QuestionID = ?");
    $stmt->bind_param("i", $QuestionID);

    $stmt->execute();

    $result = $stmt->get_result();

    $question = null;

    if ($result->num_rows > 0) {
      $question = $result->fetch_assoc();
    }

    $stmt->close();

    return $question;
  }

  public function getQuestions()
  {
    $stmt = $this->conn->prepare("SELECT q.*, u.UserName FROM QUESTIONS q INNER JOIN USERS u ON q.UserID = u.UserID");
    $stmt->execute();

    $result = $stmt->get_result();

    $questions = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }
    }

    $stmt->close();

    return $questions;
  }

  public function incNumberAnswerers($QuestionID)
  {
    $stmt = $this->conn->prepare("UPDATE QUESTIONS SET NumberAnswerers = NumberAnswerers + 1 WHERE QuestionID = ?");
    $stmt->bind_param("i", $QuestionID);

    $result = $stmt->execute();

    $stmt->close();

    return $result;
  }

  public function searchQuestions($page = 1, $username = null, $question = null, $tags = null)
  {
    $limit = ITEM_PER_PAGE;
    $offset = ($page - 1) * $limit;

    $query = "SELECT q.*, u.UserName
              FROM QUESTIONS q
              INNER JOIN USERS u ON q.UserID = u.UserID
              WHERE 1=1";

    $countQuery = "SELECT COUNT(*) AS total FROM QUESTIONS q INNER JOIN USERS u ON q.UserID = u.UserID WHERE 1=1";

    if ($username) {
      $query .= " AND u.UserName LIKE ?";
      $countQuery .= " AND u.UserName LIKE ?";

      $params[0] .= "s";
      $params[] = "%$username%";
    }

    if ($question) {
      $query .= " AND q.Question LIKE ?";
      $countQuery .= " AND q.Question LIKE ?";

      $params[0] .= "s";
      $params[] = "%$question%";
    }

    if ($tags) {
      $query .= " AND q.Tags LIKE ?";
      $countQuery .= " AND q.Tags LIKE ?";

      $params[0] .= "s";
      $params[] = "%$tags%";
    }

    // echo json_encode($params);

    $countStmt = $this->conn->prepare($countQuery);
    if (!empty($params)) {
      call_user_func_array(array($countStmt, 'bind_param'), $this->refValues($params));
    }
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $totalResult = $countResult->fetch_assoc()['total'];

    $query .= " LIMIT ? OFFSET ?";
    $params[0] .= "ii";
    $params[] = $limit;
    $params[] = $offset;

    $stmt = $this->conn->prepare($query);
    if (!empty($params)) {
      call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $questions = array();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }
    }

    $stmt->close();

    return array(
      'total' => $totalResult,
      'data' => $questions
    );
  }

  private function refValues($arr)
  {
    $refs = array();

    foreach ($arr as $key => $value) {
      $refs[$key] = &$arr[$key];
    }

    return $refs;
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}