<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Karyawan extends Database {

    // Method untuk input data karyawan
    public function inputKaryawan($data){
        $no       = $data['no'];
        $nama     = $data['nama'];
        $divisi   = $data['divisi'];
        $alamat   = $data['alamat'];
        $jabatan  = $data['jabatan'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];

        $query = "INSERT INTO tb_karyawan 
                  (no_krywn, nama_krywn, divisi_krywn, alamat, jabatan, email, telp, status_krywn) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ssssssss", $no, $nama, $divisi, $alamat, $jabatan, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mengambil semua data karyawan
    public function getAllKaryawan(){
        $query = "SELECT k.id_krywn, k.no_krywn, k.nama_krywn, d.nama_divisi, j.nama_jabatan, 
                         k.alamat, k.email, k.telp, k.status_krywn
                  FROM tb_karyawan k
                  LEFT JOIN tb_divisi d ON k.divisi_krywn = d.kode_divisi
                  LEFT JOIN tb_jabatan j ON k.jabatan = j.id_jabatan
                  ORDER BY k.id_krywn ASC";

        $result = $this->conn->query($query);
        $karyawan = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $karyawan[] = [
                    'id'      => $row['id_krywn'],
                    'no'      => $row['no_krywn'],
                    'nama'    => $row['nama_krywn'],
                    'divisi'  => $row['nama_divisi'],
                    'jabatan' => $row['nama_jabatan'],
                    'alamat'  => $row['alamat'],
                    'email'   => $row['email'],
                    'telp'    => $row['telp'],
                    'status'  => $row['status_krywn']
                ];
            }
        }
        return $karyawan;
    }

    // Method untuk mengambil data karyawan berdasarkan ID
    public function getUpdateKaryawan($id){
        $query = "SELECT k.id_krywn, k.no_krywn, k.nama_krywn, k.divisi_krywn, k.jabatan, 
                         k.alamat, k.email, k.telp, k.status_krywn
                  FROM tb_karyawan k
                  WHERE k.id_krywn = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data = [
                'id'      => $row['id_krywn'],
                'no'      => $row['no_krywn'],
                'nama'    => $row['nama_krywn'],
                'divisi'  => $row['divisi_krywn'],
                'jabatan' => $row['jabatan'],
                'alamat'  => $row['alamat'],
                'email'   => $row['email'],
                'telp'    => $row['telp'],
                'status'  => $row['status_krywn']
            ];
        }
        $stmt->close();
        return $data;
    }

    // Method untuk mengedit data karyawan
    public function editKaryawan($data){
        $id       = $data['id'];
        $no       = $data['no'];
        $nama     = $data['nama'];
        $divisi   = $data['divisi'];
        $alamat   = $data['alamat'];
        $jabatan  = $data['jabatan'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];

        $query = "UPDATE tb_karyawan SET 
                    no_krywn = ?, nama_krywn = ?, divisi_krywn = ?, alamat = ?, 
                    jabatan = ?, email = ?, telp = ?, status_krywn = ?
                  WHERE id_krywn = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ssssssssi", $no, $nama, $divisi, $alamat, $jabatan, $email, $telp, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data karyawan
    public function deleteKaryawan($id){
        $query = "DELETE FROM tb_karyawan WHERE id_krywn = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mencari data karyawan berdasarkan kata kunci
    public function searchKaryawan($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT k.id_krywn, k.no_krywn, k.nama_krywn, d.nama_divisi, j.nama_jabatan, 
                         k.alamat, k.email, k.telp, k.status_krywn
                  FROM tb_karyawan k
                  LEFT JOIN tb_divisi d ON k.divisi_krywn = d.kode_divisi
                  LEFT JOIN tb_jabatan j ON k.jabatan = j.id_jabatan
                  WHERE k.no_krywn LIKE ? OR k.nama_krywn LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return [];
        }
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $karyawan = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $karyawan[] = [
                    'id'      => $row['id_krywn'],
                    'no'      => $row['no_krywn'],
                    'nama'    => $row['nama_krywn'],
                    'divisi'  => $row['nama_divisi'],
                    'jabatan' => $row['nama_jabatan'],
                    'alamat'  => $row['alamat'],
                    'email'   => $row['email'],
                    'telp'    => $row['telp'],
                    'status'  => $row['status_krywn']
                ];
            }
        }
        $stmt->close();
        return $karyawan;
    }

}
?>
