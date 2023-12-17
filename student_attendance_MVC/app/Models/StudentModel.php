<?php
require_once('./config/db_config.php');

class StudentModel
{
  private $conn;

  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
  }

  public function createStudent($name, $email, $phone)
  {
    $stmt = $this->conn->prepare("CALL CreateStudentProcedure(?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);

    $stmt->execute();

    $result = $stmt->affected_rows;

    $stmt->close();

    return $result;
  }
  public function getStudents()
  {
    $result = $this->conn->query("CALL GetStudentsProcedure()");
    $students = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
    return $students;
  }

  public function getStudentById($student_id)
  {
    $sql = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($this->conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      return mysqli_fetch_assoc($result);
    } else {
      return null;
    }
  }

  public function getAllStudents()
  {
    $sql = "SELECT * FROM students WHERE archived = 0";
    $result = mysqli_query($this->conn, $sql);
    $students = [];

    while ($row = mysqli_fetch_assoc($result)) {
      $students[] = $row;
    }

    return $students;
  }
  public function updateStudent($student_id, $name, $email, $phone)
  {
    $sql = "UPDATE students SET student_name = '$name', email = '$email', phone = '$phone' WHERE student_id = '$student_id'";
    $result = mysqli_query($this->conn, $sql);
    return $result;
  }

  public function archiveStudent($studentId)
  {
    $sql = "UPDATE students SET archived = 1 WHERE Student_ID = '$studentId'";
    $result = mysqli_query($this->conn, $sql);
    return $result;
  }

  public function getUnarchivedStudents()
  {
    $sql = "SELECT * FROM students WHERE archived = 0";
    $result = mysqli_query($this->conn, $sql);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $students;
  }

}

?>