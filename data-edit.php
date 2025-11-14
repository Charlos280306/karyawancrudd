<?php 

include_once 'config/class-master.php';
include_once 'config/class-karyawan.php';
$master = new MasterData();
$karyawan = new Karyawan();
// Mengambil daftar program studi, provinsi, dan status mahasiswa
$divisiList = $master->getDivisi();
// Mengambil daftar provinsi
$jabatanList = $master->getJabatan();
// Mengambil daftar status mahasiswa
$statusList = $master->getStatus();
// Mengambil data mahasiswa yang akan diedit berdasarkan id dari parameter GET
$dataKaryawan = $karyawan->getUpdateKaryawan($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data mahasiswa. Silakan coba lagi.');</script>";
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
								<h3 class="mb-0">Edit Karyawan</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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
										<h3 class="card-title">Formulir Karyawan</h3>
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
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataKaryawan['id']; ?>">
                                            <div class="mb-3">
                                                <label for="no" class="form-label">Nomor  Karyawan </label>
                                                <input type="number" class="form-control" id="no" name="no" placeholder="Masukkan NO Karyawan" value="<?php echo $dataKaryawan['no']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Karyawan" value="<?php echo $dataKaryawan['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="divisi" class="form-label">Divisi Karyawan</label>
                                                <select class="form-select" id="divisi" name="divisi" required>
                                                    <option value="" selected disabled>Pilih Divisi</option>
                                                    <?php 
                                                    // Iterasi daftar program studi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($divisiList as $divisi){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedDivisi = "";
                                                        // Mengecek apakah program studi saat ini sesuai dengan data mahasiswa
                                                        if($dataKaryawan['divisi'] == $divisi['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedDivisi = "selected";
                                                        }
                                                        // Menampilkan opsi program studi dengan penanda yang sesuai
                                                        echo '<option value="'.$divisi['id'].'" '.$selectedDivisi.'>'.$divisi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Sesuai KTP" required><?php echo $dataKaryawan['alamat']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jabatan" class="form-label">Jabatan</label>
                                                <select class="form-select" id="jabatan" name="jabatan" required>
                                                    <option value="" selected disabled>Pilih Jabatan</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($jabatanList as $jabatan){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedJabatan = "";
                                                        // Mengecek apakah provinsi saat ini sesuai dengan data mahasiswa
                                                        if($dataKaryawan['jabatan'] == $jabatan['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedJabatan = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$jabatan['id'].'" '.$selectedJabatan.'>'.$jabatan['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid dan Benar" value="<?php echo $dataKaryawan['email']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telp" class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telpon/HP" value="<?php echo $dataKaryawan['telp']; ?>" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status mahasiswa dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data mahasiswa
                                                        if($dataKaryawan['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
                                        </div>
                                    </form>
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