<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-karyawan.php';
// Membuat objek dari class Mahasiswa
$karyawan = new Karyawan();
// Mengambil id mahasiswa dari parameter GET
$id = $_GET['id'];
// Memanggil method deleteMahasiswa untuk menghapus data mahasiswa berdasarkan id
$delete = $karyawan->deleteKaryawan($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>