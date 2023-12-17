<?php


require_once(__DIR__ . '/../Models/StudentModel.php');

class StudentController
{



  private $studentModel;

  public function __construct()
  {
    $this->studentModel = new StudentModel();
  }

  public function register()
  {
    require_once('./public/views/register.php');
  }


  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $result = $this->studentModel->createStudent($name, $email, $phone);

      if ($result) {
        header('Location: /register?success=1');
        exit();
      } else {
        echo 'Failed to create student';
      }
    }
  }

  public function listStudents()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /public/views/LogInPage.php');
      exit();
    }

    $students = $this->studentModel->getUnarchivedStudents();
    require_once('./public/views/StudentList.php');
  }
  public function archiveStudent()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $studentId = $_GET['id'];
      $result = $this->studentModel->archiveStudent($studentId);

      if ($result) {
        header('Location: /list-students');
        exit();
      } else {
        echo 'Failed to archive student';
      }
    }
  }


  public function editStudent()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
      $studentId = $_GET['id'];
      $student = $this->studentModel->getStudentById($studentId);

      if ($student) {
        require_once('./public/views/edit-student.php');
      } else {
        echo 'Student not found';
      }
    }
  }

  public function updateStudent()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $studentId = $_POST['student_id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];

      $result = $this->studentModel->updateStudent($studentId, $name, $email, $phone);

      if ($result) {
        $_SESSION['success_message'] = 'Student details updated successfully';

        header('Location: /list-students');
        exit();
      } else {
        echo 'Failed to update student';
      }
    }
  }



}



?>