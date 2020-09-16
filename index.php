<?php
  $server = "localhost";
  $user = "root";
  $pass = "";
  $database = "dblatihan";

  $koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

  if(isset($_POST['bsimpan']))
  {

    if($_GET['hal'] == "edit")
    {
        $edit = mysqli_query($koneksi, "UPDATE tmhs set
                                        nim = '$_POST[tnim]',
                                        nama = '$_POST[tnama]',
                                        alamat = '$_POST[talamat]',
                                        prodi = '$_POST[tprodi]'
                                        WHERE id_mhs = '$_GET[id]'
                                       ");
    if($edit)
    {
        echo "<script>
        alert('edit data sukses');
        document.location='index.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('edit data gagal');
        document.location='index.php';
        </script>";
    }
    }
    else
    {
        $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim,nama,alamat,prodi)
        VALUES ('$_POST[tnim]', '$_POST[tnama]','$_POST[talamat]','$_POST[tprodi]')
        ");
    if($simpan)
    {
        echo "<script>
        alert('simpan data sukses');
        document.location='index.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('simpan data gagal');
        document.location='index.php';
        </script>";
    }
    }
     
  }

  if(isset($_GET['hal']))
  {
      if($_GET['hal'] == "edit")
      {
          $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
          $data = mysqli_fetch_array($tampil);
          if($data)
          {
              $vnim = $data['nim'];
              $vnama = $data['nama'];
              $valamat = $data['alamat'];
              $vprodi = $data['prodi'];
          }
      }
      else if ($_GET['hal'] == "hapus")
      {
          $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
          if($hapus){
            echo "<script>
            alert('hapus data sukses');
            document.location='index.php';
            </script>";
          }
      }
  }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <h1 class=text-center>CRUD Tugas Pak Hari</h1>
    <h2 class=text-center>@dimasalvrzl</h2>
    
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
       Form Input Data Mahasiswa
    </div>
    <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <label>nim</label>
            <input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="input nim anda disini" reqired>
          </div>
          <div class="form-group">
            <label>nama</label>
            <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="input nama anda disini" reqired>
          </div>
          <div class="form-group">
            <label>alamat</label>
            <textarea class="form-control" name="talamat" placeholder="input alamat anda disini"><?=@$vnim?></textarea>
          <div class="form-group">
            <label>program studi</label>
           <select class="form-control" name="tprodi">
           <option value="<?=@$vprodi?>"><?=@$vprodi?></option>>
              <option value="D3-MI">D3-MI</option>
              <option value="S1-SI">S1-SI</option>
              <option value="S1-TI">S1-TI</option>
           </select>
           </div>

            <button type="submit" class="btn-success" name="bsimpan">simpan</button>
            <button type="reset" class="btn-danger" name="breset">kosongkan</button>

        </form>
    </div>
    </div>

    <div class="card mt-3">
    <div class="card-header bg-success text-white">
       Daftar Mahasiswa
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
          <tr>
            <th>no.</th>
            <th>nim</th>
            <th>nama</th>
            <th>alamat</th>
            <th>ptogram studi</th>
            <th>aksi</th>
          </tr>
            <?php
                $no =1;
                $tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
                while($data = mysqli_fetch_array($tampil)) :
            ?>
          <tr>
            <td><?=$no++;?></td>
            <td><?=$data['nim']?></td>
            <td><?=$data['nama']?></td>
            <td><?=$data['alamat']?></td>
            <td><?=$data['prodi']?></td>
            <td>
              <a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning">edit</a>
              <a href="index.php?hal=hapus&id=<?=$data['id_mhs']?>" 
                 onclick="return confirm('apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger">hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </table>
    </div>
    </div>
    
</div>


<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>