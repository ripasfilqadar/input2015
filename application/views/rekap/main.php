<?php $this->load->view('base/header', array('namePage' => "Rekap Pendaftaran"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?>
    <?php $this->load->view('base/sidebar_last_entry');?> 
    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            <ul class="menunav" style="text-align: left;">
                <li>Pilih Tanggal Rekap Pendaftaran</li>
                <li>Tekan Download</li>
                <li>Pastikan Komputer anda sudah terinstal pdf reader/foxit</li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

<!--kontent-->
<!-- CONTENT -->
<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Rekap Harian Pendaftaran PPDB Online di <?php echo $nama_sekolah ?>  </h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;" style="padding-top:10px">
                    <tr>
                        <td align="center">
                            <h3>DOWNLOAD REKAP PENDAFTARAN VERSI PDF</h3>
                            
                            <form class="formbesar" action="<?php echo site_url('/print_rekap/rekappdf'); ?>" id="form_un" method="post">
                                <table class="tabeldalamform" cellpadding="1" cellspacing="2" style="margin-bottom: 5px">
                                    <tr>
                                        <td colspan="2" id="error">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>Tanggal Daftar :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <select name="tanggal"  id="jenjang_pilihan" >
                                                 <?php $i=0; foreach($tanggal->result() as $r) : ?>
                                                <option  value="<?php echo $r->WAKTU_DAFTAR; ?>">
                                                    <?php 
                                                        $date_= $r->WAKTU_DAFTAR;
                                                        // $date_= "27/03/1992";
                                                        $time_ = explode('-', $date_);
                                                        echo $time_[2]."-".$time_[1]."-".$time_[0];
                                                    ?>
                                                </option>
                                                 <?php endforeach; ?>
                                                <option value="semua">semua</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"></td>
                                        <td class="tddfkanan">
                                            <input id="proses" type="submit" name="act" value="Download PDF" style="border: solid thin #123412"<?php echo (count($tanggal) == 0) ? ' disabled="disabled"' : ''; ?> />
                                        </td>
                                    </tr>
                                </table>
                                <span style="color:#666; font-size: 12px">*Pastikan komputer anda terinstal <strong>pdf reader/foxit reader</strong></span>
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
<?php $this->load->view('base/footer');?>
