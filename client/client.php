<?php 
    error_reporting(1); // error ditampilkan

    class Client {
        private $url;

        public function __construct($url) {
            $this->url = $url;
            unset($url);
        }

        public function filter($data) {
            $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
            return $data;
            unset($data);
        }

        public function login($data) {
            $data = '{
                "email": "' . $data['email'] . '",
                "pass": "' . $data['pass'] . '",
                "aksi": "' . $data['aksi'] . '"
            }';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            curl_close($curl);
            $data2 = json_decode($response);
            return $data2;
            unset($curl, $response, $data, $data2);
        }

        public function tampil_semua_berita($jwt) {
            $client = curl_init($this->url . '?jwt=' . $jwt);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($client);
            curl_close($client);
            $data = json_decode($response);

            return $data;
            unset($data, $client, $response);
        }

        public function tampil_berita($data) {
            $news_id = $this->filter($data['news_id']);
            $client = curl_init($this->url . '?aksi=tampil&news_id=' . $data['news_id'] . '&jwt=' . $data['jwt']);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($client);
            curl_close($client);
            $data = json_decode($response);

            return $data;
            unset($data, $client, $response, $news_id);
        }

        public function tambah_berita($data) {
            $data = '
                {
                    "news_id": "' . $data['news_id'] . '",
                    "author_id": "' . $data['author_id'] . '",
                    "category": "' . $data['category'] . '",
                    "title": "' . $data['title'] . '",
                    "content": "' . $data['content'] . '",
                    "photo": "' . $data['photo'] . '",
                    "created_at": "' . $data['created_at'] . '",
                    "jwt": "' . $data['jwt'] . '",
                    "aksi": "' . $data['aksi'] . '"
                }
            ';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            curl_close($curl);
            unset($data, $curl, $response);
        }

        public function ubah_berita($data){
            $data = '{
                    "news_id": "' . $data['news_id'] . '",
                    "author_id": "' . $data['author_id'] . '",
                    "category": "' . $data['category'] . '",
                    "title": "' . $data['title'] . '",
                    "content": "' . $data['content'] . '",
                    "photo": "' . $data['photo'] . '",
                    "created_at": "' . $data['created_at'] . '",
                    "jwt": "' . $data['jwt'] . '",
                    "aksi": "' . $data['aksi'] . '"
                }';
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL,$this->url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($c, CURLOPT_POST,true);
            curl_setopt($c, CURLOPT_POSTFIELDS,$data);
            $response = curl_exec($c);
            curl_close($c);
            unset($c, $response, $data);
        }

        public function hapus_berita($data){
            $news_id = $this->filter($data['news_id']);
            $data = '{
                        "news_id":"'.$data['news_id'].'",
                        "jwt":"'.$data['jwt'].'",
                        "aksi":"'.$data['aksi'].'"
                    }';
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL,$this->url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($c, CURLOPT_POST,true);
            curl_setopt($c, CURLOPT_POSTFIELDS,$data);
            $response = curl_exec($c);
            curl_close($c);
            unset($news_id, $c, $response, $data);
        }

        // function upload() {
        //     $fileName = $_FILES['photo']['name'];
        //     $fileSize = $_FILES['photo']['size'];
        //     $error = $_FILES['photo']['error'];
        //     $tmpName = $_FILES['photo']['tmp_name'];
    
        //     if ($error === 4) {
        //         echo "
        //             <script>
        //                 alert('Pilih gambar terlebih dahulu!');
        //             </script>
        //         ";
        //         return false;
        //     }
    
        //     $validasi = ['jpg', 'jpeg', 'png'];
        //     $ekstensiGambar = pathinfo($fileName, PATHINFO_EXTENSION);
    
        //     if (!in_array($ekstensiGambar, $validasi)) {
        //         echo "
        //             <script>
        //                 alert('Yang anda upload bukan gambar!');
        //             </script>
        //         ";
        //     }
    
        //     if ($fileSize > (10 * 1024 *1024)) {
        //         echo "
        //             <script>
        //                 alert('Ukuran gambar terlalu besar!');
        //             </script>
        //         ";
        //     }
    
        //     $fileNewName = uniqid();
        //     $fileNewName .= '.';
        //     $fileNewName .= $ekstensiGambar;
    
        //     $target = "D:/Coding/src/laragon/www/portal-berita/client/assets/" . $fileNewName;
        //     move_uploaded_file($tmpName, $target);
    
        //     return $fileNewName;
        // }

        public function __destruct() {
            unset($this->url);
        }
    }

    $url = 'http://192.168.56.4/portal-berita/server/server.php';
    $abc = new Client($url);
?>