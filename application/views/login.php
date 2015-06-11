<?php $this->load->view('base/header', array('namePage' => "Login"));?>
<div id="sidebar">
    <form method="post" action="<?php echo site_url("home/login");?>">
        <table>
            <tr>
                <td colspan="3">
                    <?php
                    if($this->session->flashdata('error') || $errors)
                        echo '<p class="error">'.$this->session->flashdata('error').$errors.'</p>';
                    ?>
                    <!-- <p style="background-color:#C4EFBF; border:1px solid #66CE5B; display:block; text-align:center; margin:14px 0 14px 0; padding:12px 10px 12px 10px;">Data peserta lulus seleksi dapat diunduh dihalaman utama dengan login terlebih dahulu menggunakan user dan password yang digunakan untuk input data</p> -->
                    <p style="background-color:#C4EFBF; border:1px solid #66CE5B; display:block; text-align:center; margin:14px 0 14px 0; padding:12px 10px 12px 10px;">Selamat Datang Tim Entry Data <b>PPDB Sidoarjo 2015</b>, <?php echo date("d"); ?> Juni  <?php echo date("Y"); ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    Username
                </td>
                <td>
                    :
                </td>
                <td>
                    <input id="nama_user" name="nama_user" type="text" size="20" />
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    :
                </td>
                <td>
                    <input id="passwd" name="passwd" type="password" size="20" />
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input id="tampil_pendaftar" type="submit" value="Login" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer');?>
