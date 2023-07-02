<?php
require_once 'models/QuestionModel.php';
require_once 'models/AnswerModel.php';
require_once 'models/EvaluateModel.php';

require_once 'helpers/PaginationHelper.php';

require_once 'config.inc';

session_start();

class QuestionController
{
  private $questionModel;
  private $answerModel;
  private $evaluateModel;

  public function __construct()
  {
    $this->questionModel = new QuestionModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $this->answerModel = new AnswerModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $this->evaluateModel = new EvaluateModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function getList()
  {
    $Page = isset($_GET['Page']) ? $_GET['Page'] : 1;

    // Filter
    $UserName = isset($_GET['UserName']) ? trim($_GET['UserName']) : null;
    $Question = isset($_GET['Question']) ? trim($_GET['Question']) : null;
    $Tags = isset($_GET['Tags']) ? trim($_GET['Tags']) : null;
    $isFilterMode = $UserName || $Question || $Tags;

    $res = $this->questionModel->searchQuestions($Page, $UserName, $Question, $Tags);
    $TotalItems = $res['total'];
    $QuestionList = $res['data'];

    include 'views/question/list/index.php';
  }

  public function getListAnswer()
  {
    $QuestionID = $_GET['QuestionID'];
    $QuestionItem = $this->questionModel->getQuestion($QuestionID);
    $AnswerList = $this->answerModel->getAnswersByQuestionID($QuestionID);

    include 'views/question/list-answer/index.php';
  }

  public function getAdd()
  {
    include 'views/question/add/index.php';
  }

  public function postAdd()
  {
    $Question = $_POST['Question'];
    $Tags = $_POST['Tags'];
    $UserID = $_SESSION['user']['UserID'];

    $QuestionID = $this->questionModel->addQuestion($Question, $Tags, $UserID);

    if ($QuestionID !== null) {
      $response = [
        'status' => 'success',
        'message' => 'Thêm câu hỏi thành công',
        'data' => [
          'QuestionID' => $QuestionID
        ]
      ];
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Thêm câu hỏi không thành công',
        'data' => []
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }

  public function getView()
  {
    $QuestionID = $_GET['id'];

    $QuestionItem = $this->questionModel->getQuestion($QuestionID);

    include 'views/question/view/index.php';
  }

  function __destruct()
  {
    $this->questionModel->closeConnection();
    $this->answerModel->closeConnection();
    $this->evaluateModel->closeConnection();
  }
}