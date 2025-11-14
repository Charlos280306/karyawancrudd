<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-karyawan.php';
// Membuat objek dari class Mahasiswa
$karyawan = new Karyawan();
// Mengambil data mahasiswa dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataKaryawan = [
    'id' => $_POST['id'],
    'no' => $_POST['no'],
    'nama' => $_POST['nama'],
    'divisi' => $_POST['divisi'],
    'alamat' => $_POST['alamat'],
    'jabatan' => $_POST['jabatan'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'status' => $_POST['status']
];
// Memanggil method editMahasiswa untuk mengupdate data mahasiswa dengan parameter array $dataMahasiswa
$edit = $karyawan->editKaryawan($dataKaryawan);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id mahasiswa
    header("Location: ../data-edit.php?id=".$dataKaryawan['id']."&status=failed");
}

?>