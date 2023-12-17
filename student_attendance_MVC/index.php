<?php

session_start();

include('config/middleware.php');
include('./app/Controllers/AuthController.php');
include('./app/Controllers/StudentController.php');
include('./app/Controllers/HomeController.php');
include('./app/Controllers/AttendanceController.php');

$request_uri = $_SERVER['REQUEST_URI'];
$route = rtrim(strtok($request_uri, '?'), '/');

$routes = [
  '' => 'HomeController@viewHomePage',
  '/home' => 'HomeController@viewHomePage',
  '/register' => 'StudentController@register',
  '/create' => 'StudentController@create',
  '/list' => 'StudentController@listStudents',
  '/search' => 'StudentController@searchStudents',
  '/login' => 'AuthController@login',
  '/logout' => 'AuthController@logout',
  '/attendance' => 'AttendanceController@viewAttendancePage',
  '/save-attendance' => 'AttendanceController@saveAttendance',
  '/view-attendance' => 'AttendanceController@viewAttendance',
  '/display-attendance' => 'AttendanceController@displayAttendance',
  '/edit-student' => 'StudentController@editStudent',
  '/update-student' => 'StudentController@updateStudent',
  '/list-students' => 'StudentController@listStudents',
  '/archive-student' => 'StudentController@archiveStudent',
];
if (array_key_exists($route, $routes)) {
  if (!isset($_SESSION['user_id']) && in_array($route, ['/home', '/register', '/create', '/list', '/search', '/attendance', '/view-attendance', '/display-attendance'])) {
    $_SESSION['redirect_url'] = $route;
    header('Location: /login');
    exit();
  }

  $route_parts = explode('@', $routes[$route]);
  $controller = $route_parts[0];
  $method = $route_parts[1];

  $controller = new $controller();
  $controller->$method();
} else {
  echo '404 Not Found';
}

?>