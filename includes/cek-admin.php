<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
}

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
}
?>