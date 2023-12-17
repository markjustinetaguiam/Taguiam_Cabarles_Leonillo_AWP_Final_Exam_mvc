<?php include('header.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <title>Attendance View</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
  <style>
    .view-attendance-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .view-another-date-button {
      margin-left: auto;
    }
  </style>
</head>

<body>
  <h1>Attendance View</h1>

  <?php if (empty($attendanceData)): ?>
    <form method="post" action="/display-attendance">
      <label for="selected_date">Select Date:</label>
      <select name="selected_date" style="display: inline;">
        <?php
        $defaultDate = date('Y-m-d');
        foreach ($attendanceDates as $date):
          ?>
          <option value="<?= $date ?>" <?= ($date === $defaultDate) ? 'selected' : '' ?>>
            <?= $date ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit">View Attendance</button>
    </form>
  <?php else: ?>
    <div class="view-attendance-section">
      <p>Viewing attendance for
        <?= $_SESSION['selected_date'] ?>
      </p>
      <form method="post" action="/view-attendance">
        <input type="hidden" name="selected_date" value="<?= $_SESSION['selected_date'] ?>">
        <button type="submit" class="view-another-date-button" name="view_another_date">View Another Attendance</button>
      </form>
    </div>
  <?php endif; ?>

  <?php if (!empty($attendanceData)): ?>
    <table border="1">
      <tr>
        <th>Present</th>
        <th>Absent</th>
      </tr>

      <?php if (isset($attendanceData) && !empty($attendanceData)): ?>
        <tr>
          <td>
            <?php foreach ($attendanceData as $attendance): ?>
              <?php if ($attendance['present']): ?>
                <?= $attendance['student_name'] ?><br>
              <?php endif; ?>
            <?php endforeach; ?>
          </td>
          <td>
            <?php foreach ($attendanceData as $attendance): ?>
              <?php if ($attendance['absent']): ?>
                <?= $attendance['student_name'] ?><br>
              <?php endif; ?>
            <?php endforeach; ?>
          </td>
        </tr>
      <?php else: ?>
        <tr>
          <td colspan="2">No attendance data available for the selected date.</td>
        </tr>
      <?php endif; ?>
    </table>
  <?php endif; ?>

</body>

</html>