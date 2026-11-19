<?php
session_start();
include('includes/koneksi.php');
include('includes/auth-flow.php');

$email    = trim($_POST['email']);
$password = $_POST['password'];

$redirect   = '';
$link_balik = 'login.php';

if (isset($_POST['redirect'])) {
    $redirect = arunikaSafeBookingRedirect($_POST['redirect']);
    if ($redirect != '') {
        $link_balik = 'login.php?redirect=' . rawurlencode($redirect);
    }
}

$email_aman = mysqli_real_escape_string($koneksi, $email);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email_aman'");
$user  = mysqli_fetch_assoc($query);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['error'] = 'Email atau password salah.';
    header('Location: ' . $link_balik);
    exit;
}

session_regenerate_id(true);

$_SESSION['user_id']   = $user['id'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['role']      = $user['role'];

if ($user['role'] == 'admin') {
    header('Location: admin/dashboard.php');
    exit;
}

$tujuan = arunikaResolveBookingRedirect($redirect);
unset($_SESSION['pending_booking']);

if ($tujuan == '') {
    $tujuan = 'index.php';
}

header('Location: ' . $tujuan);
exit;