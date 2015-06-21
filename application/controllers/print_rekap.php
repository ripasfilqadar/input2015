<?php

class print_rekap extends CI_Controller
{
    private $nama_user, $id_sekolah, $nama_sekolah, $tingkatan_sekolah;
	function __construct()
	{
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
            $this->load->helper('mydb');
            $this->load->library('cezpdf');
            if (!($this->nama_user = $this->session->userdata('NAMA_USER'))) redirect('');
            $this->id_sekolah = $this->session->userdata('ID_SEKOLAH');
            $this->nama_sekolah = $this->session->userdata('NAMA_SEKOLAH');
            $this->tingkatan_sekolah = $this->session->userdata('TINGKATAN_SEKOLAH');
            $this->hak = $this->session->userdata('HAK');
            $this->load->model('m_pendaftar');
            $this->load->model('m_sekolah');

	}

	function index()
	{
            echo "Halaman cetak PDF";
	}
        
        function tes()
        {

                $this->cezpdf->ezText('Hello World', 12, array('justification' => 'center'));
                $this->cezpdf->ezSetDy(-10);

                $content = 'coba coba';

                $this->cezpdf->ezText($content, 10);
		//print_r($this->cezpdf);
            //$this->cezpdf->ezStream();
        }

function tes2() {phpinfo();}
        
        function rekaphtml()
        {
            return;
            $tanggal = $this->input->post('tanggal');
            $sekolah = $this->m_sekolah->read()->result();
            $data['sekolah'] = array();
            foreach ($sekolah as $item) {
                $data['sekolah'][$item->ID_SEKOLAH] = $item;
            }
            $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : (($this->tingkatan_sekolah == '3') ? 'smk' : ''));
            $this->m_pendaftar->set_tingkatan($tingkatan);
            // $pendaftar = $this->m_pendaftar->read('PID, NO_UJIAN, NAMA, ASAL_SEKOLAH, JALUR_DAFTAR, USER_FISIK, LOG_DAFTAR, PILIH1, PILIH2', array('WAKTU_DAFTAR' => $tanggal), array('ID_SEKOLAH' => $this->id_sekolah), 'LOG_DAFTAR ASC')->result_array();
            $pendaftar = $this->m_pendaftar->read('PID, NO_PENDAFTARAN, NO_UJIAN, NAMA,NAKHIR_ASLI, ASAL_SEKOLAH, JALUR_DAFTAR, USER_FISIK, LOG_DAFTAR, PILIH1, PILIH2', array('WAKTU_DAFTAR' => $tanggal), array('ID_SEKOLAH' => $this->id_sekolah), 'LOG_DAFTAR ASC')->result_array();

            $i = 0;
            foreach ($pendaftar as $key => $val) {
                $pendaftar[$key]['NO'] = ++$i;
                $pendaftar[$key]['JALUR_DAFTAR'] = ($pendaftar[$key]['JALUR_DAFTAR'] == '1') ? 'REGULER' : (($pendaftar[$key]['JALUR_DAFTAR'] == '0') ? 'TAHUN LALU' : 'REKOMENDASI');
                $pendaftar[$key]['PILIH1'] = $data['sekolah'][(int)$val['PILIH1']]->NAMA_SEKOLAH;
                $pendaftar[$key]['PILIH2'] = ($val['PILIH2']) ? $data['sekolah'][(int)$val['PILIH2']]->NAMA_SEKOLAH : '';
            }
            if ($tingkatan != 'smp') {
                $this->m_pendaftar->set_tingkatan(($tingkatan == 'sma') ? 'smk' : 'sma');
                $pendaftar2 = $this->m_pendaftar->read('PID, NO_UJIAN, NAMA, ASAL_SEKOLAH, JALUR_DAFTAR, USER_FISIK, LOG_DAFTAR, PILIH1, PILIH2', array('WAKTU_DAFTAR' => $tanggal), array('ID_SEKOLAH' => $this->id_sekolah), 'LOG_DAFTAR ASC')->result_array();
                
                foreach ($pendaftar2 as $key => $val) {
                    $pendaftar2[$key]['NO'] = ++$i;
                    $pendaftar2[$key]['JALUR_DAFTAR'] = ($pendaftar2[$key]['JALUR_DAFTAR'] == '1') ? 'REGULER' : (($pendaftar2[$key]['JALUR_DAFTAR'] == '0') ? 'TAHUN LALU' : 'REKOMENDASI');
                    $pendaftar2[$key]['PILIH1'] = $data['sekolah'][(int)$val['PILIH1']]->NAMA_SEKOLAH;
                    $pendaftar2[$key]['PILIH2'] = ($val['PILIH2']) ? $data['sekolah'][(int)substr($val['PILIH2'], 0, 2)]->NAMA_SEKOLAH : '';
                }
                $pendaftar = array_merge($pendaftar, $pendaftar2);
            }
            $this->load->view('rekap/home', $data);
        }
        
        function rekappdf()
        {
            $tanggal = $this->input->post('tanggal');
            function HeaderFooter(&$dpdf,$nama_sekolah)
            {
                $dpdf->addJpegFromFile("images/logo-sidoarjo1.jpg",35,760);
                // $dpdf->addJpegFromFile("images/sido.jpg",35,760,60);
                $text = "<b>DAFTAR CALON SISWA YANG MENDAFTAR DI</b>";
                $school = "<b>".$nama_sekolah."</b>";
                $tahun = "<b>TAHUN AJARAN 2013/2014</b>";
                $all = $dpdf->openObject();
                $dpdf->saveState();
                $dpdf->setStrokeColor(0,0,0,1);
                $dpdf->ezSetY(820);
                $dpdf->ezText($text,12,array('justification'=>'center'));
                $dpdf->ezText($school,12,array('justification'=>'center'));
                $dpdf->ezText($tahun,12,array('justification'=>'center'));
                $dpdf->restoreState();
                $dpdf->closeObject();
                $dpdf->addObject($all,'all');
            }


            $pdfku = new Cezpdf("A4", 'portrait'); //595.28,841.29
            $pdfku->addInfo('Title','Hasil Rekapitulasi');
            $pdfku->addInfo('Author','PPDB HELPER');
            $pdfku->addInfo('Application','PPDB Online Kabupaten Sidoarjo');
            $pdfku->ezSetCmMargins("4","2","3","2");

            $sekolah = $this->m_sekolah->read()->result();
            $data['sekolah'] = array();
            foreach ($sekolah as $item) {
                $data['sekolah'][$item->ID_SEKOLAH] = $item;
            }
            if (strpos($this->hak, 'inputrekom') === false)
                $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : (($this->tingkatan_sekolah == '3') ? 'smk' : 'smp'));
            else
                $tingkatan = substr ($this->hak, -3);

            $nama_sekolah= $this->nama_sekolah;//strtoupper($this->sekolah_model->get_nama_sekolah($id_sekolah));

            $pdfku->ezStartPageNumbers(580,35,9,'','Halaman {PAGENUM} Dari {TOTALPAGENUM} Halaman',1);

            HeaderFooter($pdfku, $nama_sekolah);

            $pdfku->ezSetY(750);
            $pdfku->ezSetDy(-20);

            $this->m_pendaftar->set_tingkatan($tingkatan);
            
            $where_escaped = array();
            if (strpos($this->hak, 'inputrekom') === false) {
                $where_escaped['ID_SEKOLAH'] = $this->id_sekolah;
            }
            $where = array();
            if ($tanggal != 'semua')
                $where['WAKTU_DAFTAR'] = $tanggal;
            if (strpos($this->hak, 'inputrekom') !== false)
                $where['JALUR_DAFTAR <>'] = 1;
            else
                $where['JALUR_DAFTAR'] = 1;
            
            // $pendaftar = $this->m_pendaftar->read('PID, NO_PENDAFTARAN, NO_UJIAN, NAMA, ASAL_SEKOLAH, JALUR_DAFTAR, USER_FISIK, LOG_DAFTAR, PILIH1, PILIH2', 'NAKHIR_ASLI', $where, $where_escaped, 'NAMA ASC')->result_array();
            if ($tingkatan=='smp')
                $pendaftar = $this->m_pendaftar->read('PID, NO_PENDAFTARAN, NO_UJIAN, NAMA, ASAL_SEKOLAH, USER_FISIK, LOG_DAFTAR, PILIH1, PILIH2, NAKHIR_ASLI', $where, $where_escaped, 'NAMA ASC')->result_array();
            else  
                $pendaftar = $this->m_pendaftar->read('PID, NO_PENDAFTARAN, NO_UJIAN, NAMA, ASAL_SEKOLAH, USER_FISIK, LOG_DAFTAR, PILIH1, PILIH2,NILAI_AKHIR', $where, $where_escaped, 'NAMA ASC')->result_array();
            
            $i = 0;
            foreach ($pendaftar as $key => $val) {
                $pendaftar[$key]['NO'] = ++$i;
                $pendaftar[$key]['JALUR_DAFTAR'] = ($pendaftar[$key]['JALUR_DAFTAR'] == '1') ? 'REGULER' : (($pendaftar[$key]['JALUR_DAFTAR'] == '0') ? 'TAHUN LALU' : 'REKOMENDASI');
                if($val['PILIH1'] < 7000 ) $pendaftar[$key]['PILIH1'] = $data['sekolah'][(int)$val['PILIH1']]->NAMA_SEKOLAH;
		else $pendaftar[$key]['PILIH1'] = $data['sekolah'][(int)$val['PILIH1']]->NAMA_SEKOLAH.' '.$data['sekolah'][(int)$val['PILIH1']]->JURUSAN;
                $pendaftar[$key]['PILIH2'] = ($val['PILIH2']) ? ($val['PILIH2']>7000 ? $data['sekolah'][(int)$val['PILIH2']]->JURUSAN : $data['sekolah'][(int)$val['PILIH2']]->NAMA_SEKOLAH) : '';
            
                if($val['PILIH2'] == '') $pendaftar[$key]['PILIH2'] = '-';
            }
            if ($tingkatan=='smp')
            {
                $cols_db=
                array
                (
                    'NO'=>'NO.',
                    'NO_PENDAFTARAN' => 'NO. PENDAFTARAN',
                    'NO_UJIAN'=>'NO. UJIAN',
                    'NAMA'=>' NAMA',
                    'JALUR_DAFTAR'=>'JALUR DAFTAR',
                    'USER_FISIK'=>'PETUGAS',
                    'LOG_DAFTAR'=>'WAKTU INPUT',
                    'PILIH1'=>'PILIHAN 1',
                    'PILIH2'=>'PILIHAN 2 ',
                    'NAKHIR_ASLI' => 'NILAI AKHIR'
                );
            }
            else if ($tingkatan!='smp'){
                $cols_db=
                array
                (
                    'NO'=>'NO.',
                    'NO_PENDAFTARAN' => 'NO. PENDAFTARAN',
                    'NO_UJIAN'=>'NO. UJIAN',
                    'NAMA'=>' NAMA',
                    'JALUR_DAFTAR'=>'JALUR DAFTAR',
                    'USER_FISIK'=>'PETUGAS',
                    'LOG_DAFTAR'=>'WAKTU INPUT',
                    'PILIH1'=>'PILIHAN 1',
                    'PILIH2'=>'PILIHAN 2 ',
                    'NILAI_AKHIR' => 'NILAI AKHIR'
                );
            }

            if ($tingkatan=='smp')
            {
                $option_db=
                array
                (
                    'showHeadings'=>1,'shaded'=>0,'xPos'=>'center','xOrientation'=>'center','fontSize' => 6,
                    'cols'=>array
                    (//35
                        'NO'=>array
                        (
                            'justification'=>'center',
                            'width'=>'25'
                        ),
                        'NO_PENDAFTARAN'=>array
                        (
                            'justification'=>'center',
                            'width'=>'35'
                        ),
                        'NO_UJIAN'=>array
                        (
                            'justification'=>'center',
                            'width'=>'60'
                        ),
                        'NAMA'=>array
                        (
                            'justification'=>'justify',
                            'width'=>'100'
                        ),
                        'JALUR_DAFTAR'=>array
                        (
                            'justification'=>'justify',
                            'width'=>'0.1'
                        ),
                        'USER_FISIK'=>array
                        (
                            'justification'=>'center',
                            'width'=>'40'
                        ),
                        'LOG_DAFTAR'=>array
                        (
                            'justification'=>'center',
                            'width'=>'80'
                        ),
                        'PILIH1'=>array
                        (
                            'justification'=>'center',
                            'width'=>'80'
                        ),
                        'PILIH2'=>array
                        (
                            'justification'=>'center',
                            'width'=>'80'
                        )
                        ,
                        'NAKHIR_ASLI'=>array
                        (
                            'justification'=>'center',
                            'width'=>'30'
                        )
                    )
                );
            }
            else if ($tingkatan!='smp')
            {
                $option_db=
                array
                (
                'showHeadings'=>1,'shaded'=>0,'xPos'=>'center','xOrientation'=>'center','fontSize' => 6,
                'cols'=>array
                    (
                        'NO'=>array
                        (
                            'justification'=>'center',
                                            'width'=>'25'
                        ),
                        'NO_PENDAFTARAN'=>array
                        (
                            'justification'=>'center',
                            'width'=>'35'
                        ),
                        'NO_UJIAN'=>array
                        (
                            'justification'=>'center',
                                            'width'=>'60'
                        ),
                        'NAMA'=>array
                        (
                            'justification'=>'justify',
                                            'width'=>'100'
                        ),
                        'JALUR_DAFTAR'=>array
                        (
                            'justification'=>'justify',
                            'width'=>'0.1'
                        ),
                        'USER_FISIK'=>array
                        (
                            'justification'=>'center',
                        'width'=>'40'
                        ),
                        'LOG_DAFTAR'=>array
                        (
                            'justification'=>'center',
                                            'width'=>'80'
                        ),
                        'PILIH1'=>array
                        (
                            'justification'=>'center',
                                            'width'=>'80'
                        ),
                        'PILIH2'=>array
                        (
                            'justification'=>'center',
                                            'width'=>'80'
                        )
                        ,
                       'NILAI_AKHIR'=>array
                        (
                            'justification'=>'center',
                                            'width'=>'30'
                        )
                    )
                );
            }

            $pdfku->ezTable( $pendaftar, $cols_db, '', $option_db);

            $option_stream = array(
                'Content-Disposition'=> $nama_sekolah . "-rekap.pdf"
            );
            
//            $option_stream = array(
//                'Content-Disposition'=> "rekap.pdf"
//            );

            $pdfku->ezStream($option_stream);
        }
}
