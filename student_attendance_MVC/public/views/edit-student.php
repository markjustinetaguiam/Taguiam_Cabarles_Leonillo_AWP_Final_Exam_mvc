<?php include('header.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <title>Edit Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
  <h1>Edit Student</h1>

  <?php if (isset($student) && !empty($student)): ?>
    <form method="post" action="/update-student">
      <input type="hidden" name="student_id" value="<?= $student['Student_ID'] ?>">
      <label for="name">Name:</label>
      <input type="text" name="name" value="<?= $student['student_name'] ?>" required><br>
      <label for="email">Email:</label>
      <input type="email" name="email" value="<?= $student['email'] ?>" required><br>
      <label for="phone">Phone:</label>
      <input type="text" name="phone" value="<?= $student['phone'] ?>" required><br>
      <button type="submit">Update Student</button>
    </form>
  <?php else: ?>
    <p>Student details not available.</p>
  <?php endif; ?>

</body>

</html>