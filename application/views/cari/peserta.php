<?php $this->load->view('base/header', array('namePage' => "Mencari Data "));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            <ul class="menunav" style="text-align: left;">
                <li>Isi Nomor Ujian / Nama Siswa</li>
                <li>Tekan Cari</li>
                <li>Jika Siswa Terdaftar Maka Akan Ditampilkan List Siswa Yang Terkait</li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
<!-- CONTENT -->
<div style="float:left;">
    <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Cari Data</h2></td>
        </tr>
        <tr>
            <td>
                <p>Untuk melakukan pencarian data, masukkan nomor pendaftaran atau nama siswa.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="justify" width="100%" valign="top">
                            <div style="text-align:center;width: 580px;overflow:auto;">
                                <form method="get" action="<?php echo site_url('cari'); ?>">
                                    <table width="500px">
                                        <tr>
                                            <td>No Ujian</td>
                                            
                                            <td><input type="text" size="15" id="no_ujian" name="un" class="button" value="<?php echo $this->input->get('un'); ?>" /></td>
                                            <td>&nbsp;Nama</td>
                                            <td><input type="text" size="25" id="nama" name="nama" class="button" value="<?php echo $this->input->get('nama'); ?>" /></td>
                                            <td>Tingkatan:</td>
                                            <td>
                                                <select name="tingkatan">
                                                    <?php
                                                    $tingkatan_sekolah = '';
                                                    switch ($this->session->userdata('TINGKATAN_SEKOLAH')) {
                                                        case 1:
                                                            $tingkatan_sekolah = 'smp';
                                                            break;
                                                        case 2:
                                                            $tingkatan_sekolah = 'sma';
                                                            break;
                                                        case 3:
                                                            $tingkatan_sekolah = 'smk';
                                                            break;
                                                    }
                                                    $tingkatan_user = (strpos($this->session->userdata('HAK'), 'inputrekom') !== false) ? substr($this->session->userdata('HAK'), -3) : (($this->session->userdata('HAK') != 'admin') ? $tingkatan_sekolah : '');
                                                    ?> 
                                                    <?php if ($tingkatan_user == 'smp' || !$tingkatan_user) { ?><option value="smp"<?php echo ($tingkatan == 'smp') ? ' selected="selected"' : ''; ?>>SMP</option><?php } ?> 
                                                    <?php if ($tingkatan_user == 'sma' || !$tingkatan_user) { ?><option value="sma"<?php echo ($tingkatan == 'sma') ? ' selected="selected"' : ''; ?>>SMA</option><?php } ?> 
                                                    <?php if ($tingkatan_user == 'smk' || !$tingkatan_user) { ?><option value="smk"<?php echo ($tingkatan == 'smk') ? ' selected="selected"' : ''; ?>>SMK</option><?php } ?> 
                                                </select>
                                            </td>
                                        </tr>
                                        </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <input type="hidden" name="msg" />
                                                <input id="cari" type="submit" name="act" value="Cari" style="border: solid thin #123412"/>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo (isset($total)) ? $total.' data ditemukan.' : ''; ?> 
                            <?php echo (isset($links)) ? "<p>$links</p>" : ''; ?> 
                            <table class="tabeldalamform" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="justify" width="100%" valign="top">
                                        <div id="detail_canvas" style="display: none; position:absolute; overflow:auto; height: 400px; width: 500px; border: solid thin grey; backgroundcolor:white;">
                                                                                      Verifikasi goes here
                                        </div>
                                        <?php if ($this->input->get('un') || $this->input->get('nama')) { ?> 
                                        <div style="text-align:center;width: 580px;overflow:auto;height: 400px">
                                            <table width="100%" id="TablePeserta">
                                                <thead>
                                                    <?php if ($this->session->userdata('HAK') != 'admin') { ?><th>No Urut</th><?php } ?> 
                                                    <th>No Ujian</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Sekolah Asal</th>
                                                    <th>Tgl Daftar</th>
                                                    <th>Pilihan</th>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 0;
                                                    foreach ($pendaftar as $row) { 
                                                    ?> 
                                                    <tr class="trkecil<?php echo $i%2; ?>">
                                                        <?php if ($this->session->userdata('HAK') != 'admin') { ?><td><?php echo get_pendaftar_num_row($tingkatan, $row->PID, ($tingkatan == 'smk') ? $row->PILIH1 : $this->session->userdata('ID_SEKOLAH'), ((strpos($this->session->userdata('HAK'), 'inputrekom') !== false) ? "<> 1" : "= 1")) ?></td><?php } ?> 
                                                        <td><?php echo anchor('cari/detail/'.$tingkatan.'/'.$row->NO_UJIAN, $row->NO_UJIAN, 'style="color: blue;"'); ?></td>
                                                        <td><?php echo $row->NAMA; ?></td>
                                                        <td><?php echo $row->ASAL_SEKOLAH; ?></td>
                                                        <td><?php echo $row->WAKTU_DAFTAR; ?></td>
                                                        <td><?php echo '1. '.$sekolah[$row->PILIH1]->NAMA_SEKOLAH.(($row->PILIH2) ? '<br />2. '.$sekolah[$row->PILIH2]->NAMA_SEKOLAH : ''); ?></td>
                                                    </tr>
                                                    <?php 
                                                        $i++;
                                                    } 
                                                    ?> 
                                                    <?php 
                                                    if ($i == 0) {
                                                    ?>
                                                    <tr><td colspan="5">Data tidak ditemukan</td></tr>
                                                    <?php
                                                    }
                                                    ?> 
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer');?>