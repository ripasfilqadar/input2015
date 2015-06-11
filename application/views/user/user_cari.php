<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

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
<!-- CONTENT --><div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Cari data user</h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="justify">
                            <div style="margin:10px 0 0 15px;">
                                Untuk melakukan pendaftaran user, pilih tingkatan, kemudian isi informasi sesuai form.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center">
                            <form class="formbesar" name="form_un" action="<?php echo site_url('user/cari'); ?>" method="get">
                                                           
                                <table class="tabeldalamform" cellpadding="1" cellspacing="2">
                                    <tr>
                                        <td class="tddfkiri">
                                            <label>User Name</label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="USER" name="user" type="text" size="20" maxlength="20" class="button" value="<?php echo $this->input->get('user') ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"></td>
                                        <td class="tddfkanan">
                                            <input id="proses" type="submit" name="act" value="Cari" style="border: solid thin #123412"/>
                                        </td>
                                    </tr>
                                </table>
                                <?php 
                                    if ($status=='kosong') 
                                        echo "Username tidak ditemukan ".$status; 
                                    else {
                                        //echo 'test12'.$status; 
                                    ?>
                                <table>
                                    <th>
                                        Data User
                                    </th>
                                    <tr>
                                        <td>
                                            <table class="tabeldalambesar" border="0" cellspacing="5" cellpadding="0" style="vertical-align: top;">
                                                <tr>
                                                    <td class="style2">Sekolah</td>
                                                    <td>:</td>
                                                    <td><?php echo $SEKOLAH; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="style2">Nama Lengkap</td>
                                                    <td>:</td>
                                                    <td><?php echo $NAMALENGKAP; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="style2">No. Telepon</td>
                                                    <td>:</td>
                                                    <td><?php echo $KETERANGAN; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="style2">Hak</td>
                                                    <td>:</td>
                                                    <td><?php echo $hak; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="style2">Username</td>
                                                    <td>:</td>
                                                    <td><?php echo $NAMAUSER; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                    <?php }              ?>
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
