<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout-button {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <!-- Common header content -->
    <div class="header">
        <?php
        if (isset($_SESSION['user_id'])) {
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            echo "<h1 class='text-primary'>Welcome, " . $username . "</h1>";
            echo '<a href="/logout" class="btn btn-primary logout-button">Logout</a>';
        } else {
            echo '<a href="/login" class="btn btn-primary logout-button">Login</a>';
        } ?>
    </div>
    <div class="navbar">
        <a href="/home" class="nav-link">Home</a>
        <a href="" data-route="/list" class="nav-link">Student List</a>
        <a href="/register" class="nav-link">Add new student</a>
        <a href="/attendance" class="nav-link">Add Attendance Record</a>
        <a href="/view-attendance" class="nav-link">Attendance List</a>
    </div>
    <script src="/public/resources/js/scripts.js"></script>
    <!-- Include Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>