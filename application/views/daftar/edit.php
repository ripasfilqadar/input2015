<?php $this->load->view('base/header', array('namePage' => "Daftar Siswa Baru"));?>

<script type="text/javascript" src="<?php echo base_url();?>js/validate.js"></script>
<script type="text/javascript">
    function cancelForm() {
        window.location = '<?php echo site_url(($this->uri->segment(3) == '1') ? '' : 'daftar/'.$this->uri->segment(2).'/1'); ?>';
    }
    
    function test($temp) {
        //alert('masuk ' . $temp);
        switch ($temp) {
        case '1':
//            alert('One');
            //$dis.attr("disabled", "enabled");
            document.form1.kota.disabled = true;
            document.form1.kota.value = "SIDOARJO";
            document.getElementById('warning').innerHTML="";
//            document.form1.kota.value = "";
            break;
        case '2':
            //alert('Two');
            //$dis.attr("disabled", "disabled");
            document.form1.kota.disabled = false;
            document.form1.kota.value = "";
            document.getElementById('warning').innerHTML= "Peringatan: Anda akan terkena 10%";
            document.getElementById('warning').style.color="red";
            break;
        }
    }
   
    
   
    window.onload = function() {
        var len = <?php echo ($this->uri->segment(2) == 'baru') ? '9' : '14'; ?>;
        var validator_un = new FormValidator(
            'form_un',
            [{
                name: 'no_un',
                display: 'Nomor Ujian',
                rules: 'required|min_length['+len+']|numeric'
            }],
            function(errors, events) {
                if (errors.length > 0)
                    document.getElementById('error').innerHTML = '<p class="error">'+errors.join('<br />')+'</p>';
            }
        );
        validator_un.setMessage('required', '%s harus diisi.');
        validator_un.setMessage('min_length', '%s harus berisi %s karakter.');
        validator_un.setMessage('max_length', '%s harus berisi %s karakter.');
        validator_un.setMessage('numeric', '%s harus berisi karakter angka.');
        
        <?php if (isset($pendaftar)) { ?> 
        
        var validator_pendaftar = new FormValidator(
            'form_pendaftar',
            [<?php if($tingkatan=='smp') { ?>
            {
                name: 'nilai_bind',
                display: 'Nilai Bahasa Indonesia',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, {
                name: 'nilai_mat',
                display: 'Nilai Matematika',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, {
                name: 'nilai_ipa',
                display: 'Nilai IPA',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            },
            <?php } ?>
            <?php if ($this->uri->segment(2) != 'baru') { ?>
            {
                name: 'nama',
                display: 'Nama',
                rules: 'required'
            },{
                name: 'tahun_lulus',
                display: 'Tahun Lulus',
                rules: 'required'
            }, {
                name: 'jenis_kel',
                display: 'Jenis Kelamin',
                rules: 'required'
            }, {
                name: 'tmp_lahir',
                display: 'Tempat Lahir',
                rules: 'required'
            }, {
                name: 'alamat',
                display: 'Alamat',
                rules: 'required'
            }, {
                name: 'kota',
                display: 'Kota',
                rules: 'required'
            }, {
                name: 'nama_ortu',
                display: 'Nama Orang Tua',
                rules: 'required'
            }, {
                name: 'asal_sekolah',
                display: 'Asal Sekolah',
                rules: 'required'
            }, <?php if ($this->session->userdata('HAK') != 'inputrekom') { ?>
            {
                name: 'domisili',
                display: 'Domisili',
                rules: 'required'
            }, <?php } ?>{
                name: 'kota_asal_sekolah',
                display: 'Kota Asal Sekolah',
                rules: 'required'
            }, <?php if ($tingkatan != 'smp') { ?>
            {
                name: 'nilai_bing',
                display: 'Nilai Bahasa Inggris',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, <?php } ?>{
                name: 'nilai_bind',
                display: 'Nilai Bahasa Indonesia',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, {
                name: 'nilai_mat',
                display: 'Nilai Matematika',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, {
                name: 'nilai_ipa',
                display: 'Nilai IPA',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, <?php if ($tingkatan == 'smp') { ?>
            {
                name: 'nilai_bind2',
                display: 'Nilai Bahasa Indonesia',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, {
                name: 'nilai_mat2',
                display: 'Nilai Matematika',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            }, {
                name: 'nilai_ipa2',
                display: 'Nilai IPA',
                rules: 'required|decimal|callback_greater_than_equals[0]|callback_less_than_equals[10]'
            },  <?php } ?>
            <?php } ?><?php if (false) { ?>{
                name: 'ntmb',
                display: 'NTMB',
                rules: 'required|decimal|callback_greater_than_equals[10]|callback_less_than_equals[100]'
            }, {
                name: 'ntk',
                display: 'NTK',
                rules: 'required|decimal|callback_greater_than_equals[10]|callback_less_than_equals[100]'
            }, <?php } ?>{
                name: 'pilih1',
                display: 'Pilihan 1',
                rules: 'required'
            }],
            function(errors, events) {
                if (errors.length > 0)
                    document.getElementById('error').innerHTML = '<p class="error">'+errors.join('<br />')+'</p>';
            }
        );
        validator_pendaftar.setMessage('required', '%s harus diisi.');
        validator_pendaftar.setMessage('min_length', '%s harus berisi %s karakter.');
        validator_pendaftar.setMessage('max_length', '%s harus berisi %s karakter.');
        validator_pendaftar.setMessage('numeric', '%s harus berisi karakter angka.');
        validator_pendaftar.setMessage('decimal', '%s harus berupa pecahan desimal dengan separator \'titik\', misal 8.75.');
        validator_pendaftar.registerCallback('greater_than_equals', function(value, param) {
            return parseFloat(value) >= parseFloat(param);
        }).setMessage('greater_than_equals', '%s tidak boleh kurang dari %s.');
        validator_pendaftar.registerCallback('less_than_equals', function(value, param) {
            return parseFloat(value) <= parseFloat(param);
        }).setMessage('less_than_equals', '%s tidak boleh lebih dari %s.');
        validator_pendaftar.registerCallback('valid_date', function(value) {
            var dateRegex = /^(0[0-9]|[12][0-9]|3[01])\/(0[0-9]|1[012])\/(19|20|00)\d\d/;
            return dateRegex.test(value);
        }).setMessage('valid_date', '%s harus ditulis dengan format dd/mm/yyyy.');
        <?php } ?>
	
	    bind = document.getElementById('nilai_bind').value;
        ipa = document.getElementById('nilai_ipa').value;
        mat = document.getElementById('nilai_mat').value;
        akhir = document.getElementById('nun_asli').value;

        bind2=document.getElementById('nilai_bind2').value;
        document.getElementById('nilai_bind2_hidden').value=bind2;
        ipa2=document.getElementById('nilai_ipa2').value;
        document.getElementById('nilai_ipa2_hidden').value=ipa2;
        mat2=document.getElementById('nilai_mat2').value;
        document.getElementById('nilai_mat2_hidden').value=mat2;
        
        document.getElementById('nrap_asli').value=parseFloat(bind2)+parseFloat(ipa2)+parseFloat(mat2);

        akhir2 = document.getElementById('nrap_asli').value

        document.getElementById('nilai_bind3').value=parseFloat(bind2)*0.7 + parseFloat(bind)*0.3 ;
        document.getElementById('nilai_mat3').value=parseFloat(mat2)*0.7 + parseFloat(mat)*0.3;
        document.getElementById('nilai_ipa3').value=parseFloat(ipa2)*0.7 + parseFloat(ipa)*0.3;
        document.getElementById('nakhir_asli').value=parseFloat(akhir2)*0.7 + parseFloat(akhir)*0.3;
 
    }
</script>


<div id="sidebar">
    <?php $this->load->view('base/sidebar_menu');?>
    <?php $this->load->view('base/sidebar_last_entry');?>

    <div id="nav">
        <div class="boxnav">
            <h3 class="titlenav">Prosedur</h3>
            <ul class="menunav" style="text-align: left;">
                <li>Isi Nomor Ujian</li>
                <li>Pilih jenjang sekolah</li>
                <li>Tekan tombol Proses</li>
                <li>Lengkapi data</li>
                <li>Pilih Sekolah</li>
                <li>Klik tombol Simpan
                    
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div style="float:left;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><h2>Pendaftaran Siswa <?php  echo ($this->uri->segment(2) == 'baru') ? "baru" : (($this->uri->segment(2) == 'lalu') ? "tahun lalu" : "rekom" ); ?></h2></td>
        </tr>
        <tr>
            <td>
                <table class="tabeldalambesar" cellpadding="0" cellspacing="0" width="580px;">
                    <tr>
                        <td align="justify">
                            <div style="margin:10px 0 0 15px;">
                                Periksa dahulu map beserta kelengkapannya baru kemudian data dimasukkan.
                                <br />Pastikan data yang dimasukkan sudah benar.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center">
                            <form class="formbesar" name="form_un" action="<?php echo site_url('daftar/'.$this->uri->segment(2).'/1'); ?>" method="post">
                                <input id="ID_SEKOLAH" name="cek_fisik" type="hidden" class="button" value="<?php echo $this->session->userdata('ID_SEKOLAH');?>"/>
                                <input id="NAMA_SEKOLAH" name="cek_fisik" type="hidden" size="20" maxlength="10" class="button" value="<?php echo $this->session->userdata('NAMA_SEKOLAH');?>"/>
                                <input id="NAMAUSER" type="hidden" name="cek_fisik" size="20" maxlength="10"  class="button" value="<?php echo $this->session->userdata('NAMA_USER');?>"/>

                                <!-- Start Input (No Ujian)-->                                
                                <table class="tabeldalamform" cellpadding="1" cellspacing="2">
                                    <tr>
                                        <td colspan="2" id="error">
                                            <?php
                                            if($this->session->flashdata('error'))
                                                echo '<p class="error">'.$this->session->flashdata('error').'</p>';
                                            if (isset($errors) && $errors)
                                                echo '<p class="error" >'.$errors.'</p>';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php if($tingkatan=='smp')echo  "<p style='background-color:yellow; border:1px solid #66CE5B; display:block; text-align:center; width:92%; margin:14px 0 14px 0; padding:12px 10px 12px 10px;'>Petugas Input Data Pendaftaran SMP diwajibkan melakukan pengecekan Nilai Sekolah Bahasa Indonesia, Matematika, dan IPA yang tertera pada SKL/SKHUN dan Rata-Rata Nilai Rapor Bahasa Indonesia, Matematika, dan IPA </p>"; ?>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label><?php echo $_noun ?></label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="NO_UN" name="no_un" type="text" size="20" maxlength="20" class="button" value="<?php echo $no_un; ?>" <?php echo ($this->uri->segment(3) == 2) ? 'disabled="disabled" ' : ''; ?>/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label><?php echo $_jenjang ?> <?php //echo $this->session->userdata('TINGKATAN_SEKOLAH'); ?></label>
                                        </td>
                                        <td class="tddfkanan">
                                            <select name="tingkatan" id="jenjang_pilihan"<?php echo ($this->uri->segment(3) == 2) ? ' disabled="disabled"' : ''; ?>>
                                                <?php if ((strpos($this->session->userdata('HAK'), 'inputrekom') === false && $this->session->userdata('TINGKATAN_SEKOLAH') == '1') || $this->session->userdata('HAK') == 'inputrekomsmp') { ?> 
                                                <option value="smp"<?php echo ($tingkatan == 'smp') ? ' selected="selected"' : '' ?>>SMP</option>
                                                <?php } if ((strpos($this->session->userdata('HAK'), 'inputrekom') === false && $this->session->userdata('TINGKATAN_SEKOLAH') == '2') || $this->session->userdata('HAK') == 'inputrekomsma') { ?> 
                                                <option value="sma"<?php echo ($tingkatan == 'sma') ? ' selected="selected"' : '' ?>>SMA</option>
                                                <?php } if ((strpos($this->session->userdata('HAK'), 'inputrekom') === false && $this->session->userdata('TINGKATAN_SEKOLAH') == '3') || $this->session->userdata('HAK') == 'inputrekomsmk') { ?> 
                                                <option value="smk"<?php echo ($tingkatan == 'smk') ? ' selected="selected"' : '' ?>>SMK</option>
                                                <?php } ?> 
                                                <?php if($this->session->userdata('HAK')=='admin'){ ?>
                                                    <option value="smp"<?php echo ($tingkatan == 'smp') ? ' selected="selected"' : '' ?>>SMP</option>    
                                                    <option value="sma"<?php echo ($tingkatan == 'sma') ? ' selected="selected"' : '' ?>>SMA</option>
                                                    <option value="smk"<?php echo ($tingkatan == 'smk') ? ' selected="selected"' : '' ?>>SMK</option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"></td>
                                        <td class="tddfkanan">
                                            <input id="proses" type="submit" name="act" value="Proses" style="border: solid thin #123412" <?php echo ($this->uri->segment(3) == 2) ? 'disabled="disabled" ' : ''; ?>/>
                                            <input id="batal_proses" type="button" name="act" value="Batal" style="border: solid thin #123412;" <?php echo ($this->uri->segment(3) == 2) ? 'disabled="disabled" ' : ''; ?> onclick="cancelForm();" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <!-- Start Input (Pilihan) -->
                            <?php if ($this->uri->segment(3) == 2 && !isset($terdaftar)) { ?> 
                            <form name="form1" class="formbesar" action="<?php echo site_url('daftar/'.$this->uri->segment(2).'/2'); ?>" id="form_pendaftar" name="form1" method="post">
                                <?php if ($this->uri->segment(2) == 'baru') { ?> 
                                <input type="hidden" name="nama1" value="<?php echo $pendaftar->NAMA; ?>" />
                                <input type="hidden" name="tahun_lulus1" value="<?php echo date("Y")-1; ?>/<?php echo date("Y")-0; ?>" />   <!-- tahun edit -->
                                <input type="hidden" name="jenis_kel1" value="<?php echo $pendaftar->JENIS_KEL; ?>" />
                                <input type="hidden" name="tmp_lahir1" value="<?php echo $pendaftar->TMP_LAHIR; ?>" />
                                <input type="hidden" name="tgl_lahir1" value="<?php echo $pendaftar->TGL_LAHIR; ?>" />
                                <input type="hidden" name="alamat1" value="<?php echo $pendaftar->ALAMAT; ?>" />
                                <input type="hidden" name="kota1" value="<?php echo $pendaftar->KOTA; ?>" />
                                <input type="hidden" name="nama_ortu1" value="<?php echo $pendaftar->NAMA_ORTU; ?>" />
                                <input type="hidden" name="asal_sekolah1" value="<?php echo $pendaftar->ASAL_SEKOLAH; ?>" />
                                <input type="hidden" name="kota_asal_sekolah1" value="<?php echo $pendaftar->KOTA_ASAL_SEKOLAH; ?>" />
                                <input type="hidden" name="nilai_bind1" value="<?php echo $pendaftar->UAN_BIND; ?>" />
                                <input type="hidden" name="nilai_mat1" value="<?php echo $pendaftar->UAN_MAT; ?>" />
                                <input type="hidden" name="nilai_ipa1" value="<?php echo $pendaftar->UAN_IPA; ?>" />

                                <input type="hidden" name="nun_asli" value="<?php echo $pendaftar->NUN_ASLI; ?>" />

                                <?php if ($tingkatan == 'smp') { ?> 
                                <input type="hidden" id="nilai_bind2_hidden" name="nilai_bind2" value="<?php echo $pendaftar->RAP_BIND; ?>" />
                                <input type="hidden" id="nilai_mat2_hidden" name="nilai_mat2" value="<?php echo $pendaftar->RAP_MAT; ?>" />
                                <input type="hidden" id ="nilai_ipa2_hidden" name="nilai_ipa2" value="<?php echo $pendaftar->RAP_IPA; ?>" />

                                <input type="hidden" name="nrap_asli" value="<?php echo $pendaftar->NRAP_ASLI; ?>" />

                                <input type="hidden" name="nilai_bind3" value="<?php echo $pendaftar->AKHIR_BIND; ?>" />
                                <input type="hidden" name="nilai_mat3" value="<?php echo $pendaftar->AKHIR_MAT; ?>" />
                                <input type="hidden" name="nilai_ipa3" value="<?php echo $pendaftar->AKHIR_IPA; ?>" />

                                <input type="hidden" name="nakhir_asli" value="<?php echo $pendaftar->NAKHIR_ASLI; ?>" />
                                <?php } ?>

                                <?php if ($tingkatan != 'smp') { ?> 
                                <input type="hidden" name="nilai_bing1" value="<?php echo $pendaftar->UAN_BING; ?>" />
                                <?php } ?>
                                <?php } ?> 
                                
                                <table id="input_pilihan" class="tabeldalamform" cellpadding="1" cellspacing="2">
                                    <tr>
                                        <td colspan="2">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">
                                            <label><?php echo $_pendaftaran ?></label>
                                        </td>
                                        <td class="tddfkanan">
                                            <input id="NO_PEN" name="no_pen" type="text" value="<?php if(isset($pendaftar->NO_PENDAFTARAN)) echo $pendaftar->NO_PENDAFTARAN;  ?>" size="20" maxlength="20" class="button"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_nama ?></label> </td>
                                        <td class="tddfkanan"><input id="NAMA" class="button" name="nama" size="30" value="<?php echo $pendaftar->NAMA; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_lulus ?></label> </td>
                                        <td class="tddfkanan">
                                            <select name="tahun_lulus" <?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> >
                                               <?php if ($this->uri->segment(2) == 'baru' || $this->uri->segment(2) == 'rekom') { ?><option value="<?php echo date("Y")-1; ?>/<?php echo date("Y")-0; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' selected="selected"' : ''; ?>><?php echo date("Y")-1; ?>/<?php echo date("Y")-0; ?></option><?php } ?>  <!-- tahun edit --> 
                                               <?php if ($this->uri->segment(2) == 'lalu' || $this->uri->segment(2) == 'rekom') { ?><option value="<?php echo date("Y")-2; ?>/<?php echo date("Y")-1; ?>"<?php echo ($this->uri->segment(2) == 'lalu') ? ' selected="selected"' : ''; ?>><?php echo date("Y")-2; ?>/<?php echo date("Y")-1; ?></option><?php } ?>  <!-- tahun edit -->
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_kelamin ?></label> </td>
                                        <td class="tddfkanan">
                                            <select id="JENIS_KELAMIN" name="jenis_kel"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?>>
                                                <option value="L"<?php echo ($pendaftar->JENIS_KEL == 'L') ? ' selected="selected"' : ''; ?>>Laki-laki</option>
                                                <option value="P"<?php echo ($pendaftar->JENIS_KEL == 'P') ? ' selected="selected"' : ''; ?>>Perempuan</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_lahir?></label> </td>
                                        <td class="tddfkanan">
                                            <input id="TMP_LAHIR" name="tmp_lahir" size="23" class="button" value="<?php echo $pendaftar->TMP_LAHIR; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />,<br />
                                            <?php $tgl_lahir = explode('/', $pendaftar->TGL_LAHIR); ?>
                                            <select name="tgl_lahir[]"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?>>
                                                <?php for ($i = 1; $i <= 31; $i++) { ?> 
                                                <option value="<?php printf('%02d', $i); ?>"<?php echo (intval($tgl_lahir[0]) == $i) ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
                                                <?php } ?> 
                                            </select>
                                            <select name="tgl_lahir[]"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?>>
                                                <?php for ($i = 1; $i <= 12; $i++) { ?> 
                                                <option value="<?php printf('%02d', $i); ?>"<?php echo (intval($tgl_lahir[1]) == $i) ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
                                                <?php } ?> 
                                            </select>
                                            <select name="tgl_lahir[]"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?>>
                                                <?php for ($j = ($tingkatan == 'smp') ? 1997 : 1994, $i = $j; $i <= $j + 5; $i++) { ?> 
                                                <option value="<?php echo $i; ?>"<?php echo (intval($tgl_lahir[2]) == $i) ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
                                                <?php } ?> 
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_alamat?></label> </td>
                                        <td class="tddfkanan"><textarea id="ALAMAT" name="alamat" class="button" rows="2" cols="23"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?>><?php echo $pendaftar->ALAMAT; ?></textarea></td> <!-- ALAMAT -->
                                    </tr>
                                                           
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_kota2?> <br/> <font style="font-size:10px; color:blue;">(Domisili)</font></label> </td>
                                        <td class="tddfkanan">
                                            <input type="radio" size="30" name="radioKota" value="1" onclick="test('1');" checked="checked" /> <b>SIDOARJO</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label></label> </td>
                                        <td class="tddfkanan">
                                           <!--  <input type="radio" size="30" name="radioKota" value="2" onclick="test('2');" /> LAIN-LAIN
                                            <input id="KOTA" name="kota" size="30" class="button" disabled="disable" value="SIDOARJO" placeholder="Masukkan Kota Baru"/>
                                            <br />
                                            <font id="warning"></font> -->
                                             <?php if($_jalur == 'rekom'){?><input type="radio" size="30" name="radioKota" value="2" onclick="test('2');" /> LAIN-LAIN
                                            <input id="KOTA" name="kota" size="30" class="button" value="SIDOARJO" placeholder="Masukkan Kota Baru"/>
                                            <br />
                                            <font id="warning"></font>
                                            <?php } else { ?>
                                            <input id="KOTA" name="kota" size="30" type="hidden" class="button" value="SIDOARJO" placeholder="Masukkan Kota Baru"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php if ($this->session->userdata('HAK') == 'inputrekom') { ?> 
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_domisili; ?></label> </td>
                                        <td class="tddfkanan"><input id="domisili" name="domisili" size="30" class="button" value="<?php echo $pendaftar->DOMISILI; ?>" <?php //echo ($tingkatan != 'smk') ? ' disabled="disabled"' : ''; ?>/></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_ortu ?></label> </td>
                                        <td class="tddfkanan"><input id="NAMA_ORTU" name="nama_ortu"  size="30" class="button" value="<?php echo $pendaftar->NAMA_ORTU; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_sekolah ?></label> </td>
                                        <td class="tddfkanan"><input id="ASAL_SEKOLAH" name="asal_sekolah" class="button" size="30" value="<?php echo $pendaftar->ASAL_SEKOLAH; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td> <!-- SEKOLAH_ASAL -->
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_kota2 ?></label> </td>
                                        <td class="tddfkanan">
                                            <input id="KOTA_ASAL_SEKOLAH" name="kota_asal_sekolah" size="30" class="button" value="<?php echo $pendaftar->KOTA_ASAL_SEKOLAH; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_nilai ?></label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <?php if ($tingkatan != 'smp') { ?> 
                                                    <th>B. ING</th>
                                                    <?php } ?> 
                                                    <?php if ($this->uri->segment(2) == 'baru') { ?><th><?php echo ($this->uri->segment(2) == 'lalu') ? 'NUN' : 'Nilai Akhir'; ?></th><?php } ?> 
                                                </thead>
                                                <!-- <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <?php if($tingkatan=='smp'){

                                                        ?>
                                                        <script>

                                                            function Calculate()
                                                            {
                                                                    var v=document.getElementById("nun_asli");
                                                                    var x=document.getElementById("nilai_ipa");
                                                                    var y=document.getElementById("nilai_bind");
                                                                    var z=document.getElementById("nilai_mat");

                                                                    // if(a==1)v.value=parseFloat(y.value);
                                                                    // else if(a==2)v.value=parseFloat(y.value)+ parseFloat(z.value);
                                                                  
                                                                    v.value= parseFloat(x.value) + parseFloat(y.value) + parseFloat(z.value);
                                                                    
                                                            }
                                                        </script>
                                                        <td>
                                                            <input id="nilai_bind" name="nilai_bind" size="7" type="text" style="margin-top: 5px;" value=""  onchange="Calculate()"/>
                                                        </td>
                                                        <td>
                                                            <input id="nilai_mat" name="nilai_mat" size="7" type="text" style="margin-top: 5px;" value="" onchange="Calculate()"/>
                                                        </td>
                                                        <td><input id="nilai_ipa" name="nilai_ipa" size="7" type="text" style="margin-top: 5px;" value="" onchange="Calculate()"/>
                                                        </td>
                                                        <?php if ($this->uri->segment(2) == 'baru') { ?><td><input id="nun_asli" name="nun_asli" size="7" type="text" style="margin-top: 5px;" value=""<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td><?php } ?> 
                                                        
                                                        <?php 
                                                        }
                                                        else 
                                                        { 

                                                        ?>
                                                        <td>
                                                            <input id="nilai_bind" name="nilai_bind" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_BIND; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td>
                                                            <input id="nilai_mat" name="nilai_mat" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_MAT; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td><input id="nilai_ipa" name="nilai_ipa" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_IPA; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                                        <?php if ($tingkatan != 'smp') { ?> 
                                                        <td><input id="nilai_bing" name="nilai_bing" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_BING; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                                        <?php } ?> 
                                                        <?php if ($this->uri->segment(2) == 'baru') { ?><td><input id="nun_asli" name="nun_asli" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NUN_ASLI; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td><?php } ?> 
                                                        <?php } ?>
                                                    </tr>
                                                </tbody> -->

                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td>
                                                            <input id="nilai_bind" name="nilai_bind" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_BIND; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td>
                                                            <input id="nilai_mat" name="nilai_mat" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_MAT; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td><input id="nilai_ipa" name="nilai_ipa" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_IPA; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                                        <?php if ($tingkatan != 'smp') { ?> 
                                                        <td><input id="nilai_bing" name="nilai_bing" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->UAN_BING; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                                        <?php } ?> 
                                                        <?php if ($this->uri->segment(2) == 'baru') { ?><td><input id="nun_asli" name="nun_asli" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NUN_ASLI; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td><?php } ?> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php if ($tingkatan == 'smp') { ?>  
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php if($tingkatan=='smp')echo "Nilai Sekolah:<p style='font-size:10px; color:red;'>( Nilai Desimal Dipishakan Dengan Tanda Titik, BUKAN Koma)</p>"; else echo $_nilaiRAP ?></label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_RAP" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <?php if ($this->uri->segment(2) == 'baru') { ?><th><?php echo ($this->uri->segment(2) == 'lalu') ? 'NUN' : 'Nilai Rapor'; ?></th><?php } ?>                                                     
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td>
                                                            <input id="nilai_bind22" onchange="sum()" name="nilai_bind22" size="7" type="hidden" style="margin-top: 5px;" value="<?php echo $pendaftar->RAP_BIND; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                            <input id="nilai_bind2" onchange="sum()" name="nilai_bind2" size="7" type="number" style="margin-top: 5px;width:78px" value="<?php echo $pendaftar->RAP_BIND; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td width="50px">
                                                            <input id="nilai_mat22" onchange="sum()" name="nilai_mat22" size="7" type="hidden" style="margin-top: 5px;" value="<?php echo $pendaftar->RAP_MAT; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                            <input id="nilai_mat2" onchange="sum()" name="nilai_mat2" size="7" type="number" style="margin-top: 5px;width:78px" value="<?php echo $pendaftar->RAP_MAT; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td>
                                                            <input id="nilai_ipa22" onchange="sum()" name="nilai_ipa22" size="7" type="hidden" style="margin-top: 5px;" value="<?php echo $pendaftar->RAP_IPA; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                            <input id="nilai_ipa2" onchange="sum()" name="nilai_ipa2" size="7" type="number" style="margin-top: 5px;width:78px" value="<?php echo $pendaftar->RAP_IPA; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                                        <?php if ($this->uri->segment(2) == 'baru') { ?><td><input id="nrap_asli" name="nrap_asli" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NRAP_ASLI; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="enabled"' : ''; ?> /></td><?php } ?> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td><input type='button' onclick="editus()"  style="height:40px;" value="Perubahan Nilai"></td>
                                        <input id="flag" name="flag" type="hidden" value="0">
                                    </tr>
                                    <tr style="visibility:hidden" id="perubahan">
                                        <td id="alasanlabel" class="tddfkiri" valign="top"><label>Alasan Perubahan</label> </td>
                                        <td><input name="alasan" id="alasan" style="height:40px; width:340px" value="<?php if(isset($pendaftar->ALASAN)) echo $pendaftar->ALASAN;  ?>" ></td>
                                        <td><input type="button"  onclick="saveus()" id="tombolubah" style="visibility:hidden;height:40px;" value="Simpan Nilai"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><input type="button" onclick="cancelus()"  id="cancelus1" style="visibility:hidden;height:40px;" value="Batalkan Perubahan"></td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label>Nilai Akhir</label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_US" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>B. IND</th>
                                                    <th>MAT</th>
                                                    <th>IPA</th>
                                                    <?php if ($this->uri->segment(2) == 'baru') { ?><th><?php echo ($this->uri->segment(2) == 'lalu') ? 'NUN' : 'Nilai Akhir'; ?></th><?php } ?> 
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td>
                                                            <input id="nilai_bind3" name="nilai_bind3" onchange="sum()" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->AKHIR_BIND; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td>
                                                            <input id="nilai_mat3" name="nilai_mat3" onchange="sum()" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->AKHIR_MAT; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> />
                                                        </td>
                                                        <td><input id="nilai_ipa3" name="nilai_ipa3" onchange="sum()" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->AKHIR_IPA; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td>
                                                
                                                        <?php if ($this->uri->segment(2) == 'baru') { ?><td><input id="nakhir_asli" name="nakhir_asli" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NAKHIR_ASLI; ?>"<?php echo ($this->uri->segment(2) == 'baru') ? ' disabled="disabled"' : ''; ?> /></td><?php } ?> 
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?> 
                                    <?php if (false) { ?> 
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php $_nilai2 ?></label> </td>
                                        <td class="tddfkanan">
                                            <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                                <thead align="center">
                                                    <th>NTMB</th>
                                                    <th>NTK</th>
                                                </thead>
                                                <tbody align="center" style="background-color: #ffffff">
                                                    <tr>
                                                        <td>
                                                            <input id="ntmb" name="ntmb" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NTMB; ?>" /><br />
                                                            10.0-100.0
                                                        </td>
                                                        <td>
                                                            <input id="ntk" name="ntk" size="7" type="text" style="margin-top: 5px;" value="<?php echo $pendaftar->NTK; ?>" /><br />
                                                            10.0-100.0
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php } ?> 
                                    <tr>
                                        <td class="tddfkiri"><label><?php echo $_telp ?></label> </td>
                                        <td class="tddfkanan"><input id="NO_TELP" name="no_telp" size="30" class="button" value="<?php echo $pendaftar->NO_TELP; ?>" /></td>
                                    </tr>
                                    <tr id="row_psiko">
                                        
                                    </tr>
                                    <tr id="row_wawancara">
                                        
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri" valign="top"><label><?php echo $_pilihan ?> <?php echo ($tingkatan != 'smk') ? 'Sekolah' : 'Jurusan'; ?> :</label> </td>
                                        <td class="tddfkanan">
                                            <strong>PILIHAN 1</strong><br />
                                            <select id="pilih1" name="pilih1">
                                                <option value="">[ID] - [<?php echo ($tingkatan != 'smk') ? 'Sekolah' : 'Jurusan'; ?>]</option>
                                                <?php
                                                $temp = '';
                                                foreach ($sekolah as $item) {
                                                    if ($this->session->userdata('HAK') != 'inputrekom') {
                                                        if ($temp != $item->JURUSAN && $tingkatan != 'smk') {
                                                ?> 
                                                <option value="" class="groupClass" disabled><?php echo $item->JURUSAN; ?></option>
                                                <?php
                                                        }
                                                        $temp = $item->JURUSAN;
                                                    } else {
                                                        if ($tingkatan == 'smk') {
                                                            if ($temp != substr($item->ID_SEKOLAH, 0, 2)) {
                                                ?>
                                                <option value="" class="groupClass" disabled><?php echo $item->NAMA_SEKOLAH; ?></option>
                                                <?php
                                                            }
                                                            $temp = substr($item->ID_SEKOLAH, 0, 2);
                                                        }
                                                    }
                                                ?> 
                                                <option value="<?php echo $item->ID_SEKOLAH; ?>"<?php echo ($item->ID_SEKOLAH == $pendaftar->PILIH1) ? ' selected="selected"' : ''; ?>><?php echo ($tingkatan != 'smk') ? $item->ID_SEKOLAH : substr($item->ID_SEKOLAH,0,2)." - ".$item->NO_RUMPUN; ?> - <?php echo ($tingkatan != 'smk') ? $item->NAMA_SEKOLAH : $item->JURUSAN; ?></option>
                                                <?php
                                                }
                                                ?> 
                                            </select>
                                            <div id="data_pilihan1" style="margin-bottom: 6px;">
                                            </div>

                                            <strong>PILIHAN 2</strong><br />
                                            <select id="pilih2" name="pilih2">
                                                <option value="">[ID] - [<?php echo ($tingkatan != 'smk') ? 'Sekolah' : 'Jurusan'; ?>]</option>
                                                <?php
                                                $temp = '';
                                                foreach ($sekolah as $item) {
                                                    if ($this->session->userdata('HAK') != 'inputrekom') {
                                                        if ($temp != $item->JURUSAN && $tingkatan != 'smk') {
                                                ?> 
                                                <option value="" class="groupClass" disabled><?php echo $item->JURUSAN; ?></option>
                                                <?php
                                                        }
                                                        $temp = $item->JURUSAN;
                                                    } else {
                                                        if ($tingkatan == 'smk') {
                                                            if ($temp != substr($item->ID_SEKOLAH, 0, 2)) {
                                                ?>
                                                <option value="" class="groupClass" disabled><?php echo $item->NAMA_SEKOLAH; ?></option>
                                                <?php
                                                            }
                                                            $temp = substr($item->ID_SEKOLAH, 0, 2);
                                                        }
                                                    }
                                                ?> 
                                                <option value="<?php echo $item->ID_SEKOLAH; ?>"<?php echo ($item->ID_SEKOLAH == $pendaftar->PILIH2) ? ' selected="selected"' : ''; ?>><?php echo ($tingkatan != 'smk') ? $item->ID_SEKOLAH : substr($item->ID_SEKOLAH,0,2)." - ".$item->NO_RUMPUN; ?> - <?php echo ($tingkatan != 'smk') ? $item->NAMA_SEKOLAH : $item->JURUSAN; ?></option>
                                                <?php
                                                }
                                                ?> 
                                            </select>
                                            <div id="data_pilihan2" style="margin-bottom: 6px;">              
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="tddfkiri">&nbsp;</td>
                                        <td class="tddfkanan">
                                            <input id="simpan" type="submit" name="act" value="Simpan" style="border: solid thin #123412"/>
                                            <input id="kembali1" type="button" name="act" value="Kembali" style="border: solid thin #123412;" onclick="cancelForm();" />
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><br /></td></tr>
                                </table>
                            </form>
                            <?php } ?> 
                            
                            <?php if (isset($terdaftar) && $terdaftar) { ?>
                            <br /><br />Detail peserta terdaftar:<br />
                            <table id="terdaftar" class="tabeldalamform" cellpadding="1" cellspacing="2">
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_noun ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['NO_UJIAN']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_mendaftar ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['ID_SEKOLAH'].'. ';
                                    if ($terdaftar['NO_TINGKATAN'] != '3') echo $terdaftar['sekolah'][$terdaftar['ID_SEKOLAH']]->NAMA_SEKOLAH;
                                    else {
                                        for ($i = $start = intval($terdaftar['ID_SEKOLAH'])*1000; $i < $start + 1000; $i++) {
                                            if (isset($terdaftar['sekolah'][$i])) {
                                                echo $terdaftar['sekolah'][$i]->NAMA_SEKOLAH;
                                                break;
                                            }
                                        }
                                    }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_nama ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['NAMA']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_lulus ?></label> </td>
                                    <td class="tddfkanan">
                                        <?php echo $terdaftar['TAHUN_LULUS']; ?> 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_kelamin ?></label> </td>
                                    <td class="tddfkanan">
                                        <?php echo ($terdaftar['JENIS_KEL'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_lahir ?></label> </td>
                                    <td class="tddfkanan">
                                        <?php echo $terdaftar['TMP_LAHIR']; ?>, <?php echo $terdaftar['TGL_LAHIR']; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_alamat ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['ALAMAT']; ?></td> <!-- ALAMAT -->
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_kota ?></label> </td>
                                    <td class="tddfkanan">
                                        <?php echo $terdaftar['KOTA']; ?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_domisili ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['DOMISILI']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_ortu ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['NAMA_ORTU']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_sekolah ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['ASAL_SEKOLAH']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_kota2 ?></label> </td>
                                    <td class="tddfkanan">
                                        <?php echo $terdaftar['KOTA_ASAL_SEKOLAH']; ?> 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_nilai ?></label> </td>
                                    <td class="tddfkanan">
                                        <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                            <thead align="center">
                                                <th>B. IND</th>
                                                <th>MAT</th>
                                                <th>IPA</th>
                                                <?php if ($terdaftar['tingkatan'] != 'smp') { ?> 
                                                <th>B. ING</th>
                                                <?php } ?> 
                                                <th>NILAI AKHIR</th>
                                                <?php if ($terdaftar['tingkatan'] == 'smk') { ?> 
                                                <th>NILAI TERPADU</th>
                                                <?php } ?> 
                                            </thead>
                                            <tbody align="center" style="background-color: #ffffff">
                                                <tr>
                                                    <td><?php echo $terdaftar['UAN_BIND']; ?></td>
                                                    <td><?php echo $terdaftar['UAN_MAT']; ?></td>
                                                    <td><?php echo $terdaftar['UAN_IPA']; ?></td>
                                                    <?php if ($terdaftar['tingkatan'] != 'smp') { ?> 
                                                    <td><?php echo $terdaftar['UAN_BING']; ?></td>
                                                    <?php } ?> 
                                                    <td><?php echo $terdaftar['NUN_ASLI']; ?></td>
                                                    <?php if ($terdaftar['tingkatan'] == 'smk') { ?> 
                                                    <th><?php echo $terdaftar['NILAI_AKHIR']; ?></th>
                                                    <?php } ?> 
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                
                                <?php if ($terdaftar['tingkatan'] == 'smp') { ?> 
                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_nilaiRAP ?></label> </td>
                                    <td class="tddfkanan">
                                        <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                            <thead align="center">
                                                <th>B. IND</th>
                                                <th>MAT</th>
                                                <th>IPA</th>
                                                <th>NILAI AKHIR</th>
                                            </thead>
                                            <tbody align="center" style="background-color: #ffffff">
                                                <tr>
                                                    <td><?php echo $terdaftar['RAP_BIND']; ?></td>
                                                    <td><?php echo $terdaftar['RAP_MAT']; ?></td>
                                                    <td><?php echo $terdaftar['RAP_IPA']; ?></td>
                                                    <td><?php echo $terdaftar['NRAP_ASLI']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_nilaiakhir ?></label> </td>
                                    <td class="tddfkanan">
                                        <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                            <thead align="center">
                                                <th>B. IND</th>
                                                <th>MAT</th>
                                                <th>IPA</th>
                                                <th>NILAI AKHIR</th>
                                            </thead>
                                            <tbody align="center" style="background-color: #ffffff">
                                                <tr>
                                                    <td><?php echo $terdaftar['AKHIR_BIND']; ?></td>
                                                    <td><?php echo $terdaftar['AKHIR_MAT']; ?></td>
                                                    <td><?php echo $terdaftar['AKHIR_IPA']; ?></td>
                                                    <td><?php echo $terdaftar['NAKHIR_ASLI']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php } ?> 

                                <?php if (false) { ?> 
                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_nilai2 ?></label> </td>
                                    <td class="tddfkanan">
                                        <table id="NILAI_UN" width="300" border="1" cellspacing="0" cellpadding="0">
                                            <thead align="center">
                                                <th>NTMB</th>
                                                <th>NTK</th>
                                            </thead>
                                            <tbody align="center" style="background-color: #ffffff">
                                                <tr>
                                                    <td><?php echo $terdaftar['NTMB']; ?></td>
                                                    <td><?php echo $terdaftar['NTK']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php } ?> 
                                <?php if ($terdaftar['ID_SEKOLAH'] != $this->session->userdata('ID_SEKOLAH')) { ?>
                                <tr>
                                    <td colspan="2" style="text-align: center;">No Telepon dan Pilihan peserta tidak dapat ditampilkan karena tidak mendaftar di sekolah Anda.</td>
                                </tr>
                                <?php } else { ?> 
                                <tr>
                                    <td class="tddfkiri"><label><?php echo $_telp ?></label> </td>
                                    <td class="tddfkanan"><?php echo $terdaftar['NO_TELP']; ?></td>
                                </tr>
                                <tr>
                                    <td class="tddfkiri" valign="top"><label><?php echo $_pilihan ?> <?php echo ($tingkatan != 'smk') ? 'Sekolah' : 'Jurusan'; ?> :</label> </td>
                                    <td class="tddfkanan">
                                        <strong>PILIHAN 1</strong><br />
                                        <?php echo ($terdaftar['PILIH1']) ? $terdaftar['sekolah'][$terdaftar['PILIH1']]->ID_SEKOLAH.'. '.$terdaftar['sekolah'][$terdaftar['PILIH1']]->NAMA_SEKOLAH.(($terdaftar['sekolah'][$terdaftar['PILIH1']]->NO_TINGKATAN == 3) ? ', '.$terdaftar['sekolah'][$terdaftar['PILIH1']]->JURUSAN : '') : '(tidak memilih)'; ?> 
                                        <div id="data_pilihan1" style="margin-bottom: 6px;">
                                        </div>

                                        <strong>PILIHAN 2</strong><br />
                                        <?php echo ($terdaftar['PILIH2']) ? $terdaftar['sekolah'][$terdaftar['PILIH2']]->ID_SEKOLAH.'. '.$terdaftar['sekolah'][$terdaftar['PILIH2']]->NAMA_SEKOLAH.(($terdaftar['sekolah'][$terdaftar['PILIH2']]->NO_TINGKATAN == 3) ? ', '.$terdaftar['sekolah'][$terdaftar['PILIH2']]->JURUSAN : '') : '(tidak memilih)'; ?> 
                                        <div id="data_pilihan2" style="margin-bottom: 6px;">              
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?> 
                            </table>
                            <?php } ?> 
                            <?php 
                                
                                if (isset($terdaftar) && $terdaftar) {
                                    echo form_open_multipart('daftar/edit/'.$tingkatan.'/'.$terdaftar['NO_UJIAN'].'/1');
                                    // echo ('<input type="submit" value="edit peserta terdaftar" />');
                                //echo ($this->session->userdata('HAK') == 'admin') ? anchor('daftar/edit/'.$tingkatan.'/'.$terdaftar['NO_UJIAN'].'/1', 'Edit', 'style="color: blue;"') : ''; 
                                }
                            ?> 
                        </td>
                    </tr>
                    <tr><td colspan="2"><br /></td></tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div style="clear: both"></div>
<script>
$("#pilih2").change(function(){ //change pilih2
    if($("#pilih1 option:selected").val() == $("#pilih2 option:selected").val()){   //if same with pilih 1
//        alert($("#pilih1 option:selected").val()+" "+$("#pilih2 option:selected").val());
//        alert($('#pilih2 option:eq(0)').text());
        $('#pilih2 option:eq(0)').prop("selected", true);
    }
});
</script>
<?php $this->load->view('base/footer')?>

<script type="text/javascript">
    var bind, ipa, mat, flag;

    // bind = document.getElementById('nilai_bind2').value;
    // ipa = document.getElementById('nilai_ipa2').value;
    // mat = document.getElementById('nilai_mat2').value;

    function editus()
    {
        // bind = document.getElementById('nilai_bind2').value;
        // ipa = document.getElementById('nilai_ipa2').value;
        // mat = document.getElementById('nilai_mat2').value;
        document.getElementById('perubahan').style.visibility='visible';
        document.getElementById('nilai_bind2').disabled='';
        document.getElementById('nilai_ipa2').disabled='';
        document.getElementById('nilai_mat2').disabled='';
        document.getElementById('alasan').type='text';
        document.getElementById('alasan').disabled='';
        // document.getElementById('nus_asli').disabled='';
        document.getElementById('tombolubah').style.visibility='visible';
        document.getElementById('cancelus1').style.visibility='visible';
        var x=window.confirm("Perhatian! setiap perubahan akan dicatat, harap disesuaikan dengan dokumen aslinya");
        if(x) 
            window.alert("Silahkan melakukan proses perubahan data");
        else
            window.alert("Perubahan dibatalkan");


            }
    
    function cancelus()
    {
        document.getElementById('nilai_bind2').value = document.getElementById('nilai_bind22').value;
        document.getElementById('nilai_ipa2').value = document.getElementById('nilai_ipa22').value;;
        document.getElementById('nilai_mat2').value = document.getElementById('nilai_mat22').value;;

        document.getElementById('perubahan').style.visibility='hidden';
        document.getElementById('nilai_bind2').disabled='disabled';
        document.getElementById('nilai_ipa2').disabled='disabled';
        document.getElementById('nilai_mat2').disabled='disabled';
        document.getElementById('alasan').type='hidden';
        // document.getElementById('nus_asli').disabled='';
        document.getElementById('tombolubah').style.visibility='hidden';
        document.getElementById('cancelus1').style.visibility='hidden';
	sum();
    }

    function saveus()
    {
        window.flag = document.getElementById("flag");
        bind = document.getElementById('nilai_bind2').value;
        ipa = document.getElementById('nilai_ipa2').value;
        mat = document.getElementById('nilai_mat2').value;

        if(document.getElementById('alasan').value!=''){
            if(bind>10 || bind<0 || ipa>10 || ipa<0 || mat>10 || mat<0) 
                window.alert("Format nilai yang anda masukkan salah");
            else{
                document.getElementById('alasan').disabled='';
                document.getElementById('nilai_bind2').disabled='disabled';
                document.getElementById('nilai_ipa2').disabled='disabled';
                document.getElementById('nilai_mat2').disabled='disabled';

                // document.getElementById('nus_asli').disabled='disabled';
                var x = window.confirm("Apakah data nilai yang anda masukkan sudah benar? Data yang anda rubah sangat berpengaruh pada penilaian, mohon ketelitiannya");
                if (x){
                    window.alert("Perubahan data berhasil dilakukan")
                        // console.log(window.flag.value);
                        window.flag.value = "1";
                }
                else
                    window.alert("Perubahan batal dilakukan")
            }
        }
        else window.alert("Alasan belum diisi");
    }

    function sum() {

        bind = document.getElementById('nilai_bind').value;
        ipa = document.getElementById('nilai_ipa').value;
        mat = document.getElementById('nilai_mat').value;
        akhir = document.getElementById('nun_asli').value;

        bind2=document.getElementById('nilai_bind2').value;
        document.getElementById('nilai_bind2_hidden').value=bind2;
        ipa2=document.getElementById('nilai_ipa2').value;
        document.getElementById('nilai_ipa2_hidden').value=ipa2;
        mat2=document.getElementById('nilai_mat2').value;
        document.getElementById('nilai_mat2_hidden').value=mat2;
        
        document.getElementById('nrap_asli').value=parseFloat(bind2)+parseFloat(ipa2)+parseFloat(mat2);

        akhir2 = document.getElementById('nrap_asli').value

        document.getElementById('nilai_bind3').value=parseFloat(bind2)*0.7 + parseFloat(bind)*0.3 ;
        document.getElementById('nilai_mat3').value=parseFloat(mat2)*0.7 + parseFloat(mat)*0.3;
        document.getElementById('nilai_ipa3').value=parseFloat(ipa2)*0.7 + parseFloat(ipa)*0.3;
        document.getElementById('nakhir_asli').value=parseFloat(akhir2)*0.7 + parseFloat(akhir)*0.3;
    }
</script>
