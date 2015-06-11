<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
</div>

<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Detail Pendaftar</h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                        <td class="style2">Nomor Ujian</td>
                        <td>:</td>
                        <td><?php echo $NO_UJIAN; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nama Peserta Didik</td>
                        <td>:</td>
                        <td><?php echo $NAMA; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nama Orang Tua/Wali</td>
                        <td>:</td>
                        <td><?php echo $NAMA_ORTU; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Tempat, Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo $TMP_LAHIR.', '.$TGL_LAHIR; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Alamat</td>
                        <td>:</td>
                        <td><?php echo $ALAMAT; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Sekolah Asal</td>
                        <td>:</td>
                        <td><?php echo $ASAL_SEKOLAH.', '.$KOTA_ASAL_SEKOLAH; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nomor Telepon</td>
                        <td>:</td>
                        <td><?php echo $NO_TELP; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nilai Bahasa Indonesia</td>
                        <td>:</td>
                        <td><?php echo $BIND; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nilai Matematika</td>
                        <td>:</td>
                        <td><?php echo $MAT; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nilai IPA</td>
                        <td>:</td>
                        <td><?php echo $IPA; ?></td>
                    </tr>
                    <?php if ($tingkatan == 'smp') { ?> 
                    <tr>
                        <td class="style2">Nilai Bahasa Inggris</td>
                        <td>:</td>
                        <td><?php echo $BING; ?></td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <td class="style2">Nilai Akhir Total</td>
                        <td>:</td>
                        <td><?php echo $NUN_ASLI; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
