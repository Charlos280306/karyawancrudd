<?php
include_once 'config/class-master.php';
$master = new MasterData();

// Ambil semua data jabatan
$dataJabatan = $master->getJabatan();

// Alert berdasarkan status GET
if(isset($_GET['status'])){
    if($_GET['status'] == 'inputsuccess'){
        echo "<script>alert('Data jabatan berhasil ditambahkan.');</script>";
    } else if($_GET['status'] == 'editsuccess'){
        echo "<script>alert('Data jabatan berhasil diubah.');</script>";
    } else if($_GET['status'] == 'deletesuccess'){
        echo "<script>alert('Data jabatan berhasil dihapus.');</script>";
    } else if($_GET['status'] == 'deletefailed'){
        echo "<script>alert('Gagal menghapus data jabatan. Silakan coba lagi.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>
<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">

    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php'; ?>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Master Jabatan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Master Jabatan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Jabatan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID Jabatan</th>
                                            <th>Nama Jabatan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(count($dataJabatan) == 0){
                                            echo '<tr class="align-middle">
                                                    <td colspan="4" class="text-center">Tidak ada data jabatan.</td>
                                                  </tr>';
                                        } else {
                                            foreach($dataJabatan as $index => $jabatan){
                                                echo '<tr class="align-middle">
                                                        <td>'.($index+1).'</td>
                                                        <td>'.$jabatan['nama'].'</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-warning me-1" 
                                                                onclick="window.location.href=\'master-jabatan-edit.php?id='.$jabatan['id'].'\'">
                                                                <i class="bi bi-pencil-fill"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger" 
                                                                onclick="if(confirm(\'Yakin ingin menghapus jabatan ini?\')){window.location.href=\'proses/proses-jabatan.php?aksi=delete&id='.$jabatan['id'].'\'}">
                                                                <i class="bi bi-trash-fill"></i> Hapus
                                                            </button>
                                                        </td>
                                                      </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" onclick="window.location.href='master-jabatan-input.php'">
                                    <i class="bi bi-plus-lg"></i> Tambah Jabatan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include 'template/footer.php'; ?>
</div>

<?php include 'template/script.php'; ?>

</body>
</html>
