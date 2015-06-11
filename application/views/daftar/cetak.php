<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Cetak Bukti Pendaftaran</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?php echo base_url();?>css/cetak.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div id="container">
            <table id="maintable">
                    <tr>
                        <?php for($i=0; $i<2; $i=$i+1) {?>
                        <td id ="kolomutama">
                            <div id="header">
            <!--                <div id="logo">
                                <img src="<?php echo base_url(); ?>images/sidoarjo.jpg" width="100%" />
                            </div>-->
                            <div id="title">
                                <h2>Pemerintah Kabupaten Sidoarjo</h2>
                                <h1>DINAS PENDIDIKAN</h1>
                                <p>Jl. Pahlawan No. 4, Sidoarjo</p>
                                <p>Telp. 031-8921219, 031-8940921</p>
                                <br />
                            </div>
                        </div>
                        <div id="content">
                            <br />
                            <h2>Bukti Pendaftaran</h2>
                            <br />
                            <table border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                    <td>Nomor Ujian</td>
                                    <td>:</td>
                                    <td><?php echo $NO_UJIAN; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Peserta Didik</td>
                                    <td>:</td>
                                    <td><?php echo $NAMA; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Orang Tua/Wali</td>
                                    <td>:</td>
                                    <td><?php echo $NAMA_ORTU; ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?php echo $TMP_LAHIR.', '.$TGL_LAHIR; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?php echo $ALAMAT; ?></td>
                                </tr>
                                <tr>
                                    <td>Sekolah Asal</td>
                                    <td>:</td>
                                    <td><?php echo $ASAL_SEKOLAH.', '.$KOTA_ASAL_SEKOLAH; ?></td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>:</td>
                                    <td><?php echo $NO_TELP; ?></td>
                                </tr>
                                <?php if ($tingkatan != 'smp') { ?> 
                                <tr>
                                    <td>Nilai Akhir Bahasa Inggris</td>
                                    <td>:</td>
                                    <td><?php echo $UAN_BING; ?></td>
                                </tr>
                                <?php } ?> 
                                <tr>
                                    <td>Nilai Akhir Bahasa Indonesia</td>
                                    <td>:</td>
                                    <td><?php echo $UAN_BIND; ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai Akhir Matematika</td>
                                    <td>:</td>
                                    <td><?php echo $UAN_MAT; ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai Akhir IPA</td>
                                    <td>:</td>
                                    <td><?php echo $UAN_IPA; ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai Akhir Total</td>
                                    <td>:</td>
                                    <td><?php echo $NUN_ASLI; ?></td>
                                </tr>
                                <tr>
                                    <td>Pilihan 1</td>
                                    <td>:</td>
                                    <td><?php echo ($PILIH1) ? $sekolah[$PILIH1]->NAMA_SEKOLAH : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>Pilihan 2</td>
                                    <td>:</td>
                                    <td><?php echo ($PILIH2) ? $sekolah[$PILIH2]->NAMA_SEKOLAH : ''; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal dan Waktu Pendaftaran</td>
                                    <td>:</td>
                                    <td><?php echo $LOG_DAFTAR; ?></td>
                                </tr>
                                <tr>
                                    <td>IP Pendaftaran</td>
                                    <td>:</td>
                                    <td><?php echo $IP_ADDRESS; ?></td>
                                </tr>
                            </table>
                            <br />
                            <table id="pengesahan">
                                <tr>
                                    <td colspan="3">
                                        Mengesahkan,<br />
                                        Sidoarjo, 
                                        <?php
                                            $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei',
                                                'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember','Desember');
                                            $this->load->helper('date');
                                            $m = $bulan[(int)mdate('%m',time())-1];
                                            $datestring = "%d ".$m." %Y";
                                            $time = time();
                                            echo mdate($datestring, $time);
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ttd">
                                        Petugas Verifikasi<br />
                                        <br />
                                        <br />
                                        (................................)
                                    </td>
                                    <td class="ttd"></td>
                                    <td class="ttd">
                                        Orang Tua/Wali<br />
                                        <br />
                                        <br />
                                        (................................)
                                    </td>
                                </tr>
                            </table>
                            <br />
                            <br />
                            <br />
                        </div>
                        <div id="footer">
                            <?php

                                $datacetak = "ppdbsda".$NO_UJIAN."p1".$PILIH1."p2".$PILIH2."2012nandezriannajibsindung";
                                $kodecetak = md5(base64_encode($datacetak));
                                echo "Kode cetak : ".substr($kodecetak, -8)."<br/>";

                            ?>  
                        </div>
                            <?php if( $i == 0 )?>
                            <div id ="separator"></div>
                        </td>
                        <?php } ?>
                    </tr>
            </table>
        </div>
    </body>
</html>
