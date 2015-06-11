<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?>
    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            Klik pada nomor pendaftaran untuk melihat data lebih detil.
            <br/>
            <br/>
            <div class="clear"></div>
        </div>
    </div>
</div>
<!-- CONTENT -->
<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Master UN <?php echo strtoupper($this->uri->segment(3)); ?></h2></td>
        </tr>
        <tr>
            <td>
                <p>Untuk melakukan pencarian data, masukkan nomor pendaftaran atau nama siswa.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="justify" width="100%" valign="top">
                            <div style="text-align:center;width: 580px;overflow:auto;">
                                <form method="get" action="<?php echo site_url('cari/master_un/'.$this->uri->segment(3)); ?>">
                                    <table width="500px">
                                        <tr>
                                            <td>No Ujian</td>
                                            <td><input type="text" size="15" id="no_ujian" name="un" class="button" value="<?php echo $this->input->get('un'); ?>" /></td>
                                            <td>&nbsp;Nama</td>
                                            <td><input type="text" size="25" id="nama" name="nama" class="button" value="<?php echo $this->input->get('nama'); ?>" /></td>
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
                        <td>Halaman: <?php echo ($links) ? $links : '<strong>1</strong>'; ?></td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table class="tabeldalamform" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="justify" width="100%" valign="top">
                                        <div id="detail_canvas" style="display: none; position:absolute; overflow:auto; height: 400px; width: 500px; border: solid thin grey; backgroundcolor:white;">
									  Verifikasi goes here
                                        </div>
                                        <div style="text-align:center;overflow:auto;height: 430px">
                                            <?php 
                                            if (count($pendaftar) == 0) 
                                                echo "Tidak ada data."; 
                                            else {
                                            ?>
                                            <table width="100%" id="TablePeserta">
                                                <thead>
                                                    <th>No Ujian</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Sekolah Asal</th>
                                                    <th>NUN</th>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = 0;
                                                    foreach ($pendaftar as $row) { 
                                                    ?> 
                                                    <tr class="trkecil<?php echo $i%2; ?>">
                                                        <td><?php echo anchor('cari/detail_un/'.$row->NO_UJIAN, $row->NO_UJIAN, 'style="color: blue;"'); ?></td>
                                                        <td><?php echo $row->NAMA; ?></td>
                                                        <td><?php echo ($row->JENIS_KEL == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
                                                        <td><?php echo $row->ASAL_SEKOLAH; ?></td>
                                                        <td><?php echo $row->NUN_ASLI; ?></td>
                                                    </tr>
                                                    <?php 
                                                        $i++;
                                                    }
                                                    ?> 
                                                </tbody>
                                            </table>
                                            <?php } ?> 
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
