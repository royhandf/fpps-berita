<?php
error_reporting(1);
	include "client.php";
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard Berita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php if ($_COOKIE['jwt']) { ?>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="?page=home" class="nav-link active"> Home</a></li>
                    <li class="nav-item"><a href="?page=tambah" class="nav-link "> Tambah Data</a></li>
                    <li class="nav-item"><a href="?page=data-server" class="nav-link ">Data Server</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link "><?='<strong>'.$_COOKIE['author_name'].' ('.$_COOKIE['author_id'].')</strong>';?></a>
                    </li>
                    <li class="nav-item">
                        <a href="proses.php?aksi=logout" class="nav-link " onclick="return confirm('Apakah Anda ingin Logout?')">Logout</a>
                    </li>
                </ul>
                <?php } else { ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="?page=home" class="nav-link ">Home</a></li>
                    <li class="nav-item"><a href="?page=login" class="nav-link ">Login</a></li>
                </ul>
                <?php } ?>

            </div>
        </div>
    </nav>

    <div class="container">
        <fieldset>
            <?php if ($_GET['page']=='login' and !isset($_COOKIE['jwt'])) { ?>
            <legend>Login</legend>
            <div class="container-fluid bg-light">
                <form class="form-horizontal" name="form1" method="POST" action="proses.php" novalidate>
                    <input type="hidden" name="aksi" value="login" />
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email" rel="tooltip" data-placement="right"
                            title="Masukkan Email" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="pass">Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Password" rel="tooltip" data-placement="right"
                            title="Masukkan Password" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <?php } elseif ($_GET['page']=='tambah' and isset($_COOKIE['jwt'])) { ?>
            <legend>Tambah Data</legend>
            <div class="container-fluid ">
                <form class="form-horizontal" name="form1" method="POST" action="proses.php" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="aksi" value="tambah" />
                    <input type="hidden" name="jwt" value="<?=$_COOKIE['jwt']?>" />
                    <div class="mb-3">
                        <label class="form-label" for="news_id">News ID</label>
                        <input type="text" name="news_id" class="form-control" placeholder="News ID" rel="tooltip" data-placement="right"
                            title="Masukkan News ID" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="author_id">Author ID</label>
                        <input type="text" name="author_id" class="form-control" placeholder="Author ID" rel="tooltip" data-placement="right"
                            title="Masukkan Author ID" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="category">Category</label>
                        <input type="text" name="category" class="form-control" placeholder="Category" rel="tooltip" data-placement="right"
                            title="Masukkan Category" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" rel="tooltip" data-placement="right"
                            title="Masukkan Title   " required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content">Content</label>
                        <input type="text" name="content" class="form-control" placeholder="Content" rel="tooltip" data-placement="right"
                            title="Masukkan Content" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="photo">Photo</label>
                        <input type="file" name="photo" class="form-control" placeholder="Photo" rel="tooltip" data-placement="right"
                            title="Masukkan Photo" required data-validation-required-message="Harus diisi">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <?php } elseif ($_GET['page']=='ubah' and isset($_COOKIE['jwt'])) {	
                $data = array(
                    "jwt"=>$_COOKIE['jwt'], 
                    "news_id"=>$_GET['news_id']);	
                $r = $abc->tampil_berita($data);
            ?>
            <legend>Ubah Data</legend>
            <form name="form1" method="post" action="proses.php" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="ubah" />
                <input type="hidden" name="news_id" value="<?=$r->news_id?>" />
                <input type="hidden" name="jwt" value="<?=$_COOKIE['jwt']?>" />
                <label class="form-label" for="news_id">News ID</label>
                <input type="text" disabled class="form-control" placeholder="News ID" name="news_id" value="<?=$r->news_id?>">
                <label class="form-label" for="author_id">Author ID</label>
                <input type="text" name="author_id" class="form-control" placeholder="Author ID" value="<?=$r->author_id?>">
                <label class="form-label" for="category">Category</label>
                <input type="text" name="category" class="form-control" placeholder="Category" value="<?=$r->category?>">
                <label class="form-label" for="title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" value="<?=$r->title?>">
                <label class="form-label" for="content">Content</label>
                <input type="text" name="content" class="form-control" placeholder="Content" value="<?=$r->content?>">
                <label class="form-label" for="photo">Photo</label>
                <input type="file" name="photo" class="form-control" placeholder="Photo" value="<?=$r->photo?>">

                <button type="submit" name="ubah" class="btn btn-primary"> Ubah</button>
            </form>

            <?php  // menghapus variabel dari memory
                unset($data,$r,$abc);	
                } else if ($_GET['page']=='data-server' and isset($_COOKIE['jwt'])) {
            ?>
            <legend>Daftar Data Berita</legend>
            </form>

            <table class="table table-hover">
                <tr>
                    <th width='10%'>No</th>
                    <th width='10%'>Author ID</th>
                    <th width='20%'>Category</th>
                    <th width='30%'>Title</th>
                    <th width='10%'>Content</th>
                    <th width='10%'>Photo</th>
                    <th width='5%'>Ubah</th>
                    <th width='5%'>Hapus</th>
                </tr>
                <?php
                    $no = 1;
                    $data = $abc->tampil_semua_berita($_COOKIE['jwt']);
                    foreach ($data as $r) {
                ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$r->author_id?></td>
                    <td><?=$r->category?></td>
                    <td><?=$r->title?></td>
                    <td><?=$r->content?></td>
                    <td><?=$r->photo?></td>
                    <td><a href="?page=ubah&news_id=<?=$r->news_id?>&jwt=<?=$_COOKIE['jwt']?>" role="button" class="btn btn-success">Ubah</a></td>
                    <td>
                        <a href="proses.php?aksi=hapus&news_id=<?=$r->news_id?>&jwt=<?=$_COOKIE['jwt']?>" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php 
                    $no++;
                    }	
                    // menghapus variabel dari memory
                    unset($data,$r,$no,$abc);
                ?>
            </table>
            <?php } else { ?>
            <legend>Home</legend>
            Selamat Datang
        </fieldset>
    </div>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>