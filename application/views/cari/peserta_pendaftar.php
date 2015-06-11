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
            <td><h2>List Pendaftaran <?php echo $nama_sekolah; ?></h2></td>
        </tr>
        <tr>
            <td>
                <p>Untuk melakukan pencarian data, masukkan nomor pendaftaran atau nama siswa.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="justify" width="100%" valign="top">
                            <div style="text-align:center;width: 580px;overflow:auto;">
                                <form method="get" action="<?php echo site_url('cari'); ?>">
                                    <table width="500px">
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
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
                        <td align="justify">
                            <div style="margin:10px 0 0 15px;">
                                Berikut ini adalah data pendaftar yang masuk ke aplikasi PPDB Sidoarjo <?php echo date("Y"); ?> Online.
                            </div>
                        </td>
                    </tr>
                    <?php if ($this->session->userdata('HAK') == 'admin') { ?> 
                    <tr>
                        <td>
                            <div style="margin:10px 0 0 15px;">
                            Jenjang: <?php echo ($tingkatan != 'smp') ? anchor('cari/semua_peserta/smp/x', 'SMP') : 'SMP'; ?> <?php echo ($tingkatan != 'sma') ? anchor('cari/semua_peserta/sma/x', 'SMA'): 'SMA'; ?> <?php echo ($tingkatan != 'smk') ? anchor('cari/semua_peserta/smk/x', 'SMK'): 'SMK'; ?> 
                            </div>
                        </td>
                    </tr>
                    <?php } ?> 
                    <?php if ($tingkatan == 'smk') { ?> 
                    <tr>
                        <td>
                            <div style="margin:10px 0 0 15px;">
                            Jurusan:<br />
                            <?php
                            foreach($sekolah as $row) {
                                echo (($this->uri->segment(4) == $row->ID_SEKOLAH) ? ((strpos($this->session->userdata('HAK'), 'inputrekom') !== false || $this->session->userdata('HAK') == 'admin') ? $row->NAMA_SEKOLAH.' - ' : '').$row->JURUSAN : anchor('cari/peserta_pendaftar/x/'.$row->ID_SEKOLAH, ((strpos($this->session->userdata('HAK'), 'inputrekom') !== false || $this->session->userdata('HAK') == 'admin') ? $row->NAMA_SEKOLAH.' - ' : '').$row->JURUSAN))."<br />\r\n";    
                            }
                            ?> 
                            </div>
                        </td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <td>
                            <div style="margin:10px 0 0 15px;">
                            Halaman: <?php echo (($pages = $this->pagination->create_links())) ? $pages : '<strong>1</strong>'; ?>
                            </div>
                        </td>
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
                                                echo "Belum ada pendaftar"; 
                                            else {
                                            ?>
                                            <table width="100%" id="TablePeserta">
                                                <thead>
                                                    <th>No Urut</th>
                                                    <th>No Ujian</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Sekolah Asal</th>
                                                    <th>Tgl Daftar</th>
                                                    <th>Pilihan</th>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $i = intval($this->uri->segment(5));
                                                    if (!$i) $i = 1;
                                                    else $i++;
                                                    foreach ($pendaftar as $row) { 
                                                    ?> 
                                                    <tr class="trkecil<?php echo $i%2; ?>">
                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                        <a href=" <?php echo site_url('cari/detail/'.$tingkatan.'/'.$row->NO_UJIAN); ?>"><?php echo $row->NO_UJIAN; ?></a>
                                                        <?php //echo anchor('cari/detail/'.$tingkatan.'/'.$row->NO_UJIAN, $row->NO_UJIAN, 'style="color: blue;"'); ?></td>
                                                        <td><?php echo $row->NAMA; ?></td>
                                                        <td><?php echo $row->ASAL_SEKOLAH; ?></td>
                                                        <td><?php echo $row->WAKTU_DAFTAR; ?></td>
                                                        <td><?php echo '1. '.(($tingkatan == 'smk') ? $sekolah[$row->PILIH1]->JURUSAN : $sekolah[$row->PILIH1]->NAMA_SEKOLAH).(($row->PILIH2) ? (($tingkatan == 'smk') ? '<br />2. '.$sekolah[$row->PILIH2]->JURUSAN : '<br />2. '.$sekolah[$row->PILIH2]->NAMA_SEKOLAH) : ''); ?></td>
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
		      <tr>
				<td>
					<form method="POST" action="<?php echo site_url('pdf/cetak_nkem/'.$tingkatan)?>">

					<table>
						<tr>
							<td><b>Cetak Bukti Pendaftaran</b></td>
						</tr>
						<tr>
							<td>
								dari no.urut : <select name = "mulai">
								<?php
									for($i=1; $i<=$jumlah; $i++){
										echo "<option value =".$i.">".$i."</option>";
										
									}
								?>
								</select>
							</td>
							<td>
								hingga no.urut : <select name = "akhir">
								<?php
									for($i=1; $i<=$jumlah; $i++){
										echo "<option value =".$i.">".$i."</option>";
																			}
								?>
								</select>
							</td>
							<td>
								<input type="submit" class="dbtn" name="print" value="Cetak"  />

							</td>
						</tr>
					</table>
					</form>
				</td>
		      </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
