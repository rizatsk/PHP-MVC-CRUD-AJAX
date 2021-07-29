<?php 

class Database 
{
    private $db_host = db_host,
            $db_username = db_username,
            $db_password = db_password,
            $db_name = db_name,
            $dbh, //database handler
            $stmt;

    public function __construct()
    {
        // data source name
        $dsn = "mysql:host=".$this->db_host.";dbname=".$this->db_name;

        $option = [
            PDO::ATTR_PERSISTENT => true, //menjaga agar tetap terkoneksi
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //untuk error modenya tampilkan exception
        ];
        // coba connect kan ke database
        try{
            $this->dbh = new PDO($dsn,$this->db_username,$this->db_password,$option);
        }
        // jika gagal connect masukan ke variable $e
        catch(PDOException $e){
            // hentikan program dan berikan pesan eror
            die($e->getMessage());
        }
    }

    // digunakan untuk mempersiapkan query jadi dia bisa select , insert ,update , delete. 
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // digunakan untuk binding seperti ada wherenya ada parameternya apa .
    // gunanya untuk menghindari mysql injection
    public function bind($param, $value , $type = null)
    {
        if( is_null($type) ){
            // supaya switchnya jalan aja 
            switch (true) {
                // jika valuenya integer maka type nya dijadikan integer.
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                // jika valuenya boolean maka type nya dijadikan boolean.
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;

                default : $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    // digunakan untuk mengambil banyak data
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // digunakan untuk hanya mengambil 1 data aja.
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}