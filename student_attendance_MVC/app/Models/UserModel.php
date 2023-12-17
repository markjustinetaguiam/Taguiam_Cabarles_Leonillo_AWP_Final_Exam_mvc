<?php
require_once('./config/db_config.php');

class UserModel
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getUserByUsername($username)
    {
        $username = mysqli_real_escape_string($this->conn, $username);
        $sql = "SELECT * FROM user_accounts WHERE username = '$username'";
        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }
}
