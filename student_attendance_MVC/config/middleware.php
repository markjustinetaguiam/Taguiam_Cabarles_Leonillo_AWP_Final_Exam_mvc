</ /?php function requireLogin() { if (!isset($_SESSION['user_logged_in'])) {
  $_SESSION['redirect_url']=$_SERVER['REQUEST_URI']; header('Location: /login'); exit(); } } ?>