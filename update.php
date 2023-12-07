<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="update.css">
    <script>
        // Fungsi untuk memvalidasi form sebelum pengiriman data
        function validateForm() {
            // Mengambil nilai dari setiap input
            var nama = document.getElementsByName("nama")[0].value;
            var npm = document.getElementsByName("npm")[0].value;
            var kelas = document.getElementsByName("kelas")[0].value;
            var jurusan = document.getElementsByName("jurusan")[0].value;

            // Memeriksa apakah setiap field kosong
            if (nama === '' || npm === '' || kelas === '' || jurusan === '') {
                alert("Semua kolom harus diisi");
                return false; // Mengembalikan false jika ada field yang kosong
            } else {
                // Konfirmasi sebelum mengirim data
                var confirmation = confirm("Apakah Anda yakin ingin mengirim data?");
                return confirmation; // Mengembalikan hasil konfirmasi
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <?php
        // Menghubungkan ke file koneksi.php
        include "koneksi.php";

        // Fungsi untuk membersihkan input dari karakter-karakter khusus
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Memperbarui data berdasarkan input yang diterima dari form
            $id = input($_POST["id"]);
            $nama = input($_POST["nama"]);
            $npm = input($_POST["npm"]);
            $kelas = input($_POST["kelas"]);
            $jurusan = input($_POST["jurusan"]);

            $sql = "UPDATE mahasiswa SET 
                    nama = '$nama',
                    npm = '$npm',
                    kelas = '$kelas',
                    jurusan = '$jurusan'
                    WHERE id = '$id'";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location: index.php"); // Redirect jika berhasil
                exit;
            } else {
                echo "<div class='alert alert-danger'>Data gagal disimpan.</div>";
            }
        }

        // Mengambil data yang akan diupdate berdasarkan id
        if (isset($_GET["id"])) {
            $id = input($_GET["id"]);

            $sql = "SELECT * FROM mahasiswa WHERE id = $id";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }
        ?>
        <h2>Update Data</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validateForm()">
            <!-- Input untuk Nama -->
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="<?php echo $data['nama']; ?>" required />
            </div>

            <!-- Input untuk NPM -->
            <div class="form-group">
                <label>NPM</label>
                <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM" value="<?php echo $data['npm']; ?>" required />
            </div>

            <!-- Input untuk Kelas -->
            <div class="form-group">
                <label>Kelas</label>
                <input type="text" name="kelas" class="form-control" placeholder="Masukkan Kelas" value="<?php echo $data['kelas']; ?>" required />
            </div>

            <!-- Input untuk Jurusan -->
            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" value="<?php echo $data['jurusan']; ?>" required />
            </div>

            <!-- Input tersembunyi untuk ID -->
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" /> 
            
            <!-- Tombol untuk mengirim form -->
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
