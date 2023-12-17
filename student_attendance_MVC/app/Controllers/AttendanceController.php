<?php

require_once(__DIR__ . '/../Models/AttendanceModel.php');

class AttendanceController
{
  private $attendanceModel;
  private $studentModel;

  public function __construct()
  {
    $this->attendanceModel = new AttendanceModel();
    $this->studentModel = new StudentModel();
  }

  public function viewAttendancePage()
  {
    $students = $this->studentModel->getAllStudents();
    require_once('./public/views/AttendancePage.php');
  }

  public function saveAttendance()
  {
    $successMessage = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $date = $_POST['date'];
      $attendanceData = $_POST['attendance'];

      $result = $this->attendanceModel->saveAttendance($date, $attendanceData);

      if ($result) {
        $successMessage = 'Attendance saved successfully.';
      } else {
        $successMessage = 'Failed to save attendance.';
      }
    }

    $students = $this->studentModel->getAllStudents();

    require_once('./public/views/AttendancePage.php');
  }

  public function viewAttendance()
  {
    $attendanceDates = $this->attendanceModel->getDistinctAttendanceDates();
    require_once('./public/views/AttendanceViewPage.php');
  }

  public function displayAttendance()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['selected_date'])) {
        $selectedDate = $_POST['selected_date'];
        $_SESSION['selected_date'] = $selectedDate;
        $attendanceData = $this->attendanceModel->getAttendanceByDate($selectedDate);

        require_once('./public/views/AttendanceViewPage.php');
      }
    }
  }
}