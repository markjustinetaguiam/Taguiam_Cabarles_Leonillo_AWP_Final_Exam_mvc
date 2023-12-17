<?php

require_once('./config/db_config.php');

class AttendanceModel
{
  private $conn;

  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  public function saveAttendance($date, $attendanceData)
  {
    foreach ($attendanceData as $student_id => $attendance_status) {
      $present_value = ($attendance_status === 'present') ? 1 : 0;
      $absent_value = ($attendance_status === 'absent') ? 1 : 0;

      $stmt = $this->conn->prepare("CALL SaveAttendanceProcedure(?, ?, ?, ?)");
      $stmt->bind_param("siii", $date, $student_id, $present_value, $absent_value);
      $stmt->execute();

      if (!$stmt->affected_rows) {
        return false;
      }
    }

    return true;
  }
  public function getDistinctAttendanceDates()
  {
    $sql = "SELECT DISTINCT date FROM attendance";
    $result = mysqli_query($this->conn, $sql);

    $dates = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $dates[] = $row['date'];
    }

    return $dates;
  }

  public function getAttendanceByDate($selectedDate)
  {
    $sql = "SELECT students.student_name, 
                 CASE WHEN attendance.present_count = 1 THEN students.student_name ELSE NULL END as present,
                 CASE WHEN attendance.absent_count = 1 THEN students.student_name ELSE NULL END as absent
          FROM students
          LEFT JOIN attendance ON students.student_id = attendance.student_id
          WHERE attendance.date = '$selectedDate'";

    $result = mysqli_query($this->conn, $sql);

    if ($result) {
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
      return [];
    }
  }

}

