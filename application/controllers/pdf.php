<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {
    private $hak, $id_sekolah;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
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
	date_default_timezone_set('Asia/Jakarta');        
        //$this->_load_terdaftar_terakhir();
    }
    
    public function cetak($tingkatan = '', $no_un = ''){
	date_default_timezone_set('Asia/Jakarta');               
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
        
        $datacetak = "ppdbsda".$tingkatan.$no_un."p1".$data['PILIH1']."p2".$data['PILIH2']."bismillah2013";
        $data['kodecetak'] = substr(md5(base64_encode($datacetak)),-10);
        //$data['coba'] = $datacetak;
        //$data['coba2'] = md5(base64_encode($datacetak));
        
        
        $mypdf = new Cezpdf("A4", 'portrait'); 
        $this->template($mypdf, $data);
        $this->template($mypdf, $data, ($mypdf->y)/2 + 10, 'Untuk Sekolah');
        $mypdf->addText(15, $mypdf->y/2 +15, 20, "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -");
        $mypdf->output();
        $mypdf->ezStream(); 
        
    }
    
    public function template($pdf, $data, $posY = 0, $statement='Untuk Pendaftar'){
            $judul1 = "PEMERINTAH KABUPATEN SIDOARJO";
            $judul2 = "DINAS PENDIDIKAN";
            date_default_timezone_set('Asia/Jakarta');
            $judul3 = "Jl. Pahlawan No. 4, Sidoarjo, Telp. 031-8921219, 031-8940921";
            $pdf->addJpegFromFile("images/logo-sidoarjo1.jpg",35,$pdf->y-$posY-55);
            $pdf->addText(150, $pdf->y-$posY-9, 15, $judul1);
            $pdf->addText(215, $pdf->y-$posY-25, 16, $judul2);
            $pdf->addText(178, $pdf->y-$posY-35, 8, $judul3);
            $pdf->addText(100, $pdf->y-$posY-36, 25, "_______________________________");
            $pdf->addText(98, $pdf->y-$posY-38, 30, "__________________________");
            $pdf->ezTable($statement);
            $pdf->addText(480, $pdf->y-$posY-20, 12, $statement);
            //510
            $pdf->addText(515, $pdf->y-$posY+5, 9, $data['kodecetak']);
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
            

            $y=90;
            $x=80;
            $pdf->addText($x+100, $pdf->y-$posY-$y, 8, "NOMOR PENDAFTARAN"); 
            $pdf->addText($x+100, $pdf->y-$posY-$y-8, 8, "NOMOR UN");
            $pdf->addText($x+100, $pdf->y-$posY-$y-16, 8, "NAMA");
            $pdf->addText($x+100, $pdf->y-$posY-$y-24, 8, "JENIS KELAMIN");
            $pdf->addText($x+100, $pdf->y-$posY-$y-32, 8, "TEMPAT, TGL LAHIR");
            $pdf->addText($x+100, $pdf->y-$posY-$y-40, 8, "ALAMAT");
            $pdf->addText($x+100, $pdf->y-$posY-$y-48, 8, "KOTA/KAB (DOMISILI)");
            $pdf->addText($x+100, $pdf->y-$posY-$y-56, 8, "NO. KK");
            $pdf->addText($x+100, $pdf->y-$posY-$y-64, 8, "NO. TELEPON");
            $pdf->addText($x+100, $pdf->y-$posY-$y-72, 8, "NAMA ORANG TUA");
            $pdf->addText($x+100, $pdf->y-$posY-$y-80, 8, "ASAL SEKOLAH");
            $pdf->addText($x+100, $pdf->y-$posY-$y-88, 8, "KOTA ASAL SEKOLAH");
            //keterangan 
            // $pdf->addText($x, $pdf->y-$posY-$y-80, 8, "JALUR DAFTAR");
            
            $pdf->addText($x+200, $pdf->y-$posY-$y, 8, ": ".$data['NO_PENDAFTARAN']); 
            $pdf->addText($x+200, $pdf->y-$posY-$y-8, 8, ": ".$data['NO_UJIAN']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-16, 8, ": ".$data['NAMA']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-24, 8, ": ".($data['JENIS_KEL']=='L'?'LAKI-LAKI':'PEREMPUAN'));
            $pdf->addText($x+200, $pdf->y-$posY-$y-32, 8, ": ".strtoupper($data['TMP_LAHIR']).", ".$data['TGL_LAHIR']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-40, 8, ": ".$data['ALAMAT']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-48, 8, ": ".$data['KOTA']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-56, 8, ": ".$data['DOMISILI']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-64, 8, ": ".$data['NO_TELP']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-72, 8, ": ".$data['NAMA_ORTU']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-80, 8, ": ".$data['ASAL_SEKOLAH']);
            $pdf->addText($x+200, $pdf->y-$posY-$y-88, 8, ": ".$data['KOTA_ASAL_SEKOLAH']);
            
	    //if ($data['tingkatan'] != 'smk'){
            	if($data['tingkatan']=='smp')$pdf->addText($x+30, $pdf->y-$posY-$y-104, 8, "NILAI SEKOLAH");
            	else $pdf->addText($x+30, $pdf->y-$posY-$y-104, 8, "NILAI AKHIR");
                $pdf->addText($x+30, $pdf->y-$posY-$y-112, 8, "    - BAHASA INDONESIA");
            	$pdf->addText($x+30, $pdf->y-$posY-$y-120, 8, "    - MATEMATIKA");
            	$pdf->addText($x+30, $pdf->y-$posY-$y-128, 8, "    - IPA");
            
            
            	$pdf->addText($x+140, $pdf->y-$posY-$y-112, 8, ": ".$data['UAN_BIND']);
            	$pdf->addText($x+140, $pdf->y-$posY-$y-120, 8, ": ".$data['UAN_MAT']);
            	$pdf->addText($x+140, $pdf->y-$posY-$y-128, 8, ": ".$data['UAN_IPA']);
            //}

            if ($data['tingkatan']=='smp'){
                $pdf->addText($x+30, $pdf->y-$posY-$y-136, 8, "TOTAL NILAI");
                
                $pdf->addText($x+140, $pdf->y-$posY-$y-136, 8, ": ".$data['NUN_ASLI']);
                                
            }
            else if ($data['tingkatan']=='sma'){
                $pdf->addText($x+30, $pdf->y-$posY-$y-136, 8, "    - BAHASA INGGRIS");
                $pdf->addText($x+30, $pdf->y-$posY-$y-148, 8, "TOTAL NILAI AKHIR");
                
                $pdf->addText($x+140, $pdf->y-$posY-$y-136, 8, ": ".$data['UAN_BING']);
                $pdf->addText($x+140, $pdf->y-$posY-$y-148, 8, ": ".$data['NUN_ASLI']);
            }
            else if ($data['tingkatan']=='smk'){
                $pdf->addText($x+30, $pdf->y-$posY-$y-136, 8, "    - BAHASA INGGRIS");
                $pdf->addText($x+30, $pdf->y-$posY-$y-144, 8, "TOTAL NILAI AKHIR");
                $pdf->addText($x+30, $pdf->y-$posY-$y-152, 8, "NILAI TEST");
                $pdf->addText($x+30, $pdf->y-$posY-$y-160, 8, "    - MINAT BAKAT");
                $pdf->addText($x+30, $pdf->y-$posY-$y-168, 8, "    - KOMPETENSI KEAHLIAN");
                // $data['ID_SEKOLAH'] = $data['ID_SEKOLAH']*100 + 1;
		//$x = $x - 100;
                
                $pdf->addText($x+140, $pdf->y-$posY-$y-136, 8, ": ".$data['UAN_BING']);
                $pdf->addText($x+140, $pdf->y-$posY-$y-144, 8, ": ".$data['NUN_ASLI']);
                $pdf->addText($x+140, $pdf->y-$posY-$y-160, 8, ": ".$data['NTMB']);
                $pdf->addText($x+140, $pdf->y-$posY-$y-168, 8, ": ".$data['NTK']);
                $pdf->addText($x+320, $pdf->y-$posY-$y-112, 8, ": ".strtoupper($data['sekolah'][$data['PILIH1']]->NAMA_SEKOLAH));
            }
            
            $pdf->addText(230, $pdf->y-$posY-70, 10, strtoupper($data['sekolah'][$data['ID_SEKOLAH']]->NAMA_SEKOLAH));
            
            $pdf->addText($x+220, $pdf->y-$posY-$y-104, 8, "JALUR DAFTAR");
            $pdf->addText($x+220, $pdf->y-$posY-$y-112, 8, "PILIHAN SEKOLAH");
            $pdf->addText($x+220, $pdf->y-$posY-$y-120, 8, "    1. PILIHAN 1");
            $pdf->addText($x+220, $pdf->y-$posY-$y-128, 8, "    2. PILIHAN 2");
            $pdf->addText($x+220, $pdf->y-$posY-$y-136, 8, "WAKTU PENDAFTARAN");
            $pdf->addText($x+220, $pdf->y-$posY-$y-144, 8, "IP PENDAFTARAN");
            $pdf->addText($x+220, $pdf->y-$posY-$y-152, 8, "ID PETUGAS");
            
            $pdf->addText($x+320, $pdf->y-$posY-$y-104, 8, ": ".($data['JALUR_DAFTAR']==1?'PESERTA REGULER':($data['JALUR_DAFTAR']==0?'PESERTA TAHUN LALU':'PESERTA REKOMENDASI')));
            $pdf->addText($x+320, $pdf->y-$posY-$y-120, 8, ": ".strtoupper(($data['tingkatan']=='smk'?$data['sekolah'][$data['PILIH1']]->JURUSAN:$data['sekolah'][$data['PILIH1']]->NAMA_SEKOLAH))." (".$data['PILIH1'].")");
            $pdf->addText($x+320, $pdf->y-$posY-$y-128, 8, ": ".($data['PILIH2']==''? "TIDAK MEMILIH":
                    strtoupper(($data['tingkatan']=='smk'?$data['sekolah'][$data['PILIH2']]->JURUSAN:$data['sekolah'][$data['PILIH2']]->NAMA_SEKOLAH))." (".$data['PILIH2'].")"));
            $pdf->addText($x+320, $pdf->y-$posY-$y-136, 8, ": ".$data['WAKTU_DAFTAR']);
            $pdf->addText($x+320, $pdf->y-$posY-$y-144, 8, ": ".$data['IP_ADDRESS']);
            $pdf->addText($x+320, $pdf->y-$posY-$y-152, 8, ": ".$data['USER_FISIK']);
            //$pdf->ezSetY($pdf->y-$posY);
            
        }
        
    public function cetak_nkem($tingkatan = '', $jurusan = ''){
        $mulai = $this->input->POST('mulai');
        $akhir = $this->input->POST('akhir');
        date_default_timezone_set('Asia/Jakarta');

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
        
        $datacetak = "ppdbsda".$tingkatan.$no_un."p1".$data['PILIH1']."p2".$data['PILIH2']."bismillah2013";
        $data['kodecetak'] = substr(md5(base64_encode($datacetak)),-10);
        
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
