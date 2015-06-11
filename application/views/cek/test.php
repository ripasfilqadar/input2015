<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
</div>

<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2><?php echo($status); ?></h2></td>
        </tr>
        
        <tr>
            <td>
                <table class="tabeldalambesar" border="0" cellspacing="5" cellpadding="0">
                    <h3>Detail Pendaftar</h3>
                    
                    <tr>
                        <td class="style2">Nomor Urut</td>
                        <td>:</td>
                        <td><?php echo get_pendaftar_num_row($tingkatan, $PID, ($tingkatan == 'smk') ? $PILIH1 : $this->session->userdata('ID_SEKOLAH'), (strpos($this->session->userdata('HAK'), 'inputrekom') !== false) ? "<> 1" : "= 1"); ?></td>
                    </tr>
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
                        <td class="style2">Domisili</td>
                        <td>:</td>
                        <td><?php echo $DOMISILI; ?></td>
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
                    <?php if ($tingkatan == 'smk') { ?> 
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
                    <?php if ($tingkatan == 'smk') { ?> 
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
                        <td class="style2">Tanggal dan Waktu Pendaftaran</td>
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
                <?php echo ($this->session->userdata('HAK') == 'admin') ? anchor('daftar/edit/'.$tingkatan.'/'.$NO_UJIAN.'/1', 'Edit', 'style="color: blue;"') : ''; ?> 
                <?php echo ($this->session->userdata('HAK') == 'inputsmk') ? anchor('daftar/ntmbntk/'.$NO_UJIAN, 'Input NTMB/NTK', 'style="color: blue;"') : '' ?> 
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
