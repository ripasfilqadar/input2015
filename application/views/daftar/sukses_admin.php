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
                        <td><?php echo $UAN_BIND; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nilai Matematika</td>
                        <td>:</td>
                        <td><?php echo $UAN_MAT; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nilai IPA</td>
                        <td>:</td>
                        <td><?php echo $UAN_IPA; ?></td>
                    </tr>
                    <?php if ($tingkatan != 'smp') { ?> 
                    <tr>
                        <td class="style2">Nilai Bahasa Inggris</td>
                        <td>:</td>
                        <td><?php echo $UAN_BING; ?></td>
                    </tr>
                    <?php } ?> 
                    <?php if (false) { ?> 
                    <tr>
                        <td class="style2">NTMB</td>
                        <td>:</td>
                        <td><?php echo $NTMB; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">NTK</td>
                        <td>:</td>
                        <td><?php echo $NTK; ?></td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <td class="style2">Nilai Akhir</td>
                        <td>:</td>
                        <td><?php echo $NUN_ASLI; ?></td>
                    </tr>
                    <?php if (false) { ?> 
                    <tr>
                        <td class="style2">Nilai Terpadu</td>
                        <td>:</td>
                        <td><?php echo $NILAI_AKHIR; ?></td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <td class="style2">Pilihan Sekolah</td>
                        <td>:</td>
                        <td>
                            <?php echo ($tingkatan == 'smk') ? $sekolah[$PILIH1]->NAMA_SEKOLAH.'<br />' : ''; ?> 
                            <strong>PILIHAN <?php echo ($tingkatan == 'smk') ? 'Jurusan ' : ''; ?>1</strong><br />
                            <?php echo ($PILIH1) ? (($tingkatan != 'smk') ? $sekolah[$PILIH1]->NAMA_SEKOLAH : $sekolah[$PILIH1]->JURUSAN) : '(tidak memilih)'; ?> <br />

                            <strong>PILIHAN <?php echo ($tingkatan == 'smk') ? 'Jurusan ' : ''; ?>2</strong><br />
                            <?php echo ($PILIH2) ? (($tingkatan != 'smk') ? $sekolah[$PILIH2]->NAMA_SEKOLAH : $sekolah[$PILIH2]->JURUSAN) : '(tidak memilih)'; ?> <br />
                        </td>
                    </tr>
                    <tr>
                        <td class="style2">Tempat Pendaftaran</td>
                        <td>:</td>
                        <td><?php echo $ID_SEKOLAH.'. ';
                        if ($NO_TINGKATAN != '3') echo $sekolah[$ID_SEKOLAH]->NAMA_SEKOLAH;
                        else {
                            for ($i = $start = intval($ID_SEKOLAH)*100; $i < $start + 100; $i++) {
                                if (isset($sekolah[$i])) {
                                    echo $sekolah[$i]->NAMA_SEKOLAH;
                                    break;
                                }
                            }
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Tanggal Pendaftaran</td>
                        <td>:</td>
                        <td><?php echo $WAKTU_DAFTAR; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">IP Pendaftaran</td>
                        <td>:</td>
                        <td><?php echo $IP_ADDRESS; ?></td>
                    </tr>
                </table>
                <?php echo anchor('pdf/cetak/'.$tingkatan.'/'.$NO_UJIAN, 'Cetak', 'style="color: blue;"'); ?>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
