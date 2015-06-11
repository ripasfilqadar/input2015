<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<script type="text/javascript">
    function __doPostBack(elm) {
        var val = elm.options[elm.selectedIndex].value;
        if(val.indexOf("rekom") !== -1)
        {
            document.form_buat.SEKOLAH.disabled = true;
            //window.alert(val + ' ' + val.indexOf("Rekomendasi"));
        }
        else
        {
            document.form_buat.SEKOLAH.disabled = false;
        }
    }
    
</script>
<script src="js/jquery.js" type="text/javascript"></script>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            Untuk melakukan pendaftaran user, pilih tingkatan, kemudian isi informasi sesuai form.
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
            <td><h2><?php //if($status=='') echo ('Cek Validasi Pendaftaran'); else echo $status; ?>Pendaftaran User Aplikasi</h2></td>
        </tr>
        <tr>
            <td>
                <p>Untuk melakukan pendaftaran user, pilih tingkatan, kemudian isi informasi sesuai form.</p>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="center">
                            <h3>&nbsp;</h3>
                            <form class="formbesar" name="form_buat" action="buat" method="post">
                                <table class="tabeldalamform" cellpadding="1" cellspacing="2" style="margin-bottom: 5px">
                                     <!--<tr>
                                        <td class="tddfkiri">
                                            <label>Tingkatan :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <select name="TINGKATAN" id="TINGKATAN" >
                                                <option value="smp">SMP</option>
                                                <option value="sma">SMA</option>
                                                <option value="smk">SMK</option>
                                            </select>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>Sekolah :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <select name="SEKOLAH" id="SEKOLAH">
                                            <?php 
                                            foreach($sekolah as $item)
                                            {
                                                echo ($item->NO_TINGKATAN == $tingkatan) ? '<option value="'.$item->ID_SEKOLAH.'">'
                                                .$item->NAMA_SEKOLAH
                                                .'</option>' : '';
                                            } 
                                            ?>
                                            </select>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td class="tddfkiri">
                                            <label>Nama Lengkap Pengguna :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="NAMA" name="NAMA" type="text" size="20" maxlength="20" class="button" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>No. Telp Pengguna :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="TELP" name="TELP" type="text" size="20" maxlength="20" class="button" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>Hak :</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <select name="HAK" id="HAK" onchange="__doPostBack(this)">
                                                <?php 
                                                    if($tingkatan == '2') { echo
                                                    '<option value="inputsma">'
                                                    .'Input SMA Reguler'
                                                    .'</option>'
                                                    .'<option value="inputrekomsma">'
                                                    .'Input SMA Rekomendasi'
                                                    .'</option>'; }
                                                        
                                                    else if($tingkatan == '1') { echo
                                                    '<option value="inputsmp">'
                                                    .'Input SMP Reguler'
                                                    .'</option>'
                                                    .'<option value="inputrekomsmp">'
                                                    .'Input SMP Rekomendasi'
                                                    .'</option>'; }
                                                    
                                                    else { echo
                                                    '<option value="inputsmk">'
                                                    .'Input SMK Reguler'
                                                    .'</option>'
                                                    .'<option value="inputrekomsmk">'
                                                    .'Input SMK Rekomendasi'
                                                    .'</option>'; }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"></td>
                                        <td class="tddfkanan">
                                            <input id="proses" type="submit" name="act" value="Buat User" style="border: solid thin #123412"/>
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