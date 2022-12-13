<?php 
    error_reporting(1);
    
    include_once 'core.php';
    include_once 'lib/php-jwt/src/BeforeValidException.php';
    include_once 'lib/php-jwt/src/ExpiredException.php';
    include_once 'lib/php-jwt/src/SignatureInvalidException.php';
    include_once 'lib/php-jwt/src/JWT.php';
    use \Firebase\JWT\JWT;
    
    include_once 'Database.php';
    $abc = new Database();
    
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 3600');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        }
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
        exit(0);
    }

    $postdata = file_get_contents("php://input");
    $data = json_decode($postdata);

    function filter($data) {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($data->email) and isset($data->pass)) {
        $data2['email'] = $data->email;
        $data2['pass'] = $data->pass;

        $data3 = $abc->login($data2);

        if ($data3) {
            $token = array(
                'iat' => $issued_at, 
                'exp' => $expiration_time,
                'iss' => $issuer,
                'data' => array(
                    "email" => $data3['email'],
                    "pass" => $data3['pass']
                )
            );

            http_response_code(200);

            $jwt = JWT::encode($token, $key);
            echo json_encode(
                array(
                    "message" => "Login sukses",
                    "author_id" => $data3['author_id'],
                    "author_name" => $data3['author_name'],
                    "email" => $data3['email'],
                    "phone" => $data3['phone'],
                    "jwt" => $jwt
                )
            );
        } else {
            http_response_code(401);
            echo json_encode(
                array("message" => "Login gagal")
            );
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $jwt = $data->jwt;
        $aksi = $data->aksi;
        $news_id = $data->news_id;
        $author_id = $data->author_id;
        $category = $data->category;
        $title = $data->title;
        $content = $data->content;
        $photo = $data->photo;
        $created_at = $data->created_at;
        
        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            if ($aksi == "tambah") {
                $data2 = array(
                    'aksi' => $aksi,
                    'news_id' => $news_id,
                    'author_id' => $author_id,
                    'category' => $category,
                    'title' => $title,
                    'content' => $content,
                    'photo' => $photo,
                    'created_at' => $created_at
                );
                $abc->tambah_berita($data2);
            } elseif ($aksi == "ubah") {
                $data2 = array(
                    'aksi' => $aksi,
                    'news_id' => $news_id,
                    'author_id' => $author_id,
                    'category' => $category,
                    'title' => $title,
                    'content' => $content,
                    'photo' => $photo,
                    'created_at' => $created_at
                );
                $abc->ubah_berita($data2);
            } elseif ($aksi == "hapus") {
                $data2 = array(
                    'aksi' => $aksi,
                    'news_id' => $news_id
                );
                $abc->hapus_berita($news_id);
            }

            http_response_code(200);
            echo json_encode($data2);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(array(
                "message" => "Access Ditolak",
            ));
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
        $jwt = $_GET['jwt'];

        try {
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            if (($_GET['aksi'] == 'tampil') and (isset($_GET['news_id']))) {
                $news_id = filter($_GET['news_id']);
                $data = $abc->tampil_berita($news_id);
            }else {
                $data = $abc->tampil_semua_berita();
            }

            http_response_code(200);
            echo json_encode($data);
        }catch (Exception $e) {
            http_response_code(401);
            echo json_encode(array(
                "message" => "Access Ditolak"
            ));
        }
    } else {
        http_response_code(401);
        echo json_encode(array(
            "message" => "Access Ditolak"
        ));
    }
    unset($abc, $postdata, $data, $data2, $data3, $token, $key, $issued_at, $expiration_time, $issuer, $jwt, $decoded, $news_id, $author_id, $category, $title, $content, $photo, $created_at, $aksi, $e);
?>