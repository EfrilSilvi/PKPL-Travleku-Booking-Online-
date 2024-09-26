<?php
include "koneksi.php";

$user   = $_POST['username'];
$pass   = $_POST['password'];
$full   = $_POST['fullname'];

$cekuser = mysqli_num_rows(mysqli_query($connect, "SELECT username FROM user WHERE username='$user'"));

if (empty($user) || empty($pass) || empty($full)) {
    echo "<script>window.alert('Semua kolom harus diisi'); window.location.href='signup.php';</script>";
} else {
    // Memeriksa apakah username telah digunakan
    $cekuser = mysqli_num_rows(mysqli_query($connect, "SELECT username FROM user WHERE username='$user'"));
    
    if ($cekuser > 0) {
        echo "<script>window.alert('Username telah digunakan!!!'); window.location.href='signup.php';</script>";
    } else {
        // Menyimpan data ke database jika semua valid
        $sql = 'INSERT INTO user(username, password, fullname) VALUES ("'.$user.'", "'.$pass.'", "'.$full.'") ';
        $query = mysqli_query($connect, $sql);

        if ($query) {
            echo "<script>window.alert('Selamat, Akun anda berhasil dibuat'); window.location.href='signin.php';</script>";
        } else {
            echo "Error: " . mysqli_error($connect);
            // Atau Anda bisa menampilkan pesan kesalahan yang sesuai dengan kebutuhan.
        }
    }
}

?>
