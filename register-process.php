<?php
session_start();
include('includes/koneksi.php');
include('includes/auth-flow.php');

$full_name        = $_POST['full_name'];
$email            = $_POST['email'];
$phone            = $_POST['phone'];
$password         = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$redirect   = '';
$link_balik = 'register.php';
$link_login = 'login.php';

if (isset($_POST['redirect'])) {
    $redirect = arunikaSafeBookingRedirect($_POST['redirect']);
    if ($redirect != '') {
        $link_balik = 'register.php?redirect=' . rawurlencode($redirect);
        $link_login = 'login.php?redirect=' . rawurlencode($redirect);
    }
}

$error = '';

if (strlen($full_name) < 2) {
    $error = 'Nama lengkap minimal 2 karakter.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Format email tidak valid.';
} elseif (strlen($phone) < 8) {
    $error = 'Nomor telepon tidak valid.';
} elseif (strlen($password) < 8) {
    $error = 'Password minimal 8 karakter.';
} elseif ($password != $confirm_password) {
    $error = 'Konfirmasi password tidak sama.';
} elseif (!isset($_POST['terms_agreed'])) {
    $error = 'Anda harus menyetujui syarat dan ketentuan.';
}

if ($error != '') {
    $_SESSION['error'] = $error;
    header('Location: ' . $link_balik);
    exit;
}

$nama_aman  = mysqli_real_escape_string($koneksi, $full_name);
$email_aman = mysqli_real_escape_string($koneksi, $email);
$phone_aman = mysqli_real_escape_string($koneksi, $phone);

$cek = mysqli_query($koneksi, "SELECT id FROM users WHERE email='$email_aman'");
if (mysqli_num_rows($cek) > 0) {
    $_SESSION['error'] = 'Email sudah terdaftar.';
    header('Location: ' . $link_balik);
    exit;
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$simpan = mysqli_query($koneksi, "INSERT INTO users (full_name, email, phone, password)
    VALUES ('$nama_aman', '$email_aman', '$phone_aman', '$password_hash')");

if ($simpan) {
    $_SESSION['sukses'] = 'Akun berhasil dibuat. Silakan masuk.';
    header('Location: ' . $link_login);
} else {
    $_SESSION['error'] = 'Pendaftaran gagal, silakan coba lagi.';
    header('Location: ' . $link_balik);
}
exit;