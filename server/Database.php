<?php
    error_reporting(1);
    class Database{
        private $host ="localhost";
        private $dbname ="portal_berita";
        private $user ="root";
        private $password ="";
        private $port ="3306";
        private $conn;

        public function __construct()
        { //koneksi database
            try { 
                $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8",$this->user,$this->password);
      
            } catch (PDOException $e) {    
                echo "Koneksi Gagal";
            }  
        }

        public function login($data){
            $query = $this->conn->prepare("SELECT author_id, author_name, email, pass, phone FROM author WHERE email=? AND pass=MD5(?)");
            $query->execute(array($data['email'], $data['pass']));
            $data = $query->fetch(PDO::FETCH_ASSOC);
            return $data;
            $query->closeCursor();
            unset($data);
        }

        public function tampil_semua_berita() {
            $query = $this->conn->prepare("SELECT news_id, author_id, category, title, content, photo, created_at FROM news ORDER BY news_id");
            $query->execute();

            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            return $data;

            $query->closeCursor();
            unset($data);
        }
        
        public function tampil_berita($news_id) {
            $query = $this->conn->prepare("SELECT news_id, author_id, category, title, content, photo, created_at FROM news WHERE news_id=?");
            $query->execute(array($news_id));

            $data = $query->fetch(PDO::FETCH_ASSOC);

            return $data;

            $query->closeCursor();
            unset($news_id, $data);
        }

        public function tambah_berita($data) {
            $query = $this->conn->prepare("INSERT ignore INTO news VALUES (?,?,?,?,?,?,?)");
            $query->execute(array($data['news_id'],$data['author_id'],$data['category'],$data['title'], $data['content'], $data['photo'], $data['created_at']));

            $query->closeCursor();
            unset($data);
        }

        public function ubah_berita($data) {
            $query = $this->conn->prepare("UPDATE news SET author_id=?, category=?, title=?, content=?, photo=?, created_at=? WHERE news_id=?");
            $query->execute(array($data['author_id'],$data['category'],$data['title'], $data['content'], $data['photo'], $data['created_at'], $data['news_id']));

            $query->closeCursor();
            unset($data);
        }

        public function hapus_berita($news_id) {
            $query = $this->conn->prepare("DELETE FROM news WHERE news_id=?");
            $query->execute(array($news_id));

            $query->closeCursor();
            unset($news_id);
        }
    }
?>