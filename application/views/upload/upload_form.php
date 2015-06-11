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
                <p>Untuk melakukan update nilai, upload file nilai.csv kemudian klik update.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="center">
                            <h3>UPLOAD FILE</h3>
                            
                                <table class="tabeldalamform" cellpadding="1" cellspacing="2" style="margin-bottom: 5px">
                                    <tr>
                                        <td colspan="2" id="error">
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <?php echo $error;?>
                                            <?php echo form_open_multipart('upload/do_upload');?>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <input type="file" name="userfile" size="20" />
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <input type="submit" value="upload" />
                                        </td>
                                    </tr>
                                </table>
                                <span style="color:#666; font-size: 12px">*file yang diupload harus berformat <strong>.csv</strong></span>
                           
                        </td>
                    </tr>
                    <tr><td colspan="2"><br /></td></tr>
                </table>
                              
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