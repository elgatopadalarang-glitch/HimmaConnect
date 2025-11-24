<?php
include 'config/koneksi.php';

$hasil = null;

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $hasil = mysqli_query($conn, "SELECT * FROM aspirasi WHERE email='$email'");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cek Aspirasi Kamu - HimaConnect</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-24 bg-white p-8 rounded-2xl shadow">

    <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">
        Cek Aspirasi Kamu
    </h2>

    <form method="POST" class="flex gap-3 mb-6">
        <input type="email" name="email" required
               placeholder="Masukan email kamu"
               class="flex-1 p-3 border rounded-lg">
        <button class="px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Cari
        </button>
    </form>

    <?php if ($hasil && mysqli_num_rows($hasil) > 0) { ?>
        <div class="space-y-4">

        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
            <div class="border p-4 rounded-xl bg-gray-50">
                
                <p><span class="font-semibold">Tanggal:</span> <?= $row['tanggal'] ?></p>

                <p class="mt-2 font-semibold">Aspirasi:</p>
                <p class="p-3 bg-white rounded-lg border"><?= nl2br($row['isi']) ?></p>

                <p class="mt-3 font-semibold">Balasan Admin:</p>

                <?php if ($row['balasan'] == "") { ?>
                    <p class="text-yellow-500">Belum dibalas</p>
                <?php } else { ?>
                    <p class="p-3 bg-green-50 border border-green-300 rounded-lg">
                        <?= nl2br($row['balasan']) ?>
                    </p>
                    <a href="detail_aspirasi_user.php?id=<?= $row['id_aspirasi'] ?>" 
                        class="text-blue-600 underline hover:text-blue-800">
                        Detail
                    </a>
                <?php } ?>

            </div>
        <?php } ?>

        </div>

    <?php } else if ($hasil !== null) { ?>

        <p class="text-center text-gray-500">Tidak ada aspirasi dengan email tersebut.</p>

    <?php } ?>

    <!-- TOMBOL BACK -->
    <div class="mt-8 text-center">
        <a href="index.php"
           class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 inline-block">
            kembali
        </a>
    </div>

</div>

</body>
</html>
