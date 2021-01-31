<?php
    include('koneksi.php');

    if(isset($_GET['edit'])){
        $id = $_GET['id'];
    
        // Fetch user data based on id
        $result = mysqli_query($mysqli, "SELECT * FROM tb_distribusi WHERE IndexDistribusi=$id");
        
        while($data = mysqli_fetch_array($result))
        {
            $sekolah = $data['NamaSekolah'];
            $kelas = $data['Kelas'];
            $jumlah = $data['Jumlah'];
        }
    }

    if(isset($_GET['hapus'])){
        $id = $_GET['id'];
        $jumlah = $_GET['jumlah'];
        $kelas = $_GET['kelas'];

        $getstock = "SELECT * FROM tb_stock WHERE Kelas=$kelas";
        $result = $mysqli->query($getstock);

        while($row = $result->fetch_assoc()) {
            $jumlahbaru = $row["Jumlah"] + $jumlah;
            $persediaanbaru = $row["Harga"] * $jumlahbaru;

            $sql = "DELETE FROM tb_distribusi WHERE IndexDistribusi=$id";
            $sql2 = "UPDATE tb_stock SET Jumlah='$jumlahbaru', NilaiPersediaan='$persediaanbaru' WHERE Kelas=$kelas";

            if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) === TRUE) {
                echo "<script>alert('Record deleted successfully')</script>";
            } else {
                echo "<script>alert(''Error deleting record: ' . $mysqli->error')</script>";
            }
        }
        echo '<script>window.location = "distribusi.php"</script>';
    }

 	if (isset($_POST['submit'])) {

        $sekolah = $_POST['v_sekolah'];
        $kelas = $_POST['v_kelas'];
        $jumlah = $_POST['v_jumlah'];

		if ($sekolah == "" || $kelas == "" || $jumlah == "") {
			echo "<script>alert('Data tidak boleh ada yang kosong')</script>";
		}else{
            $cek_exist = "SELECT * FROM tb_stock WHERE Kelas=$kelas";
            $result = $mysqli->query($cek_exist);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($jumlah > $row["Jumlah"])
                    {
                        echo "<script>alert('Jumlah yang Anda masukan melebihi stok kelas <b>".$kelas."</b>')</script>";
                    }
                    else
                    {
                        $jumlahbaru = $row["Jumlah"] - $jumlah;
                        $persediaanbaru = $row["Harga"] * $jumlahbaru;

                        $sql = "INSERT INTO tb_distribusi (NamaSekolah, Kelas, Jumlah) VALUES ('$sekolah', $kelas, $jumlah)";
                        $sql2 = "UPDATE tb_stock SET Jumlah='$jumlahbaru', NilaiPersediaan='$persediaanbaru' WHERE Kelas=$kelas";

                        if ($mysqli->query($sql) === TRUE && $mysqli->query($sql2) === TRUE) {
                            echo "<script>alert('Berhasil disimpan')</script>";
                        } else {
                            echo "<script>alert('Gagal tersimpan')</script>";
                        }
                    }
                }
            }
             else {
                echo "<script>alert('Stok kelas <b>".$kelas."</b> belum tersedia')</script>";
            }
            echo '<script>window.location = "distribusi.php"</script>'; 
		}
    }
    
    if(isset($_POST['update']))
    {
        $id = $_GET['id'];
        
        $sekolah = $_POST['v_sekolah'];
            
        $sql = "UPDATE tb_distribusi SET NamaSekolah='$sekolah' WHERE IndexDistribusi=$id";
        if ($mysqli->query($sql) === TRUE) {
            echo "<script>alert('Berhasil disimpan')</script>";
        }else{
            echo "<script>alert('Gagal Tersimpan')</script>";
        }
        echo '<script>window.location = "distribusi.php"</script>';
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>UAS - 192101029 - Muhammad Rozinul Miqdad</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h3 class="h">DATA LOGISTIK LEMBAR KERJA SISWA (LKS)</h3>
<h4>Programer : Muhammad Rozinul Miqdad</h4>

<p><a href="input_stok.php">Input Stock</a> | <a href="distribusi.php">Distribusi</a> | <a href="cek_stok.php">Cek Stock</a></p>

<h4>Distribusi LKS</h4>

<form method="post">
	<table class="tb">
		<tr>
			<td>Nama Sekolah</td>
			<td> :</td>
			<td><input type="text" name="v_sekolah" class="input" required="" value="<?php if(isset($_GET['edit'])){echo $sekolah;}?>" ></td>
        </tr>
        <tr>
			<td>Kelas</td>
			<td> :</td>
			<td>
                <label class="radio-inline">
                    <input type="radio" name="v_kelas" value="1" <?php if(isset($_GET['edit'])){ echo 'disabled'; }?> <?php if(isset($_GET['edit'])){ if($kelas == 1){ echo 'checked';} }?> >1
                </label>
                <label class="radio-inline">
                    <input type="radio" name="v_kelas" value="2"  <?php if(isset($_GET['edit'])){ echo 'disabled'; }?> <?php if(isset($_GET['edit'])){ if($kelas == 2){ echo 'checked';} }?> >2
                </label>
                <label class="radio-inline">
                    <input type="radio" name="v_kelas" value="3"  <?php if(isset($_GET['edit'])){ echo 'disabled'; }?> <?php if(isset($_GET['edit'])){ if($kelas == 3){ echo 'checked';} }?> >3
                </label>
                <label class="radio-inline">
                    <input type="radio" name="v_kelas" value="4"  <?php if(isset($_GET['edit'])){ echo 'disabled'; }?> <?php if(isset($_GET['edit'])){ if($kelas == 4){ echo 'checked';} }?> >4
                </label>
                <label class="radio-inline">
                    <input type="radio" name="v_kelas" value="5"  <?php if(isset($_GET['edit'])){ echo 'disabled'; }?> <?php if(isset($_GET['edit'])){ if($kelas == 5){ echo 'checked';} }?> >5
                </label>
                <label class="radio-inline">
                    <input type="radio" name="v_kelas" value="6"  <?php if(isset($_GET['edit'])){ echo 'disabled'; }?> <?php if(isset($_GET['edit'])){ if($kelas == 6){ echo 'checked';} }?> >6
                </label>
            </td>
        </tr>
		<tr>
			<td>Jumlah</td>
			<td> :</td>
			<td><input type="text" name="v_jumlah" class="input" required="" onkeypress="return event.charCode >= 48 && event.charCode <= 57" <?php if(isset($_GET['edit'])){echo 'disabled';}?> value="<?php if(isset($_GET['edit'])){echo $jumlah;}?>" ></td>
        </tr>
        <tr>
			<td></td>
			<td></td>
			<td>
                <?php if (isset($_GET['edit'])) { ?>
                <input type="submit" name="update" value="Update" class="btn">
                <?php }else{ ?> 
                <input type="submit" name="submit" value="Simpan" class="btn">
                <?php }	 ?>
            </td>
		</tr>
    </table>
</form>
<br>
<h4>Data Distribusi</h4>
<table class="tb-cetak">
	<tr>
		<td class="td-a">No</td>
		<td class="td-a">Nama Sekolah</td>
		<td class="td-a">Kelas</td>                                                                                   
		<td class="td-a">Jumlah</td>
		<td colspan="2" class="td-b">Action</td>
	</tr>
	<?php
 			$no=1;
             $sql = mysqli_query($mysqli, "SELECT * FROM tb_distribusi");
            if(mysqli_num_rows($sql) > 0)
            {
                while ($data = mysqli_fetch_array($sql)) {
 		?>
 		<tr>
 			<td class="td"><?php echo $no; ?>.</td>
 			<td class="td"><?php echo $data['NamaSekolah']; ?></td>
 			<td class="td"><?php echo $data['Kelas']; ?></td>
 			<td class="td"><?php echo $data['Jumlah']; ?></td>
             <td class="td" align="center">
                 <a href="?edit&id=<?php echo $data['IndexDistribusi']; ?>" name="edit" style="text-decoration: none;">Edit
             </td>
 			<td class="td" align="center">
                <a href="?hapus&kelas=<?php echo $data['Kelas']; ?>&jumlah=<?php echo $data['Jumlah']; ?>&id=<?php echo $data['IndexDistribusi']; ?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')" name="del" style="text-decoration: none;">Hapus
            </td>
            
 		</tr>
 		<?php 
                $no++;
                } 
            }
            else{
        ?>
            <tr>
                <td class="td" colspan='6'>Belum Ada Data</td>
            </tr>
        <?php } ?>
</table>
</body>
</html>