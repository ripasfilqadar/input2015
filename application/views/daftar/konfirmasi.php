<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?>
    <?php $this->load->view('base/sidebar_last_entry');?>

    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            <ul class="menunav" style="text-align: left;">
                <li>Klik tombol Daftar untuk mengkonfirmasi</li>
                <li>Klik tombol Edit untuk mengubah data</li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Pendaftaran Siswa <?php echo ($this->uri->segment(2) == 'baru') ? 'Baru' : (($this->uri->segment(2) == 'lalu') ? 'Lulusan Tahun Lalu' : 'Rekomendasi'); ?></h2></td>
        </tr>
        <tr></tr>
        <tr>
            <td>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="center">
                            <!-- Start Input (Pilihan) -->
                            <form class="formbesar" action="<?php echo site_url('daftar/'.$this->uri->segment(2).'/3'); ?>" method="post">
                                <input id="ID_SEKOLAH" name="cek_fisik" type="hidden" class="button" value="<?php echo $this->session->userdata('ID_SEKOLAH');?>"/>
                                <input id="NAMA_SEKOLAH" name="cek_fisik" type="hidden" size="20" maxlength="10" class="button" value="<?php echo $this->session->userdata('NAMA_SEKOLAH');?>"/>
                                <input id="NAMAUSER" type="hidden" name="cek_fisik" size="20" maxlength="10"  class="button" value="<?php echo $this->session->userdata('NAMA_USER');?>"/>
                                <table id="input_pilihan" class="tabeldalamform" cellpadding="1" cellspacing="2">
                                    <tr>
                                        <td colspan="2">
                                            <?php
                                            if((isset($errors2) && $errors2))
                                                echo '<p class="error">'.$errors2.'</p>';
                                            ?>
                                        </td>
                                    </tr>
                                   <tr>
                                        <td class="tddfkiri"><label><?php echo $_pendaftaran ?></label> </td>
                                        <td class="tddfkanan"><?php echo $NO_PENDAFTARAN; ?></td>
                                   </tr>  
                                   <tr>
                                        <td class="tddfkiri"><label><?php echo $_noun ?></label> </td>
                                        <td class="tddfkanan"><?php echo $NO_UJIAN; ?></td>
                                    </tr>
                                        <td class="tddfkiri"><label><?php echo $_nama ?></label> </td>
                                        <td class="tddfkanan"><?php echo $NAMA; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_lulus ?></label> </td>
                                        <td class="tddfkanan">
                                            <?php echo $TAHUN_LULUS; ?> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_kelamin ?></label> </td>
                                        <td class="tddfkanan">
                                            <?php echo ($JENIS_KEL == 'L') ? 'Laki-laki' : 'Perempuan'; ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_lahir ?></label> </td>
                                        <td class="tddfkanan">
                                            <?php echo $TMP_LAHIR; ?>, <?php echo $TGL_LAHIR; ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_alamat ?></label> </td>
                                        <td class="tddfkanan"><?php echo $ALAMAT; ?></td> <!-- ALAMAT -->
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_kota ?></label> </td>
                                        <td class="tddfkanan">
                                            <?php echo $KOTA; ?> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_domisili ?></label> </td>
                                        <td class="tddfkanan"><?php echo ($DOMISILI=='') ? '-' : $DOMISILI; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_sekolah ?></label> </td>
                                        <td class="tddfkanan"><?php echo $ASAL_SEKOLAH; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_kota2 ?></label> </td>
                                        <td class="tddfkanan">
                                            <?php echo ($KOTA_ASAL_SEKOLAH=='') ? '-' : $KOTA_ASAL_SEKOLAH; ?> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php if($tingkatan=='smp')echo "Nilai Ujian Sekolah"; else echo $_nilai ?></label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <?php if ($tingkatan != 'smp') { ?> 
                                                    <th>B. ING</th>
                                                    <?php } ?> 
                                                    <th>TOTAL NILAI</th>
                                                    <?php if (false) { ?> 
                                                    <th>NTMB</th>
                                                    <th>NTK</th>
                                                    <th>NILAI TERPADU</th>
                                                    <?php } ?> 
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td><?php echo $UAN_BIND; ?></td>
                                                        <td><?php echo $UAN_MAT; ?></td>
                                                        <td><?php echo $UAN_IPA; ?></td>
                                                        <?php if ($tingkatan != 'smp') { ?> 
                                                        <td><?php echo $UAN_BING; ?></td>
                                                        <?php } ?> 
                                                        <td><?php echo $NUN_ASLI; ?></td> 
                                                        <?php if (false) { ?> 
                                                        <th><?php echo $NTMB; ?></th>
                                                        <th><?php echo $NTK; ?></th>
                                                        <th><?php echo $NILAI_AKHIR; ?></th>
                                                        <?php } ?> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php if ($tingkatan == 'smp') { ?> 
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Nilai Rata-Rata Rapor</label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_RAP" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <th>TOTAL NILAI</th>
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td><?php echo $RAP_BIND; ?></td>
                                                        <td><?php echo $RAP_MAT; ?></td>
                                                        <td><?php echo $RAP_IPA; ?></td>
                                                        <td><?php echo $NRAP_ASLI; ?></td>
                                                        <!-- <td><?php echo $UAN_BIND; ?></td>
                                                        <td><?php echo $UAN_MAT; ?></td>
                                                        <td><?php echo $UAN_IPA; ?></td>
                                                        <td><?php echo $NUN_ASLI; ?></td> -->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Nilai Akhir / Nilai Sekolah</label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_AKHIR" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <th>NILAI AKHIR</th>
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td><?php echo $AKHIR_BIND; ?></td>
                                                        <td><?php echo $AKHIR_MAT; ?></td>
                                                        <td><?php echo $AKHIR_IPA; ?></td>
                                                        <td><?php echo $NILAI_AKHIR; ?></td>
                                                        <!-- <td><?php echo $UAN_BIND; ?></td>
                                                        <td><?php echo $UAN_MAT; ?></td>
                                                        <td><?php echo $UAN_IPA; ?></td>
                                                        <td><?php echo $NUN_ASLI; ?></td> -->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_telp ?></label> </td>
                                        <td class="tddfkanan"><?php echo ($NO_TELP == '') ? '-' : $NO_TELP; ?></td>
                                    </tr>
                                    <tr id="row_psiko">
                                        
                                    </tr>
                                    <tr id="row_wawancara">
                                        
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_pilihan ?> <?php echo ($tingkatan != 'smk') ? 'Sekolah' : 'Jurusan'; ?> :</label> </td>
                                        <td class="tddfkanan">
                                            <?php echo ($tingkatan == 'smk') ? $sekolah[$PILIH1]->NAMA_SEKOLAH.'<br />' : ''; ?> 
                                            <strong>PILIHAN <?php echo ($tingkatan == 'smk') ? 'Jurusan ' : ''; ?>1</strong><br />
                                            <?php echo ($PILIH1) ? (($tingkatan != 'smk') ? $sekolah[$PILIH1]->NAMA_SEKOLAH : $sekolah[$PILIH1]->JURUSAN) : '(tidak memilih)'; ?> <br />

                                            <strong>PILIHAN <?php echo ($tingkatan == 'smk') ? 'Jurusan ' : ''; ?>2</strong><br />
                                            <?php echo ($PILIH2) ? (($tingkatan != 'smk') ? $sekolah[$PILIH2]->NAMA_SEKOLAH : $sekolah[$PILIH2]->JURUSAN) : '(tidak memilih)'; ?> <br />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">&nbsp;</td>
                                        <td class="tddfkanan">
                                            <input id="simpan" type="submit" name="act" value="Daftar" onclick="return confirm('Anda yakin data yang sudah diisikan benar?');" style="border: solid thin #123412"/>
                                            <input id="simpan" type="submit" name="act" value="Edit" style="border: solid thin #123412"/>
                                            <input id="kembali1" type="submit" name="act" value="Batal" style="border: solid thin #123412;"/>
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><br /></td></tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                    <tr><td colspan="2"><br /></td></tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
