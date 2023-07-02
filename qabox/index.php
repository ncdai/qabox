<?php

// require_once 'config.php';

require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/QuestionController.php';
require_once 'controllers/AnswerController.php';
require_once 'controllers/EvaluateController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$router = [
  'GET' => [
    // Home
    '/' => 'HomeController@getHome',

    '/login' => 'UserController@getLogin',
    '/logout' => 'UserController@logout',

    // Question
    '/questions' => 'QuestionController@getList',
    // '/questions/search' => 'QuestionController@getSearch',
    '/questions/add' => 'QuestionController@getAdd',
    '/questions/view' => 'QuestionController@getView',
    '/questions/answers' => 'QuestionController@getListAnswer',

    // Answer
    '/answers' => 'AnswerController@getList',
    '/answers/evaluates' => 'AnswerController@getListEvaluate',

    // Evaluate
    '/evaluates' => 'EvaluateController@getList',

    // User
    '/user/update-role' => 'UserController@getUpdateRole',
  ],
  'POST' => [
    '/login' => 'UserController@postLogin',

    // Question
    '/api/questions' => 'QuestionController@postAdd',

    // Answer
    '/api/answers' => 'AnswerController@postAdd',

    // Evaluate
    '/api/evaluates' => 'EvaluateController@postAddEvaluate',

    // User
    '/api/user/me/role' => 'UserController@postUpdateMyRole',
  ]
];

// Phân tích URL và truy xuất tham số query
$uriParts = parse_url($requestUri);
$path = $uriParts['path'];
$query = isset($uriParts['query']) ? $uriParts['query'] : '';

if (isset($router[$requestMethod])) {
  $routes = $router[$requestMethod];
  foreach ($routes as $route => $action) {
    if ($path === $route) {
      [$controllerName, $methodName] = explode('@', $action);

      // Phân tích và truyền các tham số query vào phương thức
      parse_str($query, $queryParams);

      $controller = new $controllerName();
      $controller->$methodName($queryParams);

      exit();
    }
  }
}

// Nếu không tìm thấy route phù hợp
http_response_code(404);

$content = 'views/404.php';
include 'views/layout.php';

?>
