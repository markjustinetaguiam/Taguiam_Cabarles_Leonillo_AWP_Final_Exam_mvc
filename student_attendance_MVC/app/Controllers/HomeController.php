<?php

class HomeController
{

    public function viewHomePage()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        require_once('./public/views/HomePage.php');
    }
}
