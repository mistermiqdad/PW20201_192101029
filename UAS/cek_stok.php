<?php
    include('koneksi.php');
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

<h4>Cek Stock</h4>

<table class="tb-cetak">
	<tr>
		<td class="td-a">No</td>
		<td class="td-a">Kelas</td>
		<td class="td-a">Jumlah</td>                                                                                   
		<td class="td-a">Harga</td>
		<td class="td-b">Nilai Persediaan</td>
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
 		</tr>
 		<?php 
                $no++;
                }
            }
            else
            {
        ?>
            <tr>
                <td class="td" colspan='5'>Belum Ada Data</td>
            </tr>
        <?php } ?>
</table>
</body>
</html>