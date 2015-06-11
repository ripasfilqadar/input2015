<div style="text-align: center;">
    <h4>Selamat Bertugas <br /><?php echo $this->session->userdata('NAMA_USER');?><br /><?php echo $this->session->userdata('NAMA_SEKOLAH');?><br /><br /></h4>
</div>
<?php $hak = $this->session->userdata('HAK'); ?> 
<div id="nav">
    <div class="boxnav">
        <ul class="menunav" style="text-align: left;">
            <li class="list"><a href="<?php echo site_url(''); ?>">Home</a></li>
            <li class="list">
                <a href="#">Master UN</a>
                <ul>
                    <?php if ($this->session->userdata('TINGKATAN_SEKOLAH') == 1 || $hak == 'admin') { ?><li><a href="<?php echo site_url('cari/master_un/sd'); ?>">SD</a></li><?php } ?> 
                    <?php if ($this->session->userdata('TINGKATAN_SEKOLAH') != 1 || $hak == 'admin') { ?><li><a href="<?php echo site_url('cari/master_un/smp'); ?>">SMP</a></li><?php } ?> 
                </ul>
            </li>
            <li class="list"><a href="<?php echo site_url('cari'); ?>">Cari Data Terdaftar</a></li>
             <?php
            if (strpos($hak, 'inputrekom') === false) {
            ?> 
            <li class="list"><a href="<?php echo site_url('daftar/baru/1'); ?>">Pendaftaran Peserta <?php echo date("Y"); ?>/<?php echo date("Y")+1; ?></a></li>
            <?php } ?> 
            <?php
            if (strpos($hak, 'inputrekom') !== false || $hak == 'admin') {
            ?> 
            <li class="list">
                <a href="<?php echo site_url('daftar/lalu/1'); ?>">Pendaftaran Peserta Tahun Lalu</a>
            </li>
            <li class="list">
                <a href="<?php echo site_url('daftar/rekom/1'); ?>">Pendaftaran Peserta Rekomendasi</a>
            </li>
            <?php } ?> 
            
            <li class="list">
                <!-- <a href="<?php echo site_url(($hak == 'admin') ? 'cari/peserta_pendaftar/smp/x' : 'cari/peserta_pendaftar/x'); ?>">Lihat Data</a> -->
            </li>
            
            <li class="list">
                <a href="<?php echo site_url(($hak == 'admin') ? 'cari/semua_peserta/smp/x' : 'cari/semua_peserta/x'); ?>">Lihat Berkas Pendaftar</a>
            </li>

            <li class="list">
                <a href="<?php echo site_url('rekap/'); ?>">Cetak laporan pendaftaran harian</a>
            </li>
           
            <?php
            if ($hak == 'admin') {
            ?> 
            <li class="list">
                <a href="<?php echo site_url('upload/'); ?>">Upload nilai</a>
            </li>
            
            <li class="list">
                <a href="<?php echo site_url('cek/'); ?>">Cek validasi pendaftaran</a>
            </li>
            
            <li class="list">
                <a href="#">User</a>
                <ul>
                    <?php if ($hak == 'admin') { ?><li><a href="<?php echo site_url('user/tingkatan'); ?>">Tambah</a></li><?php } ?> 
                    <?php if ($hak == 'admin') { ?><li><a href="<?php echo site_url('user/cari'); ?>">Cari</a></li><?php } ?> 
                </ul>
            </li>
            
            <?php } ?>
<!--            <li class="list"><a href="">Backup Data</a></li>-->
            <li class="list"><a href="<?php echo site_url('home/logout'); ?>">Logout</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>