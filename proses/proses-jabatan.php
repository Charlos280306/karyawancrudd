<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputjabatan'){
    // Mengambil data provinsi dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataJabatan = [
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputProvinsi untuk memasukkan data provinsi dengan parameter array $dataProvinsi
    $input = $master->inputJabatan($dataJabatan);
    if($input){
        header("Location: ../master-jabatan-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-jabatan-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatejabatan'){
    // Mengambil data provinsi dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataJabatan = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateProvinsi untuk mengupdate data provinsi dengan parameter array $dataProvinsi
    $update = $master->updateJabatan($dataJabatan);
    if($update){
        header("Location: ../master-jabatan-list.php?status=editsuccess");
    } else {
        header("Location: ../master-jabatan-edit.php?id=".$dataJabatan['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletejabatan'){
    // Mengambil id provinsi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProvinsi untuk menghapus data provinsi berdasarkan id
    $delete = $master->deleteJabatan($id);
    if($delete){
        header("Location: ../master-jabatan-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-jabatan-list.php?status=deletefailed");
    }
}

?>