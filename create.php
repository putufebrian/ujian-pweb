<!DOCTYPE html>
<html>
    <head>
        <title>Form Pendaftaran Peserta</title>
        <link rel="stylesheet" href="create.css"> <!-- Memasukkan file eksternal CSS untuk styling -->
    </head>
    <body>
        <div class="container">
            <?php
            // Memasukkan file koneksi.php yang berisi koneksi ke database
            include "koneksi.php";

            // Fungsi untuk membersihkan dan melindungi data dari inputan pengguna
            function input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Mengecek apakah ada data yang dikirimkan melalui metode POST
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = input($_POST["nama"]); // Mendapatkan dan membersihkan data nama
                $npm = input($_POST["npm"]); // Mendapatkan dan membersihkan data NPM
                $kelas = input($_POST["kelas"]); // Mendapatkan dan membersihkan data kelas
                $jurusan = input($_POST["jurusan"]); // Mendapatkan dan membersihkan data jurusan

                // Query untuk memasukkan data ke dalam tabel mahasiswa
                $sql = "INSERT INTO mahasiswa (nama, npm, kelas, jurusan) VALUES ('$nama', '$npm', '$kelas', '$jurusan')";

                // Eksekusi query
                $hasil = mysqli_query($kon, $sql);

                // Memeriksa apakah query berhasil dijalankan atau tidak
                if ($hasil) {
                    header("Location:index.php"); // Redirect ke halaman index.php jika berhasil
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal Disimpan.</div>"; // Menampilkan pesan jika gagal
                }
            }
            ?>
            <h2>Input Data</h2>
            <!-- Form untuk input data mahasiswa -->
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required />
                </div>
                <div class="form-group">
                    <label>NPM</label>
                    <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM" required />
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Masukkan Kelas" required />
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" required />
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button> <!-- Tombol untuk mengirimkan form -->
            </form>
        </div>
    </body>
</html>
