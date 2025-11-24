<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // tetap sesuai database kamu

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login Admin - HimaConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen">

    <div class="w-full max-w-sm bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-bold text-center mb-5">Login Admin</h2>

        <?php 
        if(isset($error)) {
            echo "<p class='bg-red-100 text-red-700 p-2 rounded mb-3 text-sm'>$error</p>";
        }
        ?>

        <form method="POST">

            <label class="block mb-2 font-medium text-sm">Username</label>
            <input type="text" 
                   name="username" 
                   required
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 mb-4">

            <label class="block mb-2 font-medium text-sm">Password</label>
            <input type="password" 
                   name="password" 
                   required
                   class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-400 mb-4">

            <button type="submit" 
                    name="login"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>

        </form>

        <!-- Tombol BACK pasti muncul karena diletakkan di luar form -->
        <a href="index.php" 
           class="w-full block text-center bg-gray-500 text-white py-2 rounded-lg mt-4 hover:bg-gray-600 transition">
            Kembali
        </a>

    </div>

</div>

</body>
</html>
