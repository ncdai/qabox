<?php
require_once 'models/AnswerModel.php';
require_once 'models/QuestionModel.php';
require_once 'config.inc';

session_start();

class AnswerController
{
  private $answerModel;
  private $questionModel;
  private $evaluateModel;

  public function __construct()
  {
    $this->answerModel = new AnswerModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $this->questionModel = new QuestionModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $this->evaluateModel = new EvaluateModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function getList() {
    $Page = isset($_GET['Page']) ? $_GET['Page'] : 1;

    // Filter
    $UserName = isset($_GET['UserName']) ? trim($_GET['UserName']) : null;
    $Answer = isset($_GET['Answer']) ? trim($_GET['Answer']) : null;
    $isFilterMode = $UserName || $Answer;

    $res = $this->answerModel->searchAnswers($Page, $UserName, $Answer);
    $TotalItems = $res['total'];
    $AnswerList = $res['data'];

    // $AnswerList = $this->answerModel->getAnswers();
    include 'views/answer/list/index.php';
  }

  public function postAdd() {
    $QuestionID = $_POST['QuestionID'];
    $Answer = $_POST['Answer'];
    $Reference = $_POST['Reference'];
    $UserID = $_SESSION['user']['UserID'];

    $AnswerID = $this->answerModel->addAnswer($QuestionID, $Answer, $Reference, $UserID);

    if ($AnswerID !== null) {
      $this->questionModel->incNumberAnswerers($QuestionID);

      $response = [
        'status' => 'success',
        'message' => 'Thêm câu trả lời thành công',
        'data' => [
          'AnswerID' => $AnswerID
        ]
      ];
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Thêm câu trả lời khÔng thành công'
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function getListEvaluate()
  {
    $AnswerID = $_GET['AnswerID'];
    $AnswerItem = $this->answerModel->getAnswer($AnswerID);
    $QuestionItem = $this->questionModel->getQuestion($AnswerItem['QuestionID']);
    $EvaluateList = $this->evaluateModel->getEvaluatesByAnswerID($AnswerID);

    include 'views/answer/list-evaluate/index.php';
  }

  function __destruct()
  {
    $this->answerModel->closeConnection();
    $this->questionModel->closeConnection();
    $this->evaluateModel->closeConnection();
  }
}