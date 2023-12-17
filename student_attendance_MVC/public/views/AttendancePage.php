<?php include('header.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <title>Attendance</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
  <h1>Attendance</h1>
  <?php if (!empty($successMessage)): ?>
    <p class="success-message">
      <?= $successMessage ?>
    </p>
  <?php endif; ?>
  <form method="post" action="/save-attendance">
    <label for="date">Date:</label>
    <input type="date" name="date" required>

    <table border="1">
      <tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Present</th>
        <th>Absent</th>
      </tr>

      <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
          <tr>
            <td>
              <?= $student['Student_ID'] ?>
            </td>
            <td>
              <?= $student['student_name'] ?>
            </td>
            <td>
              <input type="radio" name="attendance[<?= $student['Student_ID'] ?? '' ?>]" value="present" required>
            </td>
            <td>
              <input type="radio" name="attendance[<?= $student['Student_ID'] ?? '' ?>]" value="absent" required>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="4">No students found.</td>
        </tr>
      <?php endif; ?>
    </table>

    <button type="submit">Save Attendance</button>
  </form>
</body>

<script src="./resources/js/scripts.js"></script>

</html>