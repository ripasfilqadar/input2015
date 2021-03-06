<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {
    private $hak, $id_sekolah;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
//<<<<<<< HEAD
        // $this->load->library('ciqrcode');
//=======
        //$this->load->library('ciqrcode');
//>>>>>>> 71163a9daea09fc3e2ce53f8bae7ffac6b6c636a
        $this->load->helper('url');
        $this->load->helper('mydb');
        
        $this->load->model('m_master_un');
        $this->load->model('m_pendaftar');
        $this->load->model('m_sekolah');
        
        if (!($this->nama_user = $this->session->userdata('NAMA_USER'))) redirect('');
        $this->id_sekolah = $this->session->userdata('ID_SEKOLAH');
        $this->nama_sekolah = $this->session->userdata('NAMA_SEKOLAH');
        $this->tingkatan_sekolah = $this->session->userdata('TINGKATAN_SEKOLAH');
        $this->hak = $this->session->userdata('HAK');
//	date_default_timezone_set('Asia/Jakarta');        
        //$this->_load_terdaftar_terakhir();
    }
    
    public function cetak($tingkatan = '', $no_un = ''){
	//date_default_timezone_set('Asia/Jakarta');               
        if (!$no_un || !$tingkatan) redirect('');
        
        $this->load->library('cezpdf');
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $data = array(
            'pendaftar' => $this->m_pendaftar->read('', array('NO_UJIAN' => $no_un))
        );
        
        if ($data['pendaftar']->num_rows() == 0) redirect('');
        $data = $data['pendaftar']->row_array();
        $data['tingkatan'] = $tingkatan;
        $sekolah = $this->m_sekolah->read()->result();
        $data['sekolah'] = array();
        foreach ($sekolah as $item) {
            $id = $item->ID_SEKOLAH;
            $data['sekolah'][$id] = $item;
            if (intval($id) >= 70000) {
                $id = substr($id, 0, 2);
                $data['sekolah'][$id] = $item;
            }
        }

        $datacetak = "ppdbsda".$tingkatan.$no_un."p1".$data['PILIH1']."p2".$data['PILIH2']."2015YunusRipasRoyyanPur";
        // $data['kodecetak'] = substr(md5(base64_encode($datacetak)),-10);
        $data['kodecetak'] = substr(md5(base64_encode($datacetak)),0);

//<<<<<<< HEAD
        // $params['data'] = $data['kodecetak'];
        // $params['level'] = 'H';
        // $params['size'] = 3;
        // // $params['savename'] = FCPATH.$data['kodecetak'].".jpg";
        // $params['savename'] = FCPATH.'qrcode/'.$data['kodecetak'].".png";
        // $this->ciqrcode->generate($params);
//=======
        $params['data'] = $data['kodecetak'];
        $params['level'] = 'H';
        $params['size'] = 3;
        // $params['savename'] = FCPATH.$data['kodecetak'].".jpg";
        $params['savename'] = FCPATH.'qrcode/'.$data['kodecetak'].".png";
        //$this->ciqrcode->generate($params);
//>>>>>>> 71163a9daea09fc3e2ce53f8bae7ffac6b6c636a
        // echo base_url().$data['kodecetak'];
        // echo '<img src="'.base_url().'qrcode/'.$data['kodecetak'].'.png"/>';
        // echo($datacetak);
        //$data['coba'] = $datacetak;
        //$data['coba2'] = md5(base64_encode($datacetak));
        
        $mypdf = new Cezpdf("A4", 'portrait'); 
        $this->template($mypdf, $data);
        $this->template($mypdf, $data, ($mypdf->y)/2 + 10, 'Untuk Sekolah');
        $mypdf->addText(15, $mypdf->y/2 +15, 10, "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - POTONG DISINI - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - ");
        
        $mypdf->output();

        $mypdf->ezStream();
    }
    
    public function template($pdf, $data, $posY = 0, $statement='Untuk Pendaftar'){

            $y=90;
            $x=80;
            $val=85;
            $kiri=-20;
            $val3=200;
            $data3=300;

            $judul1 = "PEMERINTAH KABUPATEN SIDOARJO";
            $judul2 = "DINAS PENDIDIKAN";
            //date_default_timezone_set('Asia/Jakarta');
            $judul3 = "Jl. Pahlawan No. 4, Sidoarjo, Telp. 031-8921219, 031-8940921";
            $path="images/sido.jpg";
            $pdf->addJpegFromFile($path,30,$pdf->y-$posY-55,60);
        //$pdf->addJpegFromFile("qrcode/coba.jpg", $x+$val3, $pdf->y-$posY-$y);
            $pdf->addText(150, $pdf->y-$posY-9, 15, $judul1);
            $pdf->addText(215, $pdf->y-$posY-25, 16, $judul2);
            $pdf->addText(178, $pdf->y-$posY-35, 8, $judul3);
            $pdf->addText(100, $pdf->y-$posY-36, 25, "_______________________________");
            $pdf->addText(98, $pdf->y-$posY-38, 30, "__________________________");
            $pdf->ezTable($statement);
            $pdf->addText(480, $pdf->y-$posY-20, 12, $statement);
            //510
            $pdf->addText(430, $pdf->y-$posY+5, 9, $data['kodecetak']);
            $pdf->addText(150, $pdf->y-$posY-60, 14, "BUKTI PENDAFTARAN PESERTA DIDIK BARU");
            //$pdf->addText(230, $pdf->y-$posY-70, 10, strtoupper($data['sekolah'][$data['ID_SEKOLAH']]->NAMA_SEKOLAH));
                        
            $pdf->addText(260, $pdf->y-$posY-270, 9, "Mengesahkan,");
            $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei',
                'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember','Desember');
            
            $bln = (int)date("n");
            
            $pdf->addText(245, $pdf->y-$posY-280, 9, "Sidoarjo, ".date("j")." ".$bulan[$bln-1]." ".date("Y"));
            if($data['tingkatan']=='smp'){
                $pdf->addText(225, $pdf->y-$posY-290, 9, "Petugas Validator Nilai dan Pilihan");
                $pdf->addText(234, $pdf->y-$posY-350, 9, "(. . . . . . . . . . . . . . . . . . . . . .)");
            }    
                $pdf->addText(80, $pdf->y-$posY-290, 9, "Petugas Verifikasi");
                $pdf->addText(390, $pdf->y-$posY-290, 9, "Orang Tua / Wali / Pendaftar");
                $pdf->addText(62, $pdf->y-$posY-350, 9, "(. . . . . . . . . . . . . . . . . . . . . .)");
                $pdf->addText(390, $pdf->y-$posY-350, 9, "(. . . . . . . . . . . . . . . . . . . . . .)");

           // echo  base_url().'qrcode/'.$data['kodecetak'].".png";
            $path=$data['kodecetak'];
          //  echo "qrcode/".$path."'.png'";
            $pdf->addJpegFromFile("qrcode/coba.jpg", $x+$val3, $pdf->y-$posY-$y);

            $pdf->addText($x+$kiri, $pdf->y-$posY-$y, 8, "NOMOR PENDAFTARAN"); 
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-8, 8, "NOMOR UN");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-16, 8, "NAMA");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-24, 8, "JENIS KELAMIN");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-32, 8, "TEMPAT, TGL LAHIR");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-40, 8, "ALAMAT");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-48, 8, "KOTA/KAB (DOMISILI)");
            if ($this->hak == 'inputrekomsmp' || $this->hak == 'inputrekomsma' || $this->hak == 'inputrekomsmk' || $this->hak == 'inputrekom') {
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-56, 8, "NO. KK");
            }
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-64, 8, "NO. TELEPON");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-72, 8, "NAMA ORANG TUA");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-80, 8, "ASAL SEKOLAH");
            $pdf->addText($x+$kiri, $pdf->y-$posY-$y-88, 8, "KOTA ASAL SEKOLAH");
            //keterangan 
            // $pdf->addText($x, $pdf->y-$posY-$y-80, 8, "JALUR DAFTAR");
            
            $pdf->addText($x+$val, $pdf->y-$posY-$y, 8, ": ".$data['NO_PENDAFTARAN']); 
            $pdf->addText($x+$val, $pdf->y-$posY-$y-8, 8, ": ".$data['NO_UJIAN']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-16, 8, ": ".$data['NAMA']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-24, 8, ": ".($data['JENIS_KEL']=='L'?'LAKI-LAKI':'PEREMPUAN'));
            $pdf->addText($x+$val, $pdf->y-$posY-$y-32, 8, ": ".strtoupper($data['TMP_LAHIR']).", ".$data['TGL_LAHIR']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-40, 8, ": ".$data['ALAMAT']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-48, 8, ": ".$data['KOTA']);
            if ($this->hak == 'inputrekomsmp' || $this->hak == 'inputrekomsma' || $this->hak == 'inputrekomsmk' || $this->hak == 'inputrekom') {
                $pdf->addText($x+$val, $pdf->y-$posY-$y-56, 8, ": ".$data['DOMISILI']);
            }
            $pdf->addText($x+$val, $pdf->y-$posY-$y-64, 8, ": ".$data['NO_TELP']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-72, 8, ": ".$data['NAMA_ORTU']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-80, 8, ": ".$data['ASAL_SEKOLAH']);
            $pdf->addText($x+$val, $pdf->y-$posY-$y-88, 8, ": ".$data['KOTA_ASAL_SEKOLAH']);
            
	    //if ($data['tingkatan'] != 'smk'){
            	if($data['tingkatan']=='smp'){
                    $pdf->addText($x+$kiri, $pdf->y-$posY-$y-104, 8, "NILAI ");
                    $pdf->addText($x+$val, $pdf->y-$posY-$y-104, 8, "US");
                    $pdf->addText($x+$val+35, $pdf->y-$posY-$y-104, 8, "RAPOR");
                    $pdf->addText($x+$val+70, $pdf->y-$posY-$y-104, 8, "NA/NS");
                }
            	else $pdf->addText($x+$kiri, $pdf->y-$posY-$y-104, 8, "NILAI AKHIR");
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-112, 8, "    - BAHASA INDONESIA");
            	$pdf->addText($x+$kiri, $pdf->y-$posY-$y-120, 8, "    - MATEMATIKA");
            	$pdf->addText($x+$kiri, $pdf->y-$posY-$y-128, 8, "    - IPA");
            
            	$pdf->addText($x+$val, $pdf->y-$posY-$y-112, 8, ": ".$data['UAN_BIND']);
            	$pdf->addText($x+$val, $pdf->y-$posY-$y-120, 8, ": ".$data['UAN_MAT']);
            	$pdf->addText($x+$val, $pdf->y-$posY-$y-128, 8, ": ".$data['UAN_IPA']);
            //}

            if ($data['tingkatan']=='smp'){
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-136, 8, "TOTAL NILAI");
                
                $pdf->addText($x+$val, $pdf->y-$posY-$y-136, 8, ": ".$data['NUN_ASLI']);

                $pdf->addText($x+$val+35, $pdf->y-$posY-$y-112, 8, $data['RAP_BIND']);
                $pdf->addText($x+$val+35, $pdf->y-$posY-$y-120, 8, $data['RAP_MAT']);
                $pdf->addText($x+$val+35, $pdf->y-$posY-$y-128, 8, $data['RAP_IPA']);
                $pdf->addText($x+$val+35, $pdf->y-$posY-$y-136, 8, $data['NRAP_ASLI']);

                $pdf->addText($x+$val+70, $pdf->y-$posY-$y-112, 8, $data['AKHIR_BIND']);
                $pdf->addText($x+$val+70, $pdf->y-$posY-$y-120, 8, $data['AKHIR_MAT']);
                $pdf->addText($x+$val+70, $pdf->y-$posY-$y-128, 8, $data['AKHIR_IPA']);
                $pdf->addText($x+$val+70, $pdf->y-$posY-$y-136, 8, $data['NAKHIR_ASLI']);
            }
            else if ($data['tingkatan']=='sma'){
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-136, 8, "    - BAHASA INGGRIS");
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-148, 8, "TOTAL NILAI AKHIR");
                
                $pdf->addText($x+$val, $pdf->y-$posY-$y-136, 8, ": ".$data['UAN_BING']);
                $pdf->addText($x+$val, $pdf->y-$posY-$y-148, 8, ": ".$data['NUN_ASLI']);
            }
            else if ($data['tingkatan']=='smk'){
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-136, 8, "    - BAHASA INGGRIS");
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-144, 8, "TOTAL NILAI AKHIR");
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-152, 8, "NILAI TEST");
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-160, 8, "    - MINAT BAKAT");
                $pdf->addText($x+$kiri, $pdf->y-$posY-$y-168, 8, "    - KOMPETENSI KEAHLIAN");
                // $data['ID_SEKOLAH'] = $data['ID_SEKOLAH']*100 + 1;
		//$x = $x - 100;
                
                $pdf->addText($x+$val, $pdf->y-$posY-$y-136, 8, ": ".$data['UAN_BING']);
                $pdf->addText($x+$val, $pdf->y-$posY-$y-144, 8, ": ".$data['NUN_ASLI']);
                $pdf->addText($x+$val, $pdf->y-$posY-$y-160, 8, ": ".$data['NTMB']);
                $pdf->addText($x+$val, $pdf->y-$posY-$y-168, 8, ": ".$data['NTK']);
                $pdf->addText($x+$data3, $pdf->y-$posY-$y-112, 8, ": ".strtoupper($data['sekolah'][$data['PILIH1']]->NAMA_SEKOLAH));
            }
            
            $pdf->addText(230, $pdf->y-$posY-70, 10, strtoupper($data['sekolah'][$data['ID_SEKOLAH']]->NAMA_SEKOLAH));
            
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-104, 8, "JALUR DAFTAR");
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-112, 8, "PILIHAN SEKOLAH");
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-120, 8, "    1. PILIHAN 1");
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-128, 8, "    2. PILIHAN 2");
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-136, 8, "WAKTU PENDAFTARAN");
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-144, 8, "IP PENDAFTARAN");
            $pdf->addText($x+$val3, $pdf->y-$posY-$y-152, 8, "ID PETUGAS");
            
            $pdf->addText($x+$data3, $pdf->y-$posY-$y-104, 8, ": ".($data['JALUR_DAFTAR']==1?'PESERTA REGULER':($data['JALUR_DAFTAR']==0?'PESERTA TAHUN LALU':'PESERTA REKOMENDASI')));
            $pdf->addText($x+$data3, $pdf->y-$posY-$y-120, 8, ": ".strtoupper(($data['tingkatan']=='smk'?$data['sekolah'][$data['PILIH1']]->JURUSAN:$data['sekolah'][$data['PILIH1']]->NAMA_SEKOLAH))." (".$data['PILIH1'].")");
            $pdf->addText($x+$data3, $pdf->y-$posY-$y-128, 8, ": ".($data['PILIH2']==''? "TIDAK MEMILIH":
                    strtoupper(($data['tingkatan']=='smk'?$data['sekolah'][$data['PILIH2']]->JURUSAN:$data['sekolah'][$data['PILIH2']]->NAMA_SEKOLAH))." (".$data['PILIH2'].")"));
            $pdf->addText($x+$data3, $pdf->y-$posY-$y-136, 8, ": ".$data['WAKTU_DAFTAR']);
            $pdf->addText($x+$data3, $pdf->y-$posY-$y-144, 8, ": ".$data['IP_ADDRESS']);
            $pdf->addText($x+$data3, $pdf->y-$posY-$y-152, 8, ": ".$data['USER_FISIK']);
            //$pdf->ezSetY($pdf->y-$posY);
            
        }
        
    public function cetak_nkem($tingkatan = '', $jurusan = ''){
        $mulai = $this->input->POST('mulai');
        $akhir = $this->input->POST('akhir');
        //date_default_timezone_set('Asia/Jakarta');

	if ($this->hak != 'admin') {
            if (!$tingkatan || $tingkatan == 'x') {
                if (strpos($this->hak, 'inputrekom') !== false) {
                    $tingkatan = substr($this->hak, -3);
                } else {
                    $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk');
                }
            }
        }
        if ($tingkatan == 'smk' && ($jurusan == '' || $jurusan == 'x')) {
            $jurusan = (strpos($this->hak, 'inputrekom') !== false || $this->hak == 'admin') ? '71004' : $this->id_sekolah.'004';
        }
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $where = array();
        if ($tingkatan == 'smk')
            $where['PILIH1'] = $jurusan;
        if (strpos($this->hak, 'inputrekom') !== false) {
            $where['JALUR_DAFTAR <>'] = 1;
        } else {
            $where['ID_SEKOLAH'] = $this->id_sekolah;
            $where['JALUR_DAFTAR'] = 1;
        }

         $count = $this->m_pendaftar->read('count(*) as count', '', $where)->row()->count;
        $pendaftar= $this->m_pendaftar->read('NO_UJIAN', '', $where, 'PID asc', $count, $this->uri->segment(5))->result();

        //	echo $mulai."----".$akhir;

        if (!$tingkatan) redirect('');

        $this->load->library('cezpdf');
        $this->m_pendaftar->set_tingkatan($tingkatan);

        $mypdf = new Cezpdf("A4", 'portrait'); 

        //iterasi utama
        $jalan = 1;
        if($mulai > $akhir) $jalan = -1; 
        
        for($ia=$mulai; $ia!=($akhir+$jalan); $ia=($ia+$jalan)){

        //nomor unnya berapa
        $no_un = $pendaftar[$ia-1]->NO_UJIAN;
        $data = array(
            'pendaftar' => $this->m_pendaftar->read('', array('NO_UJIAN' => $no_un))
        );

        if ($data['pendaftar']->num_rows() == 0) {
            echo $pendaftar[$ia-1]->NO_UJIAN;
            print_r($pendaftar);return;}
            $data = $data['pendaftar']->row_array();
            $data['tingkatan'] = $tingkatan;
            $sekolah = $this->m_sekolah->read()->result();
            $data['sekolah'] = array();
            foreach ($sekolah as $item) {
                $id = $item->ID_SEKOLAH;
                $data['sekolah'][$id] = $item;
                if (intval($id) >= 7000) {
                    $id = substr($id, 0, 2);
                    $data['sekolah'][$id] = $item;
                }
        }
        
        $datacetak = "ppdbsda".$tingkatan.$no_un."p1".$data['PILIH1']."p2".$data['PILIH2']."2015YunusRipasRoyyanPur";
        // $data['kodecetak'] = substr(md5(base64_encode($datacetak)),-10);
        $data['kodecetak'] = substr(md5(base64_encode($datacetak)),0);
        
        //$data['coba'] = $datacetak;
        //$data['coba2'] = md5(base64_encode($datacetak));

        $this->template($mypdf, $data);
        $this->template($mypdf, $data, ($mypdf->y)/2 + 10, 'Untuk Sekolah');
        $mypdf->addText(15, $mypdf->y/2 +15, 20, "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");
         if($ia!=$akhir) $mypdf->ezNewPage();
       }
        $mypdf->output();
        $mypdf->ezStream();
    }
}
?>
