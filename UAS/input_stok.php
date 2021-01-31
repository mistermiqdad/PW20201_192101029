<?php
    include('koneksi.php');

    if(isset($_GET['edit'])){
        $id = $_GET['id'];
    
        // Fetch user data based on id
        $result = mysqli_query($mysqli, "SELECT * FROM tb_stock WHERE IndexStock=$id");
        
        while($data = mysqli_fetch_array($result))
        {
            $kelas = $data['Kelas'];
            $jumlah = $data['Jumlah'];
            $harga = $data['Harga'];
        }
    }

    if(isset($_GET['hapus'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM tb_stock WHERE IndexStock=$id";

        if ($mysqli->query($sql) === TRUE) {
            echo "<script>alert('Record deleted successfully')</script>";
        } else {
            echo "<script>alert('Error deleting record: ' . $mysqli->error)</script>";
        }
        echo '<script>window.location = "input_stok.php"</script>';
    }

 	if (isset($_POST['submit'])) {

        $kelas = $_POST['v_kelas'];
        $jumlah = $_POST['v_jumlah'];
        $harga =  $_POST['v_harga'];
        $persedian = $_POST['v_jumlah'] * $_POST['v_harga'];

		if ($kelas == "" || $jumlah == "" || $harga == "") {
			echo "<script>alert('Data tidak boleh ada yang kosong')</script>";
        }
        else{            

            $cek_exist = "SELECT * FROM tb_stock WHERE Kelas=$kelas";
            $result = $mysqli->query($cek_exist);

            if ($result->num_rows > 0) {
                echo "<script>alert('Data kelas <b>".$kelas."</b> sudah ada')</script>";
            }
             else {
                $sql = "INSERT INTO tb_stock (Kelas, Jumlah, Harga, NilaiPersediaan) VALUES ($kelas, $jumlah, $harga, $persedian)";
            
                if ($mysqli->query($sql) === TRUE) {
                    echo "<script>alert('Berhasil disimpan')</script>";
                } else {
                    echo "<script>alert('Gagal Tersimpan')</script>";
                }
            }
            echo '<script>window.location = "input_stok.php"</script>';
		}
    }

    if(isset($_POST['update']))
    {
        $id = $_GET['id'];
        
        $jumlah = $_POST['v_jumlah'];
        $harga =  $_POST['v_harga'];
        $persedian = $_POST['v_jumlah'] * $_POST['v_harga'];
        
        $sql = "UPDATE tb_stock SET Jumlah=$jumlah, Harga=$harga, NilaiPersediaan=$persedian WHERE IndexStock=$id";
        if ($mysqli->query($sql) === TRUE) {
            echo "<script>alert('Berhasil disimpan')</script>";
        }else{
            echo "<script>alert('Gagal Tersimpan'')</script>";
        }
        echo '<script>window.location = "input_stok.php"</script>';
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

        <h4>Form Input Stock LKS</h4>

        <form method="post">
            <table class="tb"> 
                <tr>
                    <td>Kelas</td>
                    <td> :</td>
                    <td>
                        <select name="v_kelas" class="input" required="" <?php if(isset($_GET['edit'])){ echo 'disabled'; }?>>
                            <option value="" <?php if(!isset($_GET['edit'])){  echo 'selected'; }?> disabled>--Pilih Kelas--</option>
                            <option value="1" <?php if(isset($_GET['edit'])){ if($kelas == 1){ echo 'selected';} }?> >1</option>
                            <option value="2" <?php if(isset($_GET['edit'])){ if($kelas == 2){ echo 'selected';} }?>>2</option>
                            <option value="3" <?php if(isset($_GET['edit'])){ if($kelas == 3){ echo 'selected';} }?>>3</option>
                            <option value="4" <?php if(isset($_GET['edit'])){ if($kelas == 4){ echo 'selected';} }?>>4</option>
                            <option value="5" <?php if(isset($_GET['edit'])){ if($kelas == 5){ echo 'selected';} }?>>5</option>
                            <option value="6" <?php if(isset($_GET['edit'])){ if($kelas == 6){ echo 'selected';} }?>>6</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td> :</td>
                    <td><input type="text" name="v_jumlah" class="input" required="" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(isset($_GET['edit'])){echo $jumlah;}?>" ></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td> :</td>
                    <td><input type="text" name="v_harga" class="input" required="" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(isset($_GET['edit'])){echo $harga;}?>" ></td>
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
        <h4>Data Stock LKS</h4>
        <table class="tb-cetak">
            <tr>
                <td class="td-a">No</td>
                <td class="td-a">Kelas</td>
                <td class="td-a">Jumlah</td>                                                                                   
                <td class="td-a">Harga</td>
                <td class="td-a">Nilai Persediaan</td>
                <td colspan="2" class="td-b">Action</td>
            </tr>
            <?php
                $no=1;
                $sql = mysqli_query($mysqli, "SELECT * FROM tb_stock");
                if(mysqli_num_rows($sql) > 0)
                {
                    while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td class="td"><?php echo $no; ?>.</td>
                <td class="td"><?php echo $data['Kelas']; ?></td>
                <td class="td"><?php echo $data['Jumlah']; ?></td>
                <td class="td" align='right'><?php echo number_format($data['Harga']); ?></td>
                <td class="td" align='right'><?php echo number_format($data['NilaiPersediaan']); ?></td>
                    <td class="td">
                    <a href="?edit&id=<?php echo $data['IndexStock']; ?>" name="edit" style="text-decoration: none;">Edit
                </td>
                <td class="td" align="center">
                        <a href="?hapus&id=<?php echo $data['IndexStock']; ?>" onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')" name="del" style="text-decoration: none;">Hapus
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
        <br>
        <table class="tb"> 
            <?php
                $resultLKS = mysqli_query($mysqli, 'SELECT SUM(Jumlah) AS JumlahLKS FROM tb_stock'); 
                $rowLKS = mysqli_fetch_assoc($resultLKS); 
                $SumJumlahLKS = $rowLKS['JumlahLKS'];

                $resultPersediaan = mysqli_query($mysqli, 'SELECT SUM(NilaiPersediaan) AS NilaiPersediaan FROM tb_stock'); 
                $rowPersediaan = mysqli_fetch_assoc($resultPersediaan); 
                $SumNilaiPersediaan = $rowPersediaan['NilaiPersediaan'];
            ?>
            <tr>
                <td><b>Jumlah LKS Seluruh</b></td>
                <td><b> : </b></td>
                <td><b><?php echo $SumJumlahLKS?></b></td>
            </tr>
            <tr>
                <td><b>Total Nilai Persediaan</b></td>
                <td><b> : </b></td>
                <td><b><?php echo number_format($SumNilaiPersediaan) ?></b></td>
            </tr>
        </table>
    </body>
</html>