<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar extends CI_Controller {
    private $nama_user, $id_sekolah, $nama_sekolah, $tingkatan_sekolah, $hak, $terdaftar_terakhir;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('mydb');
        
        if (!($this->nama_user = $this->session->userdata('NAMA_USER'))) redirect('');
        $this->id_sekolah = $this->session->userdata('ID_SEKOLAH');
        $this->nama_sekolah = $this->session->userdata('NAMA_SEKOLAH');
        $this->tingkatan_sekolah = $this->session->userdata('TINGKATAN_SEKOLAH');
        $this->hak = $this->session->userdata('HAK');
        
        $this->load->library('form_validation');
        $this->load->model('m_master_un');
        $this->load->model('m_pendaftar');
        $this->load->model('m_sekolah');
        
        if ($this->uri->segment(2) == 'cetak' || $this->uri->segment(3) == '1')
            $this->session->unset_userdata(array(
                'no_un' => '',
                'tingkatan' => '',
                'pendaftar' => ''
            ));
        
        $this->_load_terdaftar_terakhir();
        
        $this->form_validation->set_message('required', '%s harus diisi.');
        $this->form_validation->set_message('exact_length', '%s harus berisi %s karakter.');
        $this->form_validation->set_message('min_length', '%s harus berisi %s karakter.');
        $this->form_validation->set_message('numeric', '%s harus berisi karakter angka.');
        $this->form_validation->set_message('decimal', '%s harus berupa pecahan desimal dengan separator \'titik\', misal 8.75.');
    }
    
    public function ntmbntk($no_ujian = '') {
        if (!$no_ujian) redirect('');
        //if ($this->hak != 'inputsmk') redirect('');
        $this->form_validation->set_rules('ntmb', 'NTMB', 'decimal|callback__greater_than_equals[0]|callback__less_than_equals[100]');
        $this->form_validation->set_rules('ntk', 'NTK', 'decimal|callback__greater_than_equals[0]|callback__less_than_equals[60]');
        if (!$this->form_validation->run()) {
            $this->m_pendaftar->set_tingkatan('smk');
            $pendaftar = $this->m_pendaftar->read('', array('NO_UJIAN' => $no_ujian), "LEFT(PILIH1, 2) = '$this->id_sekolah'");
            if ($pendaftar->num_rows() == 0) redirect('');
            $data = $pendaftar->row_array();
            $this->load->view('daftar/ntmbntk', $data);
        } else {
            $no_ujian = $this->input->post('no_ujian');
            $nilai_akhir = $this->input->post('nilai_akhir');
            $ntmb = $this->input->post('ntmb');
            $ntk = $this->input->post('ntk');
            $nilai_terpadu = (($nilai_akhir*2) + ($ntmb*2) + $ntk)/5;
            $data_escaped = array(
                'NTMB' => $ntmb,
                'NTK' => $ntk,
                'NILAI_AKHIR' => $nilai_terpadu
            );
            $this->m_pendaftar->set_tingkatan('smk');
            $this->m_pendaftar->update('', $data_escaped, array('NO_UJIAN' => $no_ujian));
            redirect("cari/detail/smk/$no_ujian");
        }
    }
    
    public function baru($step = '') {
        if ($this->hak == 'inputrekom') redirect('');
        if (!$step) redirect('daftar/baru/1');
        switch ($step) {
            case '1':
                $this->_step1();
                break;
            case '2':
                $this->_step2();
                break;
            case '3':
                $this->_step3();
                break;
            case '4':
                $this->_step4();
                break;
            default:
                redirect('');
                break;
        }
    }
    
    public function lalu($step = '') {
        if (strpos($this->hak, 'inputrekom') === false && $this->hak != 'admin') redirect('');
        if (!$step) redirect('daftar/lalu/1');
        switch ($step) {
            case '1':
                $this->_step1();
                break;
            case '2':
                $this->_step2();
                break;
            case '3':
                $this->_step3();
                break;
            case '4':
                $this->_step4();
                break;
            default:
                redirect('');
                break;
        }
    }
    
    public function rekom($step = '') {
        if (strpos($this->hak, 'inputrekom') === false && $this->hak != 'admin') redirect('');
        if (!$step) redirect('daftar/rekom/1');
        switch ($step) {
            case '1':
                $this->_step1();
                break;
            case '2':
                $this->_step2();
                break;
            case '3':
                $this->_step3();
                break;
            case '4':
                $this->_step4();
                break;
            default:
                redirect('');
                break;
        }
    }
    
    public function edit($tingkatan = '', $no_ujian = '', $step = '', $edit = '') {
        if ($this->hak != 'admin')
            redirect('');
        if ($tingkatan == '' || $no_ujian == '' || $step == '')
            redirect('');
        switch ($step) {
            case '1':
                $this->form_validation->set_rules('nama', 'Nama', 'required');
                $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required');
                $this->form_validation->set_rules('jenis_kel', 'Jenis Kelamin', 'required');
                $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required');
                //$this->form_validation->set_rules('alamat', 'Alamat', 'required');
                $this->form_validation->set_rules('nama_ortu', 'Nama Orang Tua', 'required');
                $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required');
                if ($tingkatan != 'smp')
                    $this->form_validation->set_rules('nilai_bing', 'Nilai Bahasa Inggris', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
                $this->form_validation->set_rules('nilai_bind', 'Nilai Bahasa Indonesia', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
                $this->form_validation->set_rules('nilai_mat', 'Nilai Bahasa Matematika', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
                $this->form_validation->set_rules('nilai_ipa', 'Nilai Bahasa IPA', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
                $this->form_validation->set_rules('pilih1', 'Pilihan 1', 'required');
                if (!$this->form_validation->run()) {
                    $this->m_pendaftar->set_tingkatan($tingkatan);
                    if (!$edit)
                        $data = array('pendaftar' => $this->m_pendaftar->read('', array('NO_UJIAN' => $no_ujian))->row());
                    else {
                        $data = array('pendaftar' => (object)$this->session->userdata('pendaftar'));
                        $no_ujian = $this->session->userdata('no_un');
                        $tingkatan = $this->session->userdata('tingkatan');
                    }
                    $data['tingkatan'] = $tingkatan;
                    $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN, NO_TINGKATAN', array('NO_TINGKATAN' => ($tingkatan == 'smp') ? '1' : (($tingkatan == 'sma') ? '2' : (($tingkatan == 'smk') ? '3' : ''))))->result();
                    $data['sekolah'] = array();
                    
                    foreach ($sekolah as $item) {
                        $data['sekolah'][$item->ID_SEKOLAH] = $item;
                    }
                    
                    $data['errors'] = validation_errors('<span>', '</span><br />');
                    $this->load->view('daftar/edit_admin', $data);
                } else {
                    if ($this->input->post('act') == 'Kembali') redirect('');
                    $no_ujian = $this->input->post('no_ujian');
                    $tingkatan = $this->input->post('tingkatan');
                    
                    if ($tingkatan != 'smp') {
                        $pendaftar = array(
                            'NO_PENDAFTARAN' => $this->input->post('no_pen'),
                            'NO_UJIAN' => $no_ujian,
                            'NAMA' => $this->input->post('nama'),
                            'TAHUN_LULUS' => $this->input->post('tahun_lulus'),
                            'JENIS_KEL' => $this->input->post('jenis_kel'),
                            'TMP_LAHIR' => $this->input->post('tmp_lahir'),
                            'TGL_LAHIR' => $this->input->post('tgl_lahir'),
                            'ALAMAT' => $this->input->post('alamat'),
                            'KOTA' => $this->input->post('kota'),
                            'NO_TELP' => $this->input->post('no_telp'),
                            'DOMISILI' => $this->input->post('domisili'),
                            'NAMA_ORTU' => $this->input->post('nama_ortu'),
                            'ASAL_SEKOLAH' => $this->input->post('asal_sekolah'),
                            'KOTA_ASAL_SEKOLAH' => $this->input->post('kota_asal_sekolah'),
                            'JALUR_DAFTAR' => $this->input->post('jalur_daftar'),
                            'PILIH1' => $this->input->post('pilih1'),
                            'PILIH2' => $this->input->post('pilih2'),

                            'UAN_BIND' => $this->input->post('nilai_bind'),
                            'UAN_MAT' => $this->input->post('nilai_mat'),
                            'UAN_IPA' => $this->input->post('nilai_ipa'),
                            'NUN_ASLI' => $this->input->post('nun_asli'),

                                'RAP_BIND' => $this->input->post('nilai_bind2'),
                                'RAP_MAT' => $this->input->post('nilai_mat2'),
                                'RAP_IPA' => $this->input->post('nilai_ipa2'),
                                'NRAP_ASLI' => $this->input->post('nrap_asli'),

                                'AKHIR_BIND' => $this->input->post('nilai_bind3'),
                                'AKHIR_MAT' => $this->input->post('nilai_mat3'),
                                'AKHIR_IPA' => $this->input->post('nilai_ipa3'),
                                'NAKHIR_ASLI' => $this->input->post('nakhir_asli'),

                            'IP_ADDRESS' => $_SERVER['REMOTE_ADDR'],
                            'USER_FISIK' => $this->nama_user,
                            'ID_SEKOLAH' => $this->id_sekolah,
                            'NO_TINGKATAN' => ($tingkatan == 'smp') ? '1' : (($tingkatan == 'sma') ? '2' : (($tingkatan == 'smk') ? '3' : '')),
                            'ALASAN_PERUBAHAN' => $this->input->post('alasan_perubahan')
                        );
                    }
                    elseif ($tingkatan == 'smp') {
                        $pendaftar = array(
                            'NO_PENDAFTARAN' => $this->input->post('no_pen'),
                            'NO_UJIAN' => $no_ujian,
                            'NAMA' => $this->input->post('nama'),
                            'TAHUN_LULUS' => $this->input->post('tahun_lulus'),
                            'JENIS_KEL' => $this->input->post('jenis_kel'),
                            'TMP_LAHIR' => $this->input->post('tmp_lahir'),
                            'TGL_LAHIR' => $this->input->post('tgl_lahir'),
                            'ALAMAT' => $this->input->post('alamat'),
                            'KOTA' => $this->input->post('kota'),
                            'NO_TELP' => $this->input->post('no_telp'),
                            'DOMISILI' => $this->input->post('domisili'),
                            'NAMA_ORTU' => $this->input->post('nama_ortu'),
                            'ASAL_SEKOLAH' => $this->input->post('asal_sekolah'),
                            'KOTA_ASAL_SEKOLAH' => $this->input->post('kota_asal_sekolah'),
                            'JALUR_DAFTAR' => $this->input->post('jalur_daftar'),
                            'PILIH1' => $this->input->post('pilih1'),
                            'PILIH2' => $this->input->post('pilih2'),

                            'UAN_BIND' => $this->input->post('nilai_bind'),
                            'UAN_MAT' => $this->input->post('nilai_mat'),
                            'UAN_IPA' => $this->input->post('nilai_ipa'),
                            'NUN_ASLI' => $this->input->post('nun_asli'),

                            'RAP_BIND' => $this->input->post('nilai_bind2'),
                            'RAP_MAT' => $this->input->post('nilai_mat2'),
                            'RAP_IPA' => $this->input->post('nilai_ipa2'),
                            'NRAP_ASLI' => $this->input->post('nrap_asli'),

                            'AKHIR_BIND' => $this->input->post('nilai_bind3'),
                            'AKHIR_MAT' => $this->input->post('nilai_mat3'),
                            'AKHIR_IPA' => $this->input->post('nilai_ipa3'),
                            'NAKHIR_ASLI' => $this->input->post('nakhir_asli'),

                            'IP_ADDRESS' => $_SERVER['REMOTE_ADDR'],
                            'USER_FISIK' => $this->nama_user,
                            'ID_SEKOLAH' => $this->id_sekolah,
                            'NO_TINGKATAN' => ($tingkatan == 'smp') ? '1' : (($tingkatan == 'sma') ? '2' : (($tingkatan == 'smk') ? '3' : '')),
                            'ALASAN_PERUBAHAN' => $this->input->post('alasan_perubahan')
                        );
                    }
                    
                    if ($tingkatan != 'smp') {
                        $pendaftar['UAN_BING'] = $this->input->post('nilai_bing');
                        if (!$pendaftar['NUN_ASLI']) $pendaftar['NUN_ASLI'] = $pendaftar['UAN_BIND']+$pendaftar['UAN_MAT']+$pendaftar['UAN_IPA']+$pendaftar['UAN_BING'];
                    }
                    if (!$pendaftar['NUN_ASLI']) $pendaftar['NUN_ASLI'] = $pendaftar['UAN_BIND']+$pendaftar['UAN_MAT']+$pendaftar['UAN_IPA'];
                    //if ($tingkatan != 'smk') {
                        $pendaftar['NILAI_AKHIR'] = $pendaftar['NUN_ASLI'];
//                    } else {
//                        $pendaftar['NTMB'] = $this->input->post('ntmb');
//                        $pendaftar['NTK'] = $this->input->post('ntk');
//                        $pendaftar['NILAI_AKHIR'] = (($pendaftar['NUN_ASLI']*2) + ($pendaftar['NTMB']*2) + $pendaftar['NTK'])/5;
//                    }
                    $this->session->set_userdata('pendaftar', $pendaftar);
                    $this->session->set_userdata('no_un', $no_ujian);
                    $this->session->set_userdata('tingkatan', $tingkatan);
                    redirect("daftar/edit/$tingkatan/$no_ujian/2");
                }
                break;
            case '2':
                $data = $this->session->userdata('pendaftar');
                $no_ujian = $this->session->userdata('no_un');
                $tingkatan = $this->session->userdata('tingkatan');
                if (!$data || !$no_ujian || !$tingkatan) redirect('');
                if (!($act = $this->input->post('act'))) {
                    $data['tingkatan'] = $tingkatan;
                    $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN, NO_TINGKATAN', array('NO_TINGKATAN' => ($tingkatan == 'smp') ? '1' : (($tingkatan == 'sma') ? '2' : (($tingkatan == 'smk') ? '3' : ''))))->result();
                    $data['sekolah'] = array();
                    foreach ($sekolah as $item) {
                        $data['sekolah'][$item->ID_SEKOLAH] = $item;
                    }
                    $this->load->view('daftar/konfirmasi_admin', $data);
                }
                if ($act == 'Edit') redirect("daftar/edit/$tingkatan/$no_ujian/1/edit");
                if ($act == 'Simpan') redirect("daftar/edit/$tingkatan/$no_ujian/3");
                break;
            case '3':
                $data = $this->session->userdata('pendaftar');
                $no_ujian = $this->session->userdata('no_un');
                $tingkatan = $this->session->userdata('tingkatan');
                $this->session->unset_userdata('pendaftar');
                $this->session->unset_userdata('no_un');
                $this->session->unset_userdata('tingkatan');
                if (!$data || !$no_ujian || !$tingkatan) redirect('');
                $data_escaped = array(
                    'UAN_BIND' => $data['UAN_BIND'],
                    'UAN_MAT' => $data['UAN_MAT'],
                    'UAN_IPA' => $data['UAN_IPA'],
                    'NUN_ASLI' => $data['NUN_ASLI'],
                    'LOG_DAFTAR' => 'NOW()'
                );
                unset($data['UAN_BIND']);
                unset($data['UAN_MAT']);
                unset($data['UAN_IPA']);
                unset($data['NUN_ASLI']);
                
                $data['NAMA'] = strtoupper($data['NAMA']);
                $data['ALAMAT'] = strtoupper($data['ALAMAT']);
                $data['KOTA'] = strtoupper($data['KOTA']);
                $data['NAMA_ORTU'] = strtoupper($data['NAMA_ORTU']);
                $data['ASAL_SEKOLAH'] = strtoupper($data['ASAL_SEKOLAH']);
                $data['KOTA_ASAL_SEKOLAH'] = strtoupper($data['KOTA_ASAL_SEKOLAH']);
                $this->m_pendaftar->set_tingkatan($tingkatan);
                $this->m_pendaftar->update($data, $data_escaped, array('no_ujian' => $no_ujian));
                
                $data = $this->m_pendaftar->read('', array('NO_UJIAN' => $no_ujian))->row_array();
                
                $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN, NO_TINGKATAN', array('NO_TINGKATAN' => ($tingkatan == 'smp') ? '1' : (($tingkatan == 'sma') ? '2' : (($tingkatan == 'smk') ? '3' : ''))))->result();
                $data['sekolah'] = array();
                
                foreach ($sekolah as $item) {
                    $data['sekolah'][$item->ID_SEKOLAH] = $item;
                    //if ($item->ID_SEKOLAH >= 7000)
                      //  $data['sekolah'][substr($item->ID_SEKOLAH, 2)] = $item;
                }
                $data['tingkatan'] = $tingkatan;
                $this->load->view('daftar/sukses_admin', $data);
                break;
        }
    }

    function _step1() {
        if ($this->uri->segment(2) == 'baru') {
            $this->form_validation->set_rules('no_un', 'Nomor Ujian', 'required|exact_length[9]|numeric');
        }
        else {
//            $this->form_validation->set_rules('no_un', 'Nomor Ujian', 'required|exact_length[9]|numeric');
            $this->form_validation->set_rules('no_un', 'Nomor Ujian', 'required|exact_length[14]|numeric');   //14 digit?
        }
        
        if (!$this->form_validation->run()) {
//        echo $this->uri->segment(2).'=test';
            $data = array(
                'no_un' => '',
                'tingkatan' => ''
            );
            $this->session->unset_userdata($data);
            $data['errors'] = validation_errors('<span>', '</span><br />');
            
            $data['_noun'] = 'Nomor UN:';
            $data['_jenjang'] = 'Jenjang Pilihan:';

            if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
            
            if ($this->uri->segment(2) == 'baru') {
                $this->load->view('daftar/edit', $data);
            }
            else {
                $this->load->view('daftar/manual', $data);
            }
        } 
        
        else {
            $data = array(
                'no_un' => $this->input->post('no_un'),
                'tingkatan' => $this->input->post('tingkatan')
            );
            
            $this->session->set_userdata($data);

            $this->m_pendaftar->set_tingkatan($data['tingkatan']);
            $data['terdaftar'] = $this->m_pendaftar->read('', array('NO_UJIAN' => $data['no_un']));
            
            if ($data['terdaftar']->num_rows() == 0 && $data['tingkatan'] != 'smp') {
                $tingkatan_terdaftar = ($data['tingkatan'] == 'sma') ? 'smk' : 'sma';
                $this->m_pendaftar->set_tingkatan($tingkatan_terdaftar);
                $data['terdaftar'] = $this->m_pendaftar->read('', array('NO_UJIAN' => $data['no_un']));
                if ($data['terdaftar']->num_rows() == 0) {
                    $tingkatan_terdaftar = ($tingkatan_terdaftar == 'sma') ? 'smk' : 'sma';
                    $this->m_pendaftar->set_tingkatan($tingkatan_terdaftar);
                    $data['terdaftar'] = $this->m_pendaftar->read('', array('NO_UJIAN' => $data['no_un']));
                }
            }
            
            if ($data['terdaftar']->num_rows() != 0) {
                $data['terdaftar'] = $data['terdaftar']->row_array();
                $data['terdaftar']['tingkatan'] = $data['tingkatan'];
                $data['errors'] = 'Peserta sudah terdaftar.';
                $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN, NO_TINGKATAN', '', 'ID_SEKOLAH = '.$data['terdaftar']['PILIH1'].(($data['terdaftar']['PILIH2']) ? ' OR ID_SEKOLAH = '.$data['terdaftar']['PILIH2'] : '').' OR LEFT(ID_SEKOLAH, 2) = '.substr($data['terdaftar']['ID_SEKOLAH'], 0, 2))->result();
                
                foreach ($sekolah as $item) {
                    $data['terdaftar']['sekolah'][$item->ID_SEKOLAH] = $item;
                }
                
                $data['_noun'] = 'Nomor UN:';
                $data['_pendaftaran'] = 'Nomor Pendaftaran:';
                $data['_jenjang'] = 'Jenjang Pilihan:';
                $data['_nama'] = 'Nama:';
                $data['_lulus'] = 'Tahun Lulus:';
                $data['_kelamin'] = 'Jenis Kelamin:';
                $data['_lahir'] = 'Tempat, Tanggal Lahir:';
                $data['_alamat'] = 'Alamat Rumah:';
                $data['_kota'] = 'Kota/Kab:';
                $data['_domisili'] = 'No.KK/Domisili:';
                $data['_ortu'] = 'Nama Orang Tua:';
                $data['_sekolah'] = 'Sekolah Asal:';
                $data['_kota2'] = 'Kota/Kab:';
                $data['_nilai'] = 'Rata-Rata Nilai US:';
                $data['_nilai2'] = 'Nilai Test:';
                $data['_nilaiRAP'] = 'Rata-Rata Nilai Rapor:';
                $data['_nilaiakhir'] = 'Nilai Sekolah:';
                $data['_mendaftar'] = 'Mendaftar di:';
                $data['_telp'] = 'No Telepon:';
                $data['_pilihan'] = 'Pilihan ';
        
                if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
                if ($this->uri->segment(2) == 'baru') $this->load->view('daftar/edit', $data);
                
                else {
                    $this->load->view('daftar/manual', $data);
                }
                return;
                
            } else
                unset($data['terdaftar']);

            if ($this->uri->segment(2) == 'baru' ) {
                $this->m_master_un->set_tingkatan(($this->tingkatan_sekolah == '1') ? 'sd' : 'smp');
                $data['pendaftar'] = $this->m_master_un->read('', array('NO_UJIAN' => $data['no_un']));
                
                $data['_noun'] = 'Nomor UN:';
                $data['_jenjang'] = 'Jenjang Pilihan:';

                if ($data['pendaftar']->num_rows() == 0) {
                    $data['errors'] = 'Nomor ujian tidak ditemukan.';
                    if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
                    unset($data['pendaftar']);
                    $this->load->view('daftar/edit', $data);
                    return;
                    
                } else {
                    $data['pendaftar'] = $data['pendaftar']->row_array();
                    $data['pendaftar']['UAN_BIND'] = $data['pendaftar']['BIND'];
                    $data['pendaftar']['UAN_MAT'] = $data['pendaftar']['MAT'];
                    if ($data['tingkatan'] != 'smp')
                        $data['pendaftar']['UAN_BING'] = $data['pendaftar']['BING'];
                    $data['pendaftar']['UAN_IPA'] = $data['pendaftar']['IPA'];
                    if ($data['tingkatan'] == 'smk') {
                        $data['pendaftar']['NTMB'] = '';
                        $data['pendaftar']['NTK'] = '';
                    }
                    $data['pendaftar']['PILIH1'] = '';
                    $data['pendaftar']['PILIH2'] = '';
                    
                    
                    
                    $this->session->set_userdata(array('pendaftar' => $data['pendaftar']));
                }
            }
//print_r($data['pendaftar']);
            redirect('daftar/'.$this->uri->segment(2).'/2');
        }
    }
    
    function _step2() {
        $data = array(
            'no_un' => $this->session->userdata('no_un'),
            'tingkatan' => $this->session->userdata('tingkatan')
        );
        
        if (!$data['no_un']) redirect('daftar/'.$this->uri->segment(2).'/1');
        
        $endname = '1';
        
        if ($this->uri->segment(2) != 'baru') {
            $endname = '';
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required');
            $this->form_validation->set_rules('jenis_kel', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('tmp_lahir', 'Tempat Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            
            $this->form_validation->set_rules('kota', 'Kota', 'required');
            $this->form_validation->set_rules('nama_ortu', 'Nama Orang Tua', 'required');
            $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required');
            $this->form_validation->set_rules('kota_asal_sekolah', 'Kota Asal Sekolah', 'required');
            if ($data['tingkatan'] != 'smp')
                $this->form_validation->set_rules('nilai_bing', 'Nilai Bahasa Inggris', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');

            $this->form_validation->set_rules('nilai_bind', 'Nilai Bahasa Indonesia', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
            $this->form_validation->set_rules('nilai_mat', 'Nilai Bahasa Matematika', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
            $this->form_validation->set_rules('nilai_ipa', 'Nilai Bahasa IPA', 'required|decimal|callback__greater_than_equals[0]|callback__less_than_equals[10]');
            //$this->form_validation->set_rules('nun_asli', ($this->uri->segment(2) == 'lalu') ? 'NUN' : 'Nilai Akhir', 'required|decimal');
             // $this->form_validation->set_rules('no_pen', 'Nomor Pendaftaran', 'required');
        }
        $this->form_validation->set_rules('no_pen', 'Nomor Pendaftaran', 'required');
        $this->form_validation->set_rules('pilih1', 'Pilihan 1', 'required');
        if ($this->hak == 'inputrekom')
            $this->form_validation->set_rules('domisili', 'Domisili', 'required');

        if (!$this->form_validation->run()) {
            $data['errors'] = validation_errors('<span>', '</span><br />');
            $this->m_pendaftar->set_tingkatan($data['tingkatan']);
            
            if (($data['pendaftar'] = $this->session->userdata('pendaftar'))) {
                $tgl_lahir = explode('-', $data['pendaftar']['TGL_LAHIR']);
                $data['pendaftar']['TGL_LAHIR'] = $tgl_lahir[2].'/'.$tgl_lahir[1].'/'.$tgl_lahir[0];
                $data['pendaftar'] = (object)$data['pendaftar'];
            } 
            
            else unset($data['pendaftar']);
            
            $tingkatan_kode = ($data['tingkatan'] == 'smp') ? '1' : (($data['tingkatan'] == 'sma') ? '2' : (($data['tingkatan'] == 'smk') ? '3' : ''));
            $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN, NO_RUMPUN', ($this->tingkatan_sekolah == '3' && strpos($this->hak, 'inputrekom') === false) ? array('LEFT(ID_SEKOLAH, 2) =' => $this->id_sekolah) : array('NO_TINGKATAN' => $tingkatan_kode))->result();
            
            $data['sekolah'] = array();
            
            $data['no_pen_sekolah'] =$this->id_sekolah;

            $data['_noun'] = 'Nomor UN:';
            $data['_pendaftaran'] = 'Nomor Pendaftaran:';
            $data['_jenjang'] = 'Jenjang Pilihan:';
            $data['_nama'] = 'Nama:';
            $data['_lulus'] = 'Tahun Lulus:';
            $data['_kelamin'] = 'Jenis Kelamin:';
            $data['_lahir'] = 'Tempat, Tanggal Lahir:';
            $data['_alamat'] = 'Alamat Rumah:';
            $data['_kota'] = 'Kota/Kab:';
            $data['_domisili'] = 'No.KK:';
            $data['_ortu'] = 'Nama Orang Tua:';
            $data['_sekolah'] = 'Sekolah Asal:';
            $data['_kota2'] = 'Kota/Kab:';
            $data['_nilai'] = 'Nilai UN:';
            $data['_nilai2'] = 'Nilai Test:';
            $data['_nilaiRAP'] = 'Rata-Rata Nilai Rapor:';
            $data['_nilaiakhir'] = 'Nilai Sekolah:';
            $data['_mendaftar'] = 'Mendaftar di:';
            $data['_telp'] = 'No Telepon:';
            $data['_pilihan'] = 'Pilihan ';
            $data['_jalur'] =$this->uri->segment(2);
            
            foreach ($sekolah as $item) {
                $data['sekolah'][$item->ID_SEKOLAH] = $item;
            }
            
            if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
	
<<<<<<< HEAD
//print_r($data);	
=======
>>>>>>> 828a95304b2aeb7a8c8b1b65255fc7da080a74ec
            if ($this->uri->segment(2) == 'baru' || isset($data['pendaftar'])) 
            {
                
                $this->load->view('daftar/edit', $data);
            }
            
            else 
            {
                $this->load->view('daftar/manual', $data);
            }
        } 
            
        else {
            if ($this->input->post('act') == 'Simpan') $this->session->unset_userdata(array('pendaftar' => ''));
            
            if (is_array($this->input->post('tgl_lahir'.$endname))) {
                $tgl_lahir = implode('-', array_reverse($this->input->post('tgl_lahir'.$endname)));
            } 
            
            else {
                $tgl_lahir = explode('/', $this->input->post('tgl_lahir'.$endname));
                $tgl_lahir = $tgl_lahir[2].'-'.$tgl_lahir[1].'-'.$tgl_lahir[0];
            }
            
            

            $pendaftar = array(
                'NO_PENDAFTARAN' => $this->input->post('no_pen'),
                'NO_UJIAN' => $data['no_un'],
                'NAMA' => $this->input->post('nama'.$endname),
                'TAHUN_LULUS' => $this->input->post('tahun_lulus'.$endname),
                'JENIS_KEL' => $this->input->post('jenis_kel'.$endname),
                'TMP_LAHIR' => $this->input->post('tmp_lahir'.$endname),
                'TGL_LAHIR' => $tgl_lahir,
                'ALAMAT' => $this->input->post('alamat'.$endname),
                'KOTA' => $this->input->post('kota'),
                'NO_TELP' => $this->input->post('no_telp'),
                'DOMISILI' => $this->input->post('domisili'),
                'NAMA_ORTU' => $this->input->post('nama_ortu'.$endname),
                'ASAL_SEKOLAH' => $this->input->post('asal_sekolah'.$endname),
                'KOTA_ASAL_SEKOLAH' => $this->input->post('kota_asal_sekolah'.$endname),
                'JALUR_DAFTAR' => ($this->uri->segment(2) == 'baru') ? '1' : (($this->uri->segment(2) == 'lalu') ? '0' : '2'),
                'PILIH1' => $this->input->post('pilih1'),
                'PILIH2' => $this->input->post('pilih2'),

                'UAN_BIND' => $this->input->post('nilai_bind'.$endname),
                'UAN_MAT' => $this->input->post('nilai_mat'.$endname),
                'UAN_IPA' => $this->input->post('nilai_ipa'.$endname),
               'NUN_ASLI' => $this->input->post('nun_asli'.$endname),

                // 'RAP_BIND' => $this->input->post('nilai_bind2'.$endname),
                // 'RAP_MAT' => $this->input->post('nilai_mat2'.$endname),
                // 'RAP_IPA' => $this->input->post('nilai_ipa2'.$endname),
                // 'NRAP_ASLI' => $this->input->post('nrap_asli'.$endname),
               
                // 'AKHIR_BIND' => $this->input->post('nilai_bind3'.$endname),
                // 'AKHIR_MAT' => $this->input->post('nilai_mat3'.$endname),
                // 'AKHIR_IPA' => $this->input->post('nilai_ipa3'.$endname),
                // 'NAKHIR_ASLI' => $this->input->post('nakhir_asli'.$endname),

                'IP_ADDRESS' => $_SERVER['REMOTE_ADDR'],
                'USER_FISIK' => $this->nama_user,
                'ID_SEKOLAH' => $this->id_sekolah,
                'NO_TINGKATAN' => ($data['tingkatan'] == 'smp') ? '1' : (($data['tingkatan'] == 'sma') ? '2' : (($data['tingkatan'] == 'smk') ? '3' : ''))
            );

            
            if($data['tingkatan']=='smp'){

                $pendaftar['RAP_BIND'] = $this->input->post('nilai_bind2');
                $pendaftar['RAP_MAT'] = $this->input->post('nilai_mat2');
                $pendaftar['RAP_IPA'] = $this->input->post('nilai_ipa2');
                $pendaftar['NRAP_ASLI'] = $pendaftar['RAP_BIND']+$pendaftar['RAP_MAT']+$pendaftar['RAP_IPA']; 
                $pendaftar['FLAG_ALASAN'] = $this->input->post('flag');                   
                $pendaftar['ALASAN'] = $this->input->post('alasan');
                // echo "lalala";
                // print_r($pendaftar);
                // echo "lalala";
                if (!$pendaftar['NRAP_ASLI']) $pendaftar['NRAP_ASLI'] = $pendaftar['RAP_BIND']+$pendaftar['RAP_MAT']+$pendaftar['RAP_IPA'];                     

                $pendaftar['AKHIR_BIND'] =$pendaftar['UAN_BIND']*0.3+$pendaftar['RAP_BIND']*0.7;
                $pendaftar['AKHIR_MAT'] = $pendaftar['UAN_MAT']*0.3+$pendaftar['RAP_MAT']*0.7;
                $pendaftar['AKHIR_IPA'] = $pendaftar['UAN_IPA']*0.3+$pendaftar['RAP_IPA']*0.7;
                $pendaftar['NUN_ASLI']=$pendaftar['UAN_BIND']+$pendaftar['UAN_MAT']+$pendaftar['UAN_IPA'];
                $pendaftar['NAKHIR_ASLI'] = $pendaftar['NUN_ASLI']*0.3 + $pendaftar['NRAP_ASLI']*0.7;

                $pendaftar['NAKHIR_ASLI'] = $pendaftar['NUN_ASLI']*0.3 + $pendaftar['NRAP_ASLI']*0.7;
                if (!$pendaftar['NAKHIR_ASLI']) $pendaftar['NAKHIR_ASLI'] =  $pendaftar['NUN_ASLI']*0.3 + $pendaftar['NRAP_ASLI']*0.7;           }
            
            if ($data['tingkatan'] != 'smp') {
                $pendaftar['UAN_BING'] = $this->input->post('nilai_bing'.$endname);
                if (!$pendaftar['NUN_ASLI']) $pendaftar['NUN_ASLI'] = $pendaftar['UAN_BIND']+$pendaftar['UAN_MAT']+$pendaftar['UAN_IPA']+$pendaftar['UAN_BING'];
            }
            
            if (!$pendaftar['KOTA'])
            {
                $pendaftar['KOTA'] = 'SIDOARJO';
            }
            
            // if (!$pendaftar['NUN_ASLI']) $pendaftar['NUN_ASLI'] = $pendaftar['UAN_BIND']+$pendaftar['UAN_MAT']+$pendaftar['UAN_IPA'];
           // if ($data['tingkatan'] != 'smk') {
            if ($data['tingkatan'] == 'smp')
            {
                $pendaftar['NILAI_AKHIR'] = $pendaftar['NUN_ASLI']*0.3 + $pendaftar['NRAP_ASLI']*0.7;

                
            }

            else $pendaftar['NILAI_AKHIR'] = $pendaftar['NUN_ASLI'];

            
//            } else {
//                $pendaftar['NTMB'] = $this->input->post('ntmb');
//                $pendaftar['NTK'] = $this->input->post('ntk');
//                $pendaftar['NILAI_AKHIR'] = (($pendaftar['NUN_ASLI']*2) + ($pendaftar['NTMB']*2) + $pendaftar['NTK'])/5;
//            }
 	      $NO_PENDAFTARAN=$this->input->post('no_pen');
            $NO_PENDAFTARAN_FLAG=$this->m_pendaftar->cekdaftar($NO_PENDAFTARAN, $data['tingkatan']);
            $data = array('pendaftar' => $pendaftar);
            $this->session->set_userdata($data);
            if ($NO_PENDAFTARAN_FLAG>0){
                $this->session->set_flashdata('error','No Pendaftaran sudah dipakai');
                
                redirect('daftar/'.$this->uri->segment(2).'/2');   
            }
                
               
               

//<<<<<<< HEAD

  //         print_r($this->session->userdata('pendaftar'));
//=======
                 // print_r($this->session->userdata('pendaftar'));
//>>>>>>> 2b442198c9162ef41157a2b9fbe28ad705d78da3
                redirect('daftar/'.$this->uri->segment(2).'/3');
            }
            
    }
    
    function _step3() {
        
        if (!$this->session->userdata('no_un')) redirect('daftar/'.$this->uri->segment(2).'/1');
        ($this->session->userdata('error'));

        $data = $this->session->userdata('pendaftar');
        // print_r($data);
        $data['_pendaftaran'] = 'Nomor Pendaftaran:';
        $data['_noun'] = 'Nomor UN:';
        $data['_jenjang'] = 'Jenjang Pilihan:';
        $data['_nama'] = 'Nama:';
        $data['_lulus'] = 'Tahun Lulus:';
        $data['_kelamin'] = 'Jenis Kelamin:';
        $data['_lahir'] = 'Tempat, Tanggal Lahir:';
        $data['_alamat'] = 'Alamat Rumah:';
        $data['_kota'] = 'Kota/Kab(domisili):';
        $data['_domisili'] = 'No.KK:';
        $data['_ortu'] = 'Nama Orang Tua:';
        $data['_sekolah'] = 'Sekolah Asal:';
        $data['_kota2'] = 'Kota/Kab:';
        $data['_nilai'] = 'Nilai UN:';
        $data['_nilai2'] = 'Nilai Test:';
        $data['_nilaiRAP'] = 'Rata-Rata Nilai Rapor:';
        $data['_nilaiakhir'] = 'Nilai Sekolah:';
        $data['_mendaftar'] = 'Mendaftar di:';
        $data['_telp'] = 'No Telepon:';
        $data['_pilihan'] = 'Pilihan ';
        
        if (!$data) redirect('daftar/'.$this->uri->segment(2).'/1');
        if ($this->input->post('act') == 'Daftar') {
            $this->session->set_userdata(array('konfirmdaftar' => '1'));
            redirect('daftar/'.$this->uri->segment(2).'/4');
        } if ($this->input->post('act') == 'Batal') {
            redirect('daftar/'.$this->uri->segment(2).'/1');
        } if ($this->input->post('act') == 'Edit') {
            redirect('daftar/'.$this->uri->segment(2).'/2');
        } else {
            // echo 'ini'.$this->input->post('Nama');
            $data['tingkatan'] = $this->session->userdata('tingkatan');
            $tingkatan_kode = ($data['tingkatan'] == 'smp') ? '1' : (($data['tingkatan'] == 'sma') ? '2' : (($data['tingkatan'] == 'smk') ? '3' : ''));
            $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN', array('NO_TINGKATAN' => $tingkatan_kode))->result();
            $data['sekolah'] = array();
            
            foreach ($sekolah as $item) {
                $data['sekolah'][$item->ID_SEKOLAH] = $item;
            }
            if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
            
 
            // if($data['tingkatan']=='smp')$data['_nilai'] = 'Nilai Akhir:';
            if($data['tingkatan']=='smp')$data['_nilaiakhir'] = 'Nilai Akhir:';
            $this->load->view('daftar/konfirmasi', $data);
//	print_r($data);
        }
    }
    
    function _step4() {
        
        if (!$this->session->userdata('no_un')) redirect('daftar/'.$this->uri->segment(2).'/1');
        $data = $this->session->userdata('pendaftar');
        // var_dump($this->session->userdata);
        if (!$data) redirect('daftar/'.$this->uri->segment(2).'/1');

        if($data['NO_TINGKATAN'] != 1){
            $data_escaped = array(
                'UAN_BIND' => $data['UAN_BIND'],
                'UAN_MAT' => $data['UAN_MAT'],
                'UAN_IPA' => $data['UAN_IPA'],
                'NUN_ASLI' => $data['NUN_ASLI'],
                'WAKTU_DAFTAR' => 'CURDATE()',
                'LOG_DAFTAR' => 'NOW()'
            );
        }

        elseif ($data['NO_TINGKATAN'] == 1) {
            $data_escaped = array(
            'UAN_BIND' => $data['UAN_BIND'],
            'UAN_MAT' => $data['UAN_MAT'],
            'UAN_IPA' => $data['UAN_IPA'],
            'NUN_ASLI' => $data['NUN_ASLI'], 
            'RAP_BIND' => $data['RAP_BIND'],
            'RAP_MAT' => $data['RAP_MAT'],
            'RAP_IPA' => $data['RAP_IPA'],
            'NRAP_ASLI' => $data['NRAP_ASLI'],
            'AKHIR_BIND' => $data['AKHIR_BIND'],
            'AKHIR_MAT' => $data['AKHIR_MAT'],
            'AKHIR_IPA' => $data['AKHIR_IPA'],
            'NAKHIR_ASLI' => $data['NAKHIR_ASLI'],
            'WAKTU_DAFTAR' => 'CURDATE()',
            'LOG_DAFTAR' => 'NOW()',
            'FLAG_ALASAN' => $data['FLAG_ALASAN']
            );
        }
        
        unset($data['UAN_BIND']);
        unset($data['UAN_MAT']);
        unset($data['UAN_IPA']);
        unset($data['NUN_ASLI']);
        
        if ($data['NO_TINGKATAN'] == 1){
            unset($data['RAP_BIND']);
            unset($data['RAP_MAT']);
            unset($data['RAP_IPA']);
            unset($data['NRAP_ASLI']);

            unset($data['AKHIR_BIND']);
            unset($data['AKHIR_MAT']);
            unset($data['AKHIR_IPA']);
            unset($data['NAKHIR_ASLI']);
            unset($data['FLAG_ALASAN']);
        }

        $data['NAMA'] = strtoupper($data['NAMA']);
        $data['NO_PENDAFTARAN'] = strtoupper($data['NO_PENDAFTARAN']);
        $data['ALAMAT'] = strtoupper($data['ALAMAT']);
        $data['KOTA'] = strtoupper($data['KOTA']);
        $data['NAMA_ORTU'] = strtoupper($data['NAMA_ORTU']);
        $data['ASAL_SEKOLAH'] = strtoupper($data['ASAL_SEKOLAH']);
        $data['KOTA_ASAL_SEKOLAH'] = strtoupper($data['KOTA_ASAL_SEKOLAH']);
        
        if($this->uri->segment(2) == 'rekom')
        {
            if (strpos($data['KOTA'],'SIDOARJO') !== false) 
            {
                $data['JALUR_DAFTAR'] = '21';
            }
            else $data['JALUR_DAFTAR'] = '22';
        }
        
        $tingkatan = $this->session->userdata('tingkatan');
        if ($this->session->userdata('konfirmdaftar')) {
            $this->session->unset_userdata(array('konfirmdaftar' => ''));
            
            $this->m_pendaftar->set_tingkatan($tingkatan);
            
            $data['terdaftar'] = $this->m_pendaftar->read('', array('NO_UJIAN' => $data['NO_UJIAN']));
            if ($data['terdaftar']->num_rows() == 0 && $tingkatan != 'smp') {
                $tingkatan_terdaftar = ($tingkatan == 'sma') ? 'sma' : 'smk';
                $this->m_pendaftar->set_tingkatan($tingkatan_terdaftar);
                $data['terdaftar'] = $this->m_pendaftar->read('', array('NO_UJIAN' => $data['NO_UJIAN']));
                if ($data['terdaftar']->num_rows() == 0) {
                    $tingkatan_terdaftar = ($tingkatan_terdaftar == 'sma') ? 'sma' : 'smk';
                    $this->m_pendaftar->set_tingkatan($tingkatan_terdaftar);
                    $data['terdaftar'] = $this->m_pendaftar->read('', array('NO_UJIAN' => $data['NO_UJIAN']));
                }
            }
            
            if ($data['terdaftar']->num_rows() != 0) {
                $data['terdaftar'] = $data['terdaftar']->row_array();
                $data['terdaftar']['tingkatan'] = $tingkatan;
                $data['errors'] = 'Peserta sudah terdaftar.';
                
                $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN, NO_TINGKATAN', '', 'ID_SEKOLAH = '.$data['terdaftar']['PILIH1'].(($data['terdaftar']['PILIH2']) ? ' OR ID_SEKOLAH = '.$data['terdaftar']['PILIH2'] : '').' OR LEFT(ID_SEKOLAH, 2) = '.substr($data['terdaftar']['ID_SEKOLAH'], 0, 2))->result();
                
                foreach ($sekolah as $item) {
                    $data['terdaftar']['sekolah'][$item->ID_SEKOLAH] = $item;
                }
                
                if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
                $data['no_un'] = $data['NO_UJIAN'];
                $data['tingkatan'] = $tingkatan;
                if ($this->uri->segment(2) == 'baru') $this->load->view('daftar/edit', $data);
                else $this->load->view('daftar/manual', $data);
                return;
            } else
                unset($data['terdaftar']);
            
            $this->m_pendaftar->set_tingkatan($tingkatan);
            echo "<pre>";
            // var_dump($data);
            // var_dump($data_escaped);
            echo "</pre>";
            $pid = $this->m_pendaftar->create($data, $data_escaped);
            $this->session->set_userdata(array('terdaftar_terakhir' => array('pid' => $pid, 'tingkatan' => $tingkatan)));
        }
        
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $data = $this->m_pendaftar->read('', array('PID' => $pid))->row_array();
        $data['tingkatan'] = $tingkatan;
        $this->session->unset_userdata(array('no_un' => '', 'tingkatan' => '', 'pendaftar' => ''));
        $sekolah = $this->m_sekolah->read()->result();
        $tingkatan_kode = ($data['tingkatan'] == 'smp') ? '1' : (($data['tingkatan'] == 'sma') ? '2' : (($data['tingkatan'] == 'smk') ? '3' : ''));
        
        $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN')->result();
        $data['sekolah'] = array();
        
        foreach ($sekolah as $item) {
            $data['sekolah'][$item->ID_SEKOLAH] = $item;
        }
        
        $data['hak'] = $this->hak;
        
        if ($this->terdaftar_terakhir != null) $data['terdaftar_terakhir'] = $this->terdaftar_terakhir;
        
        $this->load->view('daftar/sukses', $data);
    }
    
    function _load_terdaftar_terakhir() {
        if (($this->terdaftar_terakhir = $this->session->userdata('terdaftar_terakhir'))) {
            $this->m_pendaftar->set_tingkatan($this->terdaftar_terakhir['tingkatan']);
            $this->terdaftar_terakhir = $this->m_pendaftar->read('PID, NAMA, NO_UJIAN, PILIH1, PILIH2', array('PID' => $this->terdaftar_terakhir['pid']));
            if ($this->terdaftar_terakhir->num_rows() > 0) {
                $this->terdaftar_terakhir = $this->terdaftar_terakhir->row_array();
                $sekolah_terdaftar_terakhir = $this->m_sekolah->read('ID_SEKOLAH, NAMA_SEKOLAH', '', array('ID_SEKOLAH = '.$this->terdaftar_terakhir['PILIH1'].(($this->terdaftar_terakhir['PILIH2']) ? ' OR ID_SEKOLAH = '.$this->terdaftar_terakhir['PILIH2'] : '')))->result();
                $this->terdaftar_terakhir['sekolah'] = array();
                foreach ($sekolah_terdaftar_terakhir as $item) {
                    $this->terdaftar_terakhir['sekolah'][$item->ID_SEKOLAH] = $item;
                }
            } else $this->terdaftar_terakhir = null;
        } else $this->terdaftar_terakhir = null;
    }
    
    function _greater_than_equals($str, $val) {
        $this->form_validation->set_message('_greater_than_equals', '%s tidak boleh kurang dari %s.');
        if (!is_numeric($str)) return false;
        return $str >= $val;
    }
    
    function _less_than_equals($str, $val) {
        $this->form_validation->set_message('_less_than_equals', '%s tidak boleh lebih dari %s.');
        if (!is_numeric($str)) return false;
        return $str <= $val;
    }
    
    function _valid_date($str) {
        // dd/mm/yyyy
        $this->form_validation->set_message('_valid_date', '%s harus ditulis dengan format dd/mm/yyyy.');
        if (preg_match("/^(0[0-9]|[12][0-9]|3[01])\/(0[0-9]|1[012])\/(19|20|00)\d\d/", $str))
            return true;
        return false;
    }
}
