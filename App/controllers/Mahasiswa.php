<?php 

class Mahasiswa extends Controller
{
    public function getAllMahasiswa()
    {
        $data = $this->model('Mahasiswa_model')->getPaginateMahsiswa($_POST);
        echo json_encode($data);
    }

    public function getPaginateMahasiswa()
    {
        $jumlahDataPerHalaman = $_POST['dataPerhalaman'];
        $jumlahData = count($this->model('Mahasiswa_model')->getAllMahsiswa());;
        $data['halamanAktif'] = ( isset($_POST['halaman']) ) ? $_POST['halaman'] : 1;
        $data['jumlahHalaman'] = ceil($jumlahData/$jumlahDataPerHalaman);

        echo json_encode($data);
    }

    public function getDetailMahasiswa()
    {  
        $id = $_POST['id'];
        // tampilkan dan kita rubah datanya menjadi json
        echo json_encode( $this->model('Mahasiswa_model')->getMahasiswaById($id) );
    }

    public function tambahDataMahasiswa()
    {
        if($_POST['nama'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data Nama';}
        else if($_POST['nrp'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data NRP';}
        else if($_POST['email'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data Email';}
        else if($_POST['jurusan'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data Jurusan';}
        else{
            if ( $this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0 ){
                $result['status'] = 1;
                $result['message'] = 'Data Berhasil Ditambahkan';
            }else{
                $result['status'] = 0;
                $result['message'] = 'Data Gagal Ditambahkan';
            }
        }
        echo json_encode($result);
    }

    public function editMahasiswa()
    {
        if($_POST['nama'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data Nama';}
        else if($_POST['nrp'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data NRP';}
        else if($_POST['email'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data Email';}
        else if($_POST['jurusan'] == NULL){$result['message'] = 'Data Gagal Ditambahkan! Harap Di isi Data Jurusan';}
        else{
            if ( $this->model('Mahasiswa_model')->editDataMahasiswa($_POST) > 0 ){
                $result['status'] = 1;
                $result['message'] = 'Data Berhasil Di Ubah';
            }else{
                $result['status'] = 0;
                $result['message'] = 'Data Gagal Di Ubah';
            }
        }
        echo json_encode($result);
    }

    public function deleteDataMahasiswa()
    {
        $id = $_POST['id'];
        if ( $this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0 ){
            $result['status'] = 1;
            $result['message'] = 'Data Berhasil Di Hapus!';
        }else{
            $result['status'] = 0;
            $result['message'] = 'Data Gagal Di Hapus!';
        }
        echo json_encode($result);
    }

    public function searchData()
    {
        $query = $this->model('Mahasiswa_model')->searchDataMahsiswa($_POST);
        if( isset($query[0]) ){
            echo json_encode($query);
        }else{
            $result['return'] = 0;
            $result['message'] = 'Data Mahasiswa Not Found!';
            echo json_encode($result);
        }
    }
}