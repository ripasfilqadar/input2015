<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?>
    <?php $this->load->view('base/sidebar_last_entry');?>
</div>

<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Pendaftaran berhasil</h2></td>
        </tr>
        <tr>
            <td>Pendaftaran telah berhasil dilakukan dengan detail seperti di bawah ini.</td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" border="0" cellspacing="5" cellpadding="0" style="vertical-align: top;">
                    <tr>
                        <td class="style2">Sekolah</td>
                        <td>:</td>
                        <td><?php echo $SEKOLAH; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $NAMALENGKAP; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">No. Telepon</td>
                        <td>:</td>
                        <td><?php echo $KETERANGAN; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Hak</td>
                        <td>:</td>
                        <td><?php echo $hak; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Username</td>
                        <td>:</td>
                        <td><?php echo $NAMAUSER; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Password</td>
                        <td>:</td>
                        <td><?php echo $PASSWD; ?></td>
                    </tr>
                </table>
                <?php // /echo anchor('pdf/cetak/'.$tingkatan.'/'.$NO_UJIAN, 'Cetak', 'style="color: blue;"'); ?>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
