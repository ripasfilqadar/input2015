<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?>
    <?php $this->load->view('base/sidebar_last_entry');?>

    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            <ul class="menunav" style="text-align: left;">
                <li>Isi Nomor Ujian</li>
                <li>Pilih jenjang sekolah</li>
                <li>Tekan tombol Proses</li>
                <li>Lengkapi data</li>
                <li>Pilih Sekolah</li>
                <li>Klik tombol Simpan
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Pendaftaran Siswa Baru</h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="justify">
                            <div style="margin:10px 0 0 15px;">
                            <?php if ($tingkatan == 'smp') { ?> 
                                <p class="blink" style="background-color:yellow; border:1px solid #66CE5B; display:block; text-align:center; width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px;">Apabila ada nilai rata-rata rapor yang <b>kosong</b> atau <b>tidak sesuai</b> dengan SKL, mohon diinputkan sesuai dengan nilai yang tertera pada SKL/SKHU</p>
                            <?php } ?>
                            </div>
                            <div>
                                Periksa dahulu map beserta kelengkapannya baru kemudian data dimasukkan.
                                <br />Pastikan data yang dimasukkan sudah benar.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input id="ID_SEKOLAH" name="cek_fisik" type="hidden" class="button" value="<?php echo $this->session->userdata('ID_SEKOLAH');?>"/>
                            <input id="NAMA_SEKOLAH" name="cek_fisik" type="hidden" size="20" maxlength="10" class="button" value="<?php echo $this->session->userdata('NAMA_SEKOLAH');?>"/>
                            <input id="NAMAUSER" type="hidden" name="cek_fisik" size="20" maxlength="10"  class="button" value="<?php echo $this->session->userdata('NAMA_USER');?>"/>

                            <!-- Start Input (No Ujian)-->                                
                            <table class="tabeldalamform" cellpadding="1" cellspacing="2">
                                <tr>
                                    <td colspan="2" id="error">
                                        <?php
                                        if($this->session->flashdata('error'))
                                            echo '<p class="error">'.$this->session->flashdata('error').'</p>';
                                        if (isset($errors) && $errors)
                                            echo '<p class="error">'.$errors.'</p>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri">
                                        <label>No Ujian :</label>
                                    </td>
                                    <td class="tddfkanan">
                                        <?php echo $pendaftar->NO_UJIAN; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri">
                                        <label>Jenjang Pilihan :</label>
                                    </td>
                                    <td class="tddfkanan">
                                        <?php echo $tingkatan; ?> 
                                    </td>
                                </tr>
                            </table>
                            <!-- Start Input (Pilihan) -->
                            <form class="formbesar" action="<?php echo site_url('daftar/'.$this->uri->segment(2).'/'.$tingkatan.'/'.$pendaftar->NO_UJIAN.'/1'); ?>" id="form_pendaftar" method="post">
                                <input type="hidden" name="tingkatan" value="<?php echo $tingkatan; ?>" />
                                <input type="hidden" name="no_ujian" value="<?php echo $pendaftar->NO_UJIAN; ?>" />
                                <input type="hidden" name="jalur_daftar" value="<?php echo $pendaftar->JALUR_DAFTAR; ?>" />
                                <input type="hidden" name="user_fisik" value="<?php echo $pendaftar->USER_FISIK; ?>" />
                                <input type="hidden" name="id_sekolah" value="<?php echo $pendaftar->ID_SEKOLAH; ?>" />
                                <table id="input_pilihan" class="tabeldalamform" cellpadding="1" cellspacing="2">
                                    <tr>
                                        <td colspan="2">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Nama :</label> </td>
                                        <td class="tddfkanan"><input id="NAMA" class="button" name="nama" size="30" value="<?php echo $pendaftar->NAMA; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Tahun Lulus :</label> </td>
                                        <td class="tddfkanan">
                                            <input type="text" name="tahun_lulus" value="<?php echo $pendaftar->TAHUN_LULUS; ?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tddfkiri"><label>Jenis Kelamin :</label> </td>
                                        <td class="tddfkanan">
                                            <select id="JENIS_KELAMIN" name="jenis_kel">
                                                <option value="L"<?php echo ($pendaftar->JENIS_KEL == 'L') ? ' selected="selected"' : ''; ?>>Laki-laki</option>
                                                <option value="P"<?php echo ($pendaftar->JENIS_KEL == 'P') ? ' selected="selected"' : ''; ?>>Perempuan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Tempat, Tanggal Lahir :</label> </td>
                                        <td class="tddfkanan">
                                            <input id="TMP_LAHIR" name="tmp_lahir" size="23" class="button" value="<?php echo $pendaftar->TMP_LAHIR; ?>" />,<br />
                                            <input id="TMP_LAHIR" name="tgl_lahir" size="23" class="button" value="<?php echo $pendaftar->TGL_LAHIR; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Alamat Rumah:</label> </td>
                                        <td class="tddfkanan"><textarea id="ALAMAT" name="alamat" class="button" rows="2" cols="23"><?php echo $pendaftar->ALAMAT; ?></textarea></td> <!-- ALAMAT -->
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Kota/Kab :</label> </td>
                                        <td class="tddfkanan">
                                            <input id="KOTA" name="kota" size="30" class="button" value="<?php echo $pendaftar->KOTA; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Domisili/No.KK :</label> </td>
                                        <td class="tddfkanan"><input id="DOMISILI" name="domisili" size="30" class="button" value="<?php echo $pendaftar->DOMISILI; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Nama Orang Tua :</label> </td>
                                        <td class="tddfkanan"><input id="NAMA_ORTU" name="nama_ortu"  size="30" class="button" value="<?php echo $pendaftar->NAMA_ORTU; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Sekolah Asal :</label> </td>
                                        <td class="tddfkanan"><input id="ASAL_SEKOLAH" name="asal_sekolah" class="button" size="30" value="<?php echo $pendaftar->ASAL_SEKOLAH; ?>" /></td> <!-- SEKOLAH_ASAL -->
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label>Kota/Kab :</label> </td>
                                        <td class="tddfkanan">
                                            <input id="KOTA_ASAL_SEKOLAH" name="kota_asal_sekolah" size="30" class="button" value="<?php echo $pendaftar->KOTA_ASAL_SEKOLAH; ?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Nilai :</label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <?php if ($tingkatan != 'smp') { ?> 
                                                    <th>B. ING</th>
                                                    <?php } ?> 
                                                    <th>Nilai Akhir</th>
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td>
                                                            <input id="nilai_bind" name="nilai_bind" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_BIND; ?>" />
                                                        </td>
                                                        <td>
                                                            <input id="nilai_mat" name="nilai_mat" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_MAT; ?>" />
                                                        </td>
                                                        <td><input id="nilai_ipa" name="nilai_ipa" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_IPA; ?>" /></td>
                                                        <?php if ($tingkatan != 'smp') { ?> 
                                                        <td><input id="nilai_bing" name="nilai_bing" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_BING; ?>" /></td>
                                                        <?php } ?> 
                                                        <td><input type="text" name="nun_asli" value="<?php echo $pendaftar->NUN_ASLI; ?>" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php if (false) { ?> 
                                    <tr>
                                        <td></td>
                                        <td>
                                            <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>NTMB</th>
                                                    <th>NTK</th>
                                                    <th>NILAI TERPADU</th>
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td>
                                                            <input id="ntmb" name="ntmb" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NTMB; ?>" /><br />
                                                            10.0-100.0
                                                        </td>
                                                        <td>
                                                            <input id="ntk" name="ntk" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NTK; ?>" /><br />
                                                            10.0-100.0
                                                        </td>
                                                        <td>
                                                            <input id="nilai_akhir" name="nilai_akhir" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NILAI_AKHIR; ?>" /><br />
                                                            10.0-100.0
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?> 
                                    <tr>
                                        <td class="tddfkiri"><label>Nomor Telepon :</label> </td>
                                        <td class="tddfkanan"><input id="NO_TELP" name="no_telp" size="30" class="button" value="<?php echo $pendaftar->NO_TELP; ?>" /></td>
                                    </tr>
                                    <tr id="row_psiko">
                                        
                                    </tr>
                                    <tr id="row_wawancara">
                                        
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Pilihan <?php echo ($tingkatan != 'smk') ? 'Sekolah' : 'Jurusan'; ?> :</label> </td>
                                        <td class="tddfkanan">
                                            <strong>PILIHAN 1</strong><br />
                                            <select name="pilih1">
                                                <option value="">[ID] - [Sekolah], [Jurusan]</option>
                                                <?php
                                                $temp = '';
                                                foreach ($sekolah as $item) {
                                                ?>
                                                <option value="<?php echo $item->ID_SEKOLAH; ?>"<?php echo ($item->ID_SEKOLAH == $pendaftar->PILIH1) ? ' selected="selected"' : ''; ?>><?php echo $item->ID_SEKOLAH; ?> - <?php echo $item->NAMA_SEKOLAH.', '.$item->JURUSAN; ?></option>
                                                <?php
                                                }
                                                ?> 
                                            </select>
                                            <div id="data_pilihan1" style="margin-bottom: 6px;">
                                            </div>

                                            <strong>PILIHAN 2</strong><br />
                                            <select name="pilih2">
                                                <option value="">[ID] - [Sekolah], [Jurusan]</option>
                                                <?php
                                                $temp = '';
                                                foreach ($sekolah as $item) {
                                                ?>
                                                <option value="<?php echo $item->ID_SEKOLAH; ?>"<?php echo ($item->ID_SEKOLAH == $pendaftar->PILIH2) ? ' selected="selected"' : ''; ?>><?php echo $item->ID_SEKOLAH; ?> - <?php echo $item->NAMA_SEKOLAH.', '.$item->JURUSAN; ?></option>
                                                <?php
                                                }
                                                ?> 
                                            </select>
                                            <div id="data_pilihan2" style="margin-bottom: 6px;">              
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="tddfkiri"><label>Alasan Perubahan :</label> </td>
                                        <td class="tddfkanan">
                                            <textarea name="alasan_perubahan" cols="35"></textarea>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="tddfkiri">&nbsp;</td>
                                        <td class="tddfkanan">
                                            <input id="simpan" type="submit" name="act" value="Simpan" style="border: solid thin #123412"/>
                                            <input id="kembali1" type="submit" name="act" value="Kembali" style="border: solid thin #123412;" onclick="cancelForm();" />
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
