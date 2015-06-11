<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            Upload file kemudian lakukan update nilai.
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
            <td><h2>Update Nilai</h2></td>
        </tr>
        <tr>
            <td>
                <p>Untuk melakukan pencarian data, masukkan nomor pendaftaran atau nama siswa.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="justify" width="100%" valign="top">
                            <div style="text-align:center;width: 580px;overflow:auto;">
                                <p>Proses update nilai sukses!</p>
                                <p><?php echo anchor('upload', 'Upload file yang lain'); ?></p>
                                
                            </div>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>


</body>
</html>