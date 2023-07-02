<?php
require_once 'models/EvaluateModel.php';
require_once 'config.inc';

session_start();

class EvaluateController
{
  private $evaluateModel;

  public function __construct()
  {
    $this->evaluateModel = new EvaluateModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function getList()
  {
    $EvaluateList = $this->evaluateModel->getEvaluates();

    include 'views/evaluate/list/index.php';
  }

  public function postAddEvaluate() {
    $AnswerID = $_POST['AnswerID'];
    $RateCategory = $_POST['RateCategory'];
    $UserID = $_SESSION['user']['UserID'];

    $EvaluateID = $this->evaluateModel->addEvaluate($AnswerID, $RateCategory, $UserID);

    if ($EvaluateID !== null) {
      $response = [
        'status' => 'success',
        'message' => 'Thêm đánh giá thành công',
        'data' => [
          'EvaluateID' => $EvaluateID
        ]
      ];
    } else {
      $response = [
        'status' => 'error',
        'message' => 'Thêm đánh giá không thành công',
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }

  function __destruct()
  {
    $this->evaluateModel->closeConnection();
  }
}