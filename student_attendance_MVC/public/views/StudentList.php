<?php
include('header.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
    <h1>Student List</h1>
    <?php if (isset($_SESSION['success_message'])) {
        echo '<p style="color: green;">' . $_SESSION['success_message'] . '</p>';
        unset($_SESSION['success_message']);
    }
    ?>
    <div>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
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
                            <?= $student['email'] ?>
                        </td>
                        <td>
                            <?= $student['phone'] ?>
                        </td>
                        <td>
                            <a href="/archive-student?id=<?= $student['Student_ID'] ?>">Archive</a>
                            <a href="/edit-student?id=<?= $student['Student_ID'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No matching records found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
<script src="./resources/js/scripts.js"></script>

</html>