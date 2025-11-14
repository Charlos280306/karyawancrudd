<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-karyawan.php';
// Membuat objek dari class Mahasiswa
$karyawan = new Karyawan();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataKaryawan = [
    'no' => $_POST['no'],
    'nama' => $_POST['nama'],
    'divisi' => $_POST['divisi'],
    'alamat' => $_POST['alamat'],
    'jabatan' => $_POST['jabatan'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'status' => $_POST['status']
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $karyawan->inputKaryawan($dataKaryawan);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>