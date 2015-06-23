<?php $this->load->view('base/header', array('namePage' => "Home"));?>



<div id="sidebar">
    

    <?php $this->load->view('base/sidebar_menu');?>
</div>
<!-- CONTENT -->
<div style="float:left;">
    <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Selamat Datang </h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="90%">
                    <?php 
                    // echo "<div style='background-color:#2ecc71; border:1px solid #66CE5B; display:block; text-align:center;width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px; color:white;'> Data Siswa diterima dapat didownload  <a  href=".base_url()."dataditerima/".str_replace(" ","%20",$this->session->userdata('NAMA_SEKOLAH')).".csv>"."<span style='font-style:italic; font-weight:bold;font-size:16px;'>disini</span> </a> </div>"; ?>

                    <?php
                        // if(substr($tingkatan,0,3)=='smk') 
                        // echo "<div class='blink' style='background-color:#2ecc71; border:1px solid #66CE5B; display:block; text-align:center;width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px; color:white;'> Form pengisian NTMB dan NTK untuk SMK dapat diunduh <a href=".base_url()."format/".str_replace(" ","%20",$this->session->userdata('NAMA_SEKOLAH')).".xlsx>". "<span style='font-style:italic; font-weight:bold;font-size:16px;'>disini</span> </a> </div>";
                    ?>

                    <?php 
                        // if(substr($tingkatan,0,3)=='smp')echo  "<p style='background-color:yellow; border:1px solid #66CE5B; display:block; text-align:center; width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px;'>Petugas Input Data Pendaftaran SMP diwajibkan melakukan pengecekan Nilai Sekolah Bahasa Indonesia, Matematika, dan IPA yang tertera pada SKL/SKHUN dan Rata-Rata Nilai Rapor Bahasa Indonesia, Matematika, dan IPA </p>"; 
                        if(substr($tingkatan,0,3)=='smp')echo  "<div class='blink' style='background-color:yellow; border:1px solid #66CE5B; display:block; text-align:center; width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px; ><p  style='background-color:yellow; border:1px solid #66CE5B; display:block; text-align:center; width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px; '>Apabila ada nilai rata-rata rapor yang <b>kosong</b> atau <b>tidak sesuai</b> dengan SKL, mohon diinputkan sesuai dengan nilai yang tertera pada SKL/SKHU</p></div>";
                    ?>
                    <?php 
                    // if(substr($tingkatan,0,3)=='smp') echo "<img src=".base_url()."images/SKHUN.jpg   "; ?>
		<p  style='background-color:yellow; border:1px solid #66CE5B; display:block; text-align:center; width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px; '>Tidak ada pencabutan berkas saat data telah dimasukkan ke database</p>

                    <tr>
                        <td align="justify"><div style="margin-left:12 ; padding:10px ; margin-right:12;">Aplikasi PPDB Sidoarjo <?php echo date("Y"); ?> Online ini digunakan untuk memproses data penerimaan siswa baru yang berasal dari Kab. Sidoarjo yang akan melanjutkan sekolah pada jenjang SMPN, SMAN dan SMKN di Kab. Sidoarjo.<br>
                                Prosedur pengisian dan alur data akan dijelaskan sebagai berikut :<br>
                                <ol>
                                    <li>Siswa, Orang Tua Siswa atau Wali Murid mengambil formulir pendaftaran Penerimaan Siswa Baru di tempat yang telah ditentukan (SMPN, SMAN, dan SMKN).</li>
                                    <li>Siswa, Orang Tua Siswa atau Wali Murid mengisi formulir dan melengkapi formulir tersebut dengan berkas-berkas yang diperlukan kemudian dimasukkan ke dalam map.</li>
                                    <li>Siswa, Orang Tua Siswa atau Wali Murid mengembalikan map yang berisi formulir yang sudah terisi beserta berkas-berkas pelengkap ke loket yang telah ditentukan.</li>
                                    <li>Petugas cek fisik memastikan data yang telah diisi dengan berkas-berkas pelengkap di dalam map sudah sama. </li>
                                    <ol type="a">
                                        <li>Map dengan formulir pendataran yang tidak valid dikembalikan.</li>
                                        <li>Sedangkan map dengan formulir pendaftaran yang valid ditumpuk dan diberi kode petugas cek fisik untuk kemudian diserahkan ke petugas entri data.</li>
                                    </ol>
                                    <li>Petugas entri data memeriksa ulang map beserta kelengkapannya.</li>
                                    <ol type="a" >
                                        <li>Map dengan formulir yang tidak lulus pemeriksaan ulang akan dikembalikan ke petugas cek fisik.</li>
                                        <li>Sedangkan map dengan formulir yang lulus pemeriksaan ulang langsung dimasukkan datanya ke server oleh petugas entri data.</li>
                                    </ol>
                                    <li>Map yang datanya sudah dimasukkan dikumpulkan untuk diserahkan ke petugas verifikasi.</li>
                                    <li>Petugas verifikasi memeriksa kesamaan data yang dimasukkan ke server dengan map.</li>
                                    <ol type="a">
                                        <li>Jika terdapat kesalahan pengisian data maka data akan diperbaiki melalui halaman Edit Pendaftar.</li>
                                        <li>Jika pengisian data sudah benar maka data akan divalidasi oleh Petugas verifikasi melalui Halaman Verifikasi.</li>
                                    </ol>
                                    <li>Data yang telah valid akan dikirim ke server pusat untuk diupload ke website PPDB.</li>
                                </ol>

                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<?php $this->load->view('base/footer');?>
