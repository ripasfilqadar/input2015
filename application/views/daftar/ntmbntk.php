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
            <td><h2>Input NTMB dan NTK</h2></td>
        </tr>
        <tr>
            <td>
                <?php echo form_open("daftar/ntmbntk/$NO_UJIAN"); ?> 
                <input type="hidden" name="no_ujian" value="<?php echo $NO_UJIAN; ?>" />
                <input type="hidden" name="nilai_akhir" value="<?php echo $NUN_ASLI; ?>" />
                <table>
                    <?php
                    $errors = validation_errors('<span>', '</span><br />');
                    if ($errors) {
                    ?>
                    <tr>
                        <td colspan="2"><p class="error"><?php echo $errors; ?></p></td>
                    </tr>
                    <?php } ?> 
                    <tr>
                        <td>No Ujian:</td>
                        <td><?php echo $NO_UJIAN; ?></td>
                    </tr>
                    <tr>
                        <td>Nama:</td>
                        <td><?php echo $NAMA; ?></td>
                    </tr>
                    <tr>
                        <td>Nilai Psikotes (NTMB):</td>
                        <td><input type="text" name="ntmb" value="<?php echo set_value('ntmb', $NTMB); ?>" /></td>
                    </tr>
                    <tr>
                        <td>Nilai Wawancara (NTK):</td>
                        <td><input type="text" name="ntk" value="<?php echo set_value('ntk', $NTK); ?>" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Simpan" onclick="return confirm('Anda yakin data yang sudah diisikan benar?');" /> 
                            <?php echo "<a href=".site_url('cari/detail/smk').'/'.$NO_UJIAN."><button>Kembali</button></a>"; ?>
                            <!-- <?php //echo anchor("cari/detail/smk/$NO_UJIAN", 'Kembali', 'style="color:blue;"') ?> --> 
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?> 
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>