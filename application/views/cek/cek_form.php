<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            Masukkan No.Ujian kemudian klik cek validasi.
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
            <td><h2><?php //if($status=='') echo ('Cek Validasi Pendaftaran'); else echo $status; ?>Cek Validasi Pendaftaran</h2></td>
        </tr>
        <tr>
            <td>
                <p>Untuk melakukan validasi pendaftaran, masukkan No.Ujian kemudian klik cek.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="center">
                            <h3>&nbsp;</h3>
                            <form class="formbesar" name="form_un" action="cek/kode" method="post">
                                <table class="tabeldalamform" cellpadding="1" cellspacing="2" style="margin-bottom: 5px">
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>Nomor UN :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="NO_UN" name="NO_UN" type="text" size="20" maxlength="20" class="button" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>Jenjang Pilihan :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <select name="TINGKATAN" id="TINGKATAN">
                                                <option value="smp">SMP</option>
                                                <option value="sma">SMA</option>
                                                <option value="smk">SMK</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>Kode Validasi :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="KODE" name="KODE" type="text" size="20" maxlength="20" class="button" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"></td>
                                        <td class="tddfkanan">
                                            <input id="proses" type="submit" name="act" value="Cek Validasi" style="border: solid thin #123412"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            
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