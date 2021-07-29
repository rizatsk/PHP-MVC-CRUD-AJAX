<?php 

class Mahasiswa_model
{
   private  $table = 'mahasiswa',
            $tb;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllMahsiswa()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
        // echo json_encode( $this->db->resultSet() );
    }
    public function getPaginateMahsiswa($data)
    {
        $jumlahDataPerHalaman = $data['dataPerhalaman'];
        $halamanAktif = ( isset($data['halaman']) ) ? $data['halaman'] : 1;
        $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

        $this->db->query("SELECT * FROM $this->table LIMIT $awalData,$jumlahDataPerHalaman");
        return $this->db->resultSet();
        // echo json_encode( $this->db->resultSet() );
    }

    public function getMahasiswaById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id=:id");
        // kalau memiliki parameter kita binding dulu
        $this->db->bind('id', $id);
        // hanya mengambil 1 data menggunakan function single yang didalam file Database.php
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO $this->table VALUES ('',:nama,:nrp,:email,:jurusan)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM $this->table WHERE id=:id";

        $this->db->query($query);
        $this->db->bind('id',$id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataMahasiswa($data)
    {
        $query = "UPDATE $this->table SET 
                nama = :nama,
                nrp = :nrp,
                email = :email,
                jurusan = :jurusan
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function searchDataMahsiswa()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM $this->table WHERE 
                nama LIKE :keyword ||
                nrp LIKE :keyword ";

        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}