<html>
    <head>
        <title>UTS Pemograman Web</title>
    </head>

    <script>
        function clear()
        {
            alert('Tai');
        }
    </script>
    
    <body>
        <form method="GET">
            <h3><u><b>Form Input</b></u></h3>
            <table>
                <tr>
                    <td>
                        Nama
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <input type="text" name="nama" required>
                    </td>

                    <td width="10%"></td>

                    <td>
                        Lama
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <input type="number" name="lama" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Kode Booking 
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <select name=kodebook required>
                            <option value="" selected disabled>Pilih</option>
                            <option value="AL02102">AL02102</option>
                            <option value="BG03025">BG03025</option>
                            <option value="CR02111">CR02111</option>
                            <option value="KM03075">KM03075</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Jumlah
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <input type="number" name="jumlah" required>
                    </td>

                    <td></td>

                    <td>
                        Jenis Pembayaran
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <select name=pembayaran required>
                            <option value="" selected disabled>Pilih</option>
                            <option value="Kartu Kredit">Kartu Kredit</option>
                            <option value="Debit">Debit</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="submit" name="proses" value="Proses">
                        <input type="button" name="hapus" onclick="clear()" value="Hapus">
                        <!-- <button onclick="clear()">Click me</button> -->
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

<?php 
    $nama = @$_GET['nama'];
    $lama = @$_GET['lama'];
    $kodebook = @$_GET['kodebook'];
    $jumlah = @$_GET['jumlah'];
    $pembayaran = @$_GET['pembayaran'];
    $kodekamar = substr($kodebook,0,2);
    $lantai = substr($kodebook,2,2);
    $nomorkamar = substr($kodebook,-3);

    //If Conditional Untuk Kamar
    if($kodekamar == 'AL')
    {
        $namakamar = 'Alamanda';
        $hargakamar = 450000;
    }
    else if($kodekamar == 'BG')
    {
        $namakamar = 'Bougenvile';
        $hargakamar = 350000;
    }
    else if($kodekamar == 'CR'){
        $namakamar = 'Crysan';
        $hargakamar = 375000;
    }
    else if($kodekamar == 'KM'){
        $namakamar = 'Kemuning';
        $hargakamar = 425000;
    }
    else {
        $namakamar = '';
        $hargakamar = 0;
    }

    //If Conditional Jumlah Orang
    if($jumlah > 2)
    {
        $banyakorang = $jumlah - 2;
        $biayatambahan = 75000 * $banyakorang;
    }
    else{
        $biayatambahan = 0;
    }

    //If Conditional Pembayaran
    if($pembayaran == 'Kartu Kredit'){
        $harga = $hargakamar + $biayatambahan;
        $potongtambah = $harga * 2/100;
        $totalbiaya = $harga + $potongtambah;
    }
    else if($pembayaran == 'Debit'){
        $harga = $hargakamar + $biayatambahan;
        $potongtambah = $harga * 1.5/100;
        $totalbiaya = $harga - $potongtambah;
    }
    else if($pembayaran == 'Cash'){
        $totalbiaya = $hargakamar + $biayatambahan;
        $potongtambah = 0;
    }
    else{
        $totalbiaya = 0;
        $potongtambah = 0;
    }

    if(@$_GET['proses'])
    {
?>

<h3><u><b>Output</b></u></h3>
<h3><u><b>FLORENSIA HOTEL</b></u></h3>
<table>
    <tr>
        <td>
            Nama
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $nama ?>
        </td>

        <td width="15%"></td>

        <td>
            Kode Booking
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $kodebook ?>
        </td>
    </tr>
    <tr>
        <td>
            Nama Kamar
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $namakamar ?>
        </td>

        <td></td>

        <td>
            Lantai
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $lantai ?>
        </td>
    </tr>
    <tr>
        <td>
            Nomor
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $nomorkamar ?>
        </td>

        <td></td>

        <td>
            Jumlah
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $jumlah ?> Orang
        </td>
    </tr>
    <tr>
        <td>
            Lama
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $lama ?> Hari
        </td>

        <td></td>

        <td>
            Jenis Pembayaran
        </td>
        <td>
            :
        </td>
        <td>
            <?php echo $pembayaran ?>
        </td>
    </tr>
    <tr>
        <td>
            Potongan / Tambahan
        </td>
        <td>
            :
        </td>
        <td>
            Rp <?php echo $potongtambah ?>
        </td>

        <td></td>

        <td>
            Biaya Spring Bad Tambahan
        </td>
        <td>
            :
        </td>
        <td>
            Rp <?php echo $biayatambahan ?>
        </td>
    </tr>
    <tr>
        <td>
            Total Biaya seluruhnya
        </td>
        <td>
            :
        </td>
        <td>
            Rp <?php echo $totalbiaya ?>
        </td>
    </tr>
</table>

<?php
    }
?>