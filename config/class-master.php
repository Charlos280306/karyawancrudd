<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getDivisi(){
        $query = "SELECT * FROM tb_divisi";
        $result = $this->conn->query($query);
        $divisi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $divisi[] = [
                    'id' => $row['kode_divisi'],
                    'nama' => $row['nama_divisi']
                ];
            }
        }
        return $divisi;
    }
    

    // Method untuk mendapatkan daftar provinsi
    public function getJabatan(){
        $query = "SELECT * FROM tb_jabatan";
        $result = $this->conn->query($query);
        $jabatan = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jabatan[] = [
                    'id' => $row['id_jabatan'],
                    'nama' => $row['nama_jabatan']
                ];
            }
        }
        return $jabatan;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Aktif'],
            ['id' => 2, 'nama' => 'Tidak Aktif'],
            ['id' => 3, 'nama' => 'Cuti Kerja'],
            ['id' => 4, 'nama' => 'Berhenti Kerja']
        ];
    }

    // Method untuk input data program studi
    public function inputDivisi($data){
        $kodeDivisi = $data['kode'];
        $namaDivisi = $data['nama'];
        $query = "INSERT INTO tb_divisi (kode_divisi, nama_divisi) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeDivisi, $namaDivisi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdateDivisi($id){
        $query = "SELECT * FROM tb_divisi WHERE kode_divisi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $divisi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $divisi = [
                'id' => $row['kode_divisi'],
                'nama' => $row['nama_divisi']
            ];
        }
        $stmt->close();
        return $divisi;
    }

    // Method untuk mengedit data program studi
    public function updateDivisi($data){
        $kodeDivisi = $data['kode'];
        $namaDivisi = $data['nama'];
        $query = "UPDATE tb_divisi SET nama_divisi = ? WHERE kode_divisi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaDivisi, $kodeDivisi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deleteDivisi($id){
        $query = "DELETE FROM tb_divisi WHERE kode_divisi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputJabatan($data){
        $namaJabatan = $data['nama'];
        $query = "INSERT INTO tb_jabatan (nama_jabatan) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateJabatan($id){
        $query = "SELECT * FROM tb_jabatan WHERE id_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jabatan = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $jabatan = [
                'id' => $row['id_jabatan'],
                'nama' => $row['nama_jabatan']
            ];
        }
        $stmt->close();
        return $jabatan;
    }

    // Method untuk mengedit data provinsi
    public function updateJabatan($data){
        $idJabatan = $data['id'];
        $namaJabatan = $data['nama'];
        $query = "UPDATE tb_jabatan SET nama_jabatan = ? WHERE id_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaJabatan, $idJabatan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteJabatan($id){
        $query = "DELETE FROM tb_jabatan WHERE id_jabatan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>