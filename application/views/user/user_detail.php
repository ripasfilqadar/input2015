<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?> 
</div>

<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Detail Pendaftar</h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                        <td class="style2">Sekolah</td>
                        <td>:</td>
                        <td><?php echo 'asd'; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Username</td>
                        <td>:</td>
                        <td><?php echo 'asd2'; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Hak</td>
                        <td>:</td>
                        <td><?php echo 'asd3'; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nama Lengkap/td>
                        <td>:</td>
                        <td><?php echo 'asd4'; ?></td>
                    </tr>
                    <tr>
                        <td class="style2">Nomor Telepon</td>
                        <td>:</td>
                        <td><?php echo 'asd5' ?></td>
                    </tr>
                </table>
                
                <?php echo ($this->session->userdata('HAK') == 'admin') ? anchor('user/cari', 'Edit', 'style="color: blue;"') : ''; ?> 
                
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer')?>
