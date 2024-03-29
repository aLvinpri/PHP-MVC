<?php

// Ini ada di folder app / models / Mahasiswa_model.php

class Mahasiswa_model
{
    // ***************** Contoh koneksi menggunakan PDO sederhana ********************

    // private $dbh; //database handler
    // private $stmt;

    // public function __construct()
    // {
    //     // data source name
    //     $dsn = 'mysql:host=localhost:3307;dbname=phpmvc';

    //     try {
    //         $this->dbh = new PDO($dsn, 'root', '');
    //     } catch (PDOException $e) {
    //         die($e->getMessage());
    //     }

    // } 

    // public function getAllMahasiswa()
    // {
    //     $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
    //     $this->stmt->execute();
    //     return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // *************************** PDO Connection ************************************

    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO " . $this->table . "
                    VALUES
                ('', :nama, :nrp, :email, :jurusan)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->row_count();
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->row_count();
    }

    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE " . $this->table . " SET
                    nama = :nama,
                    nrp = :nrp,
                    email = :email,
                    jurusan = :jurusan
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nrp', $data['nrp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->row_count();
    }

    public function cariDataMahasiswa()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM " . $this->table . " WHERE nama LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }
}

        // Ini ada di folder app / models / Mahasiswa_model.php
