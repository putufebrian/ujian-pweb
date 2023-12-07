<!DOCTYPE html>
<html>
    <head>
        <!-- Sertakan stylesheet eksternal -->
        <link rel="stylesheet" href="index.css">
    </head>
    <title>
        Alfito Dwi Putra
    </title>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <!-- Tautan Logout -->
            <a href="login.html" class="btn btn-delete btn-logout" role="button">Logout</a>
        </nav>
        <div class="container">
            <br>
            <h4 class="header-title">DAFTAR PESERTA UJIAN</h4>

            <?php

            // Sertakan file koneksi ke database
            include "koneksi.php";

            if (isset($_GET['id'])) {
                $id = htmlspecialchars_decode($_GET['id']);

                // Query SQL untuk menghapus data
                $sql="delete from mahasiswa where id = '$id' ";
                $hasil=mysqli_query($kon, $sql);

                // Periksa apakah penghapusan berhasil
                if ($hasil) {
                    header("Location:index.php");

                }
                else {
                    echo "<div class='alert alert-danger'> Data Gagal di Hapus.</div>";

                }
            }

            ?>

            <tr class="tabel-danger">
                <br>
                <thead>
                    <tr>
                        <table class="my-3 table table-bordered">
                            <tr class="table-primary">
                                <!-- Header Tabel -->
                                <th>No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                    </tr>
                </thead>
            </tr>

            <?php
            // Sertakan file koneksi ke database
            include "koneksi.php";

            // Pilih data dari database
            $sql="select * from mahasiswa order by id desc";

            $hasil=mysqli_query($kon, $sql);
            $no=0;
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;

                ?>
                <tbody>
                    <tr>
                        <!-- Tampilkan data dalam baris tabel -->
                        <td><?php echo $no;?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["npm"]; ?></td>
                        <td><?php echo $data["kelas"]; ?></td>
                        <td><?php echo $data["jurusan"]; ?></td>
                        <td>
                            <!-- Tombol Update dan Delete -->
                            <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id']; ?>" class="btn btn-delete" role="button">Delete</a>
                        </td>
                    </tr>
                </tbody>
                <?php
            }
            ?>

            <!-- Tombol untuk menambahkan data baru -->
            <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>  
        </div>
    </body>
</html>
