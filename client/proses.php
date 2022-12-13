<?php 
    error_reporting(1); // error ditampilkan
    include "client.php";

    if($_POST['aksi'] == 'login') {
        $data = array(
            "aksi"=>$_POST['login'],
            "email"=>$_POST['email'],
            "pass"=>$_POST['pass']
        );
        
        $data2 = $abc->login($data);

        if ($data2) {
            setcookie('jwt',$data2->jwt, time() + 3600);
            setcookie('author_id',$data2->author_id, time() + 3600);
            setcookie('author_name',$data2->author_name, time() + 3600);
            header('location:index.php?page=daftar-data');
        } else{
            header('location:index.php?page=login');
        }
    } else if ($_POST['aksi'] == 'tambah') {
        // $photo = upload();

        // if (!$photo) {
        //     return false;
        // }
        
        $data = array(
            "aksi" => $_POST['aksi'],
            "jwt"=>$_POST['jwt'],
            "news_id" => $_POST['news_id'],
            "author_id" => $_POST['author_id'],
            "category" => $_POST['category'],
            "title" => $_POST['title'],
            "content" => $_POST['content'],
            "photo" => $_POST['photo'],
            "created_at" => $_POST['created_at'],
        );

        $abc->tambah_berita($data);
        header('location:index.php?page=daftar-data');
    } else if ($_POST['aksi'] == 'ubah') {
        $data = array(
            "aksi" => $_POST['aksi'],
            "jwt"=>$_POST['jwt'],
            "news_id" => $_POST['news_id'],
            "author_id" => $_POST['author_id'],
            "category" => $_POST['category'],
            "title" => $_POST['title'],
            "content" => $_POST['content'],
            "photo" => $_POST['photo'],
            "created_at" => $_POST['created_at'],
        );
        $abc->ubah_berita($data);
        header('location:index.php?page=daftar-data');
    } else if ($_GET['aksi'] == 'hapus') {
        $data = array(
            "aksi" => $_GET['aksi'],
            "jwt" => $_GET['jwt'],
            "news_id" => $_GET['news_id'],
        );
        $abc->hapus_berita($data);
        header('location:index.php?page=daftar-data');
    } elseif ($_GET['aksi'] == 'logout'){
        setcookie('jwt', '', time() - 3600);
        setcookie('author_id', '', time() - 3600);
        setcookie('author_name', '', time() - 3600);
        header('location:index.php?page=login');
    }

    unset($abc, $data, $data2);
?>