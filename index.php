<?php
    //koneksi
    $server   = "localhost";
    $user     = "root";
    $pass     = "";
    $database = "db_formulir";

    $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error());

    
    //if button click
    if(isset($_POST['bsimpan']))
    {
        //pengujian
        if($_GET['hal'] == "edit")
        {
            //data akan di edit
            $edit = mysqli_query($koneksi, "UPDATE buku SET
                                                nis     = '$_POST[tNIS]',       
                                                nama_siswa = '$_POST[tnama]',       
                                                jenis_kelamin = '$_POST[tjeniskelamin]',       
                                                alamat = '$_POST[talamat]',       
                                                id_jurusan = '$_POST[tidjurusan]',       
                                                nama_jurusan = '$_POST[tnamajurusan]'
                                              WHERE id_siswa = '$_GET[id]'       
                                            ");
            if($edit)
            {
                echo "<script>
                    alert('edit data berhasil!');
                    document.location= 'index.php';
                </script>";                
            }
            else
            {
                echo "<script>
                    alert('edit data gagal!');
                    document.location= 'index.php';
                </script>";
            }
        }            
        else
        {
            //data akan di simpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO buku (nis, nama_siswa, jenis_kelamin, alamat, id_jurusan, nama_jurusan)
                                              VALUES ('$_POST[tNIS]', 
                                                      '$_POST[tnama]', 
                                                      '$_POST[tjeniskelamin]', 
                                                      '$_POST[talamat]', 
                                                      '$_POST[tidjurusan]', 
                                                      '$_POST[tnamajurusan]')       
                                            ");
            if($simpan){
                echo "<script>
                alert('simpan data berhasil!');
                document.location= 'index.php';
                </script>";                
            }else{
                echo "<script>
                alert('simpan data gagal!');
                document.location= 'index.php';
                </script>";
            }
        }      
    }    
   

    //pengujian jika tombol edit/hapus di klik
    if(isset($_GET['hal']))
    {
        //keterangan tampil data yang akan di edit
        if($_GET['hal'] == 'edit')
        {
            //tampil data yang akan di edit
            $tampil = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_siswa = '$_GET[id]'");
            $data = mysqli_fetch_array($tampil);            
            if($data)
            {
                //jika data ditemukan
                $vNIS  = $data['nis'];
                $vnama = $data['nama_siswa'];
                $vjeniskelamin = $data['jenis_kelamin'];
                $valamat = $data['alamat'];
                $vidjurusan = $data['id_jurusan'];
                $vJurusan = $data['nama_jurusan'];
            }
        }
        else if ($_GET['hal'] == "hapus")
        {
            //persiapan hapus data
            $hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id_siswa = '$_GET[id]' ");
            if($hapus){
                echo "<script>
                        alert('hapus data berhasil!');
                        document.location= 'index.php';
                    </script>";
            }
        }
    }
   
   
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .text-center{
            margin-top:20px;
        }
    </style>

</head>
<body>
<div class="container">
    <h3 class="text-center">Formulir</h3>
    <h3 class="text-center">Data Diri Siswa</h3>

    <h5>Cari Data Siswa</h5>
    
    <form action="index.php" method="get">
        <label>Cari Siswa:</label>
        <input type="text" name="cari">
        <input type="submit" value="cari">       
    </form>


    <!--Awal Card 1-->
    <div class="card mt-3">
        <div class="card-header">
            <h5>Masukan Data Diri Anda</h5>
        </div>
        <div class="card-body ">
            <form method="POST" action="">                
                <div class="form-group mt-3">
                    <label>NIS</label>
                    <input type="text" name="tNIS" value="<?=@$vNIS?>" class="form-control" placeholder="Masukan NIS Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Nama</label>
                    <input type="text" name="tnama" value="<?=@$vnama?>"class="form-control" placeholder="Masukan Nama Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="tjeniskelamin" value="<?=@$vjeniskelamin?>" class="form-control" placeholder="Masukan Jenis Kelamin Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Alamat</label>
                    <textarea class="form-control" name="talamat" placeholder="Masukan Alamat Anda"><?=@$valamat?></textarea>
                </div>
                <div class="form-group mt-3">
                    <label>ID Jurusan</label>
                    <input type="text" name="tidjurusan" value="<?=@$vidjurusan?>" class="form-control" placeholder="Masukan ID Jurusan Anda" required>
                </div>
                <div class="form-group mt-3">
                    <label>Nama Jurusan</label>
                    <select class= "form-control" name="tjurusan" >
                        <option value="<?=@$vJurusan?>">--Pilih Jurasan--</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan</option>
                        <option value="Teknik jaringan Akses">Teknik jaringan Akses</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-3" name="bsimpan">Simpan</button>
                
            </form>
        </div>
    </div>
    <!--Akhir Card 1-->
    

     <!--Awal Card 2-->
     <div class="card mt-3 mb-5">
        <div class="card-header text-purple">
            <h5>Daftar Data Diri SMK Telkom Purwokerto</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>No.</th>                    
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>ID Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    $no= 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM buku");

                    if(isset($_GET['cari'])){
                        $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE nama_siswa LIKE '%".
                            $_GET['cari']."%'");

                    }

                    while ($dt = mysqli_fetch_assoc($query)){
                    ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dt['nis']; ?></td>
                        <td><?= $dt['nama_siswa']; ?></td>
                        <td><?= $dt['jenis_kelamin']; ?></td>
                        <td><?= $dt['alamat']; ?></td>
                        <td><?= $dt['id_jurusan']; ?></td>
                        <td><?= $dt['nama_jurusan']; ?></td>
                        <td>
                            <a href="index.php?hal=edit&id=<?=$dt['id_siswa']?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?hal=hapus&id=<?=$dt['id_siswa']?>" onclick="return confirm('apakah anda ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                        </td>
                        
                    </tr>

                    <?php
                    }
                    ?>
                </tbody>              
               

               
        
            </table>
        </div>
    </div>
    <!--Akhir Card 2-->



</div> 


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>