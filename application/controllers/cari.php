<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cari extends CI_Controller {
    private $nama_user, $id_sekolah, $nama_sekolah, $tingkatan_sekolah, $hak;
    
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
        $this->load->model('m_pendaftar');
        $this->load->model('m_master_un');
        $this->load->model('m_sekolah');
    }
    
    public function index() {
        $no_un = substr(trim($this->input->get('un')), -9);
        $nama = trim($this->input->get('nama'));
        $tingkatan = $this->input->get('tingkatan');
        $where = (($no_un) ? 'RIGHT(NO_UJIAN, 9) = \''.$no_un.'\'' : (($nama) ? 'NAMA LIKE \'%'.$nama.'%\'' : '')).(($no_un || $nama) ? (($nama && $this->hak != 'admin' && strpos($this->hak, 'inputrekom') === false) ? ' AND LEFT(PILIH1, 2) = '.$this->id_sekolah : ((strpos($this->hak, 'inputrekom') !== false) ? ' AND JALUR_DAFTAR <> 1' : '')) : '');
        if (!$tingkatan) {
            if (!$this->tingkatan_sekolah) {
                if (strpos($this->hak, 'inputrekom') !== false)
                    $tingkatan = substr($this->hak, -3);
                else $tingkatan = '';
            }
            else
                $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk');
        }
        if (!$where) {
            $data['pendaftar'] = array();
        } else {
            $this->m_pendaftar->set_tingkatan($tingkatan);
            
            $data['pendaftar'] = $this->m_pendaftar->read('PID, NO_UJIAN, NAMA, ASAL_SEKOLAH, WAKTU_DAFTAR, PILIH1, PILIH2', '', $where, 'PID asc', '100', $this->uri->segment(3))->result();
            $n = count($data['pendaftar']); 
            $nPendaftar = $this->m_pendaftar->read('NO_UJIAN', '', $where)->num_rows();
//            if ($tingkatan != 'smp' && $n >= 0 && $n < 100) {
//                $tingkatan = ($tingkatan == 'sma') ? 'smk' : 'sma';
//                $this->m_pendaftar->set_tingkatan($tingkatan);
//                $pendaftar2 = $this->m_pendaftar->read('PID, NO_UJIAN, NAMA, ASAL_SEKOLAH, WAKTU_DAFTAR, PILIH1, PILIH2', '', $where, 'PID asc', 100-$n, ($this->uri->segment(3)) ? $this->uri->segment(3)-$nPendaftar : '')->result();
//                array_merge($data['pendaftar'], $pendaftar2);
//                $nPendaftar += $this->m_pendaftar->read('NO_UJIAN', '', $where)->num_rows();
//            }
            
            $this->load->library('pagination');
            $config['base_url'] = site_url("cari/index/");
            $config['total_rows'] = $nPendaftar;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['per_page'] = 100;
            $this->pagination->initialize($config); 
            $data['links'] = $this->_insertParamsToLinks($this->pagination->create_links(), $this->input->get());
            $data['total'] = $nPendaftar;
        }
        $sekolah = $this->m_sekolah->read()->result();
        $data['sekolah'] = array();
        foreach ($sekolah as $item) {
            $data['sekolah'][$item->ID_SEKOLAH] = $item;
        }
        $data['tingkatan'] = $tingkatan;
        $this->load->view('cari/peserta', $data);
    }
    
    public function semua_peserta($tingkatan = '', $jurusan = '') {
        if ($this->hak != 'admin') {
            if (!$tingkatan || $tingkatan == 'x') {
                if (strpos($this->hak, 'inputrekom') !== false) {
                    $tingkatan = substr($this->hak, -3);
                } else {
                    $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk');
                }
                redirect("cari/semua_peserta/$tingkatan/$jurusan");
            }
        }
        if ($jurusan == '') redirect ("cari/semua_peserta/$tingkatan/x");
        if ($tingkatan == 'smk' && ($jurusan == '' || $jurusan == 'x')) {
            $jurusan = (strpos($this->hak, 'inputrekom') !== false || $this->hak == 'admin') ? '7101' : $this->id_sekolah.'01';
            redirect("cari/semua_peserta/$tingkatan/$jurusan");
        }
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $where = array();
        if ($tingkatan == 'smk'){
            $where['PILIH1'] = $jurusan;
        }
        if (strpos($this->hak, 'inputrekom') !== false) {
            $where['JALUR_DAFTAR <>'] = 1;
        } else {
            $where['ID_SEKOLAH'] = $this->id_sekolah;
            $where['JALUR_DAFTAR'] = 1;
        }
        $data['pendaftar'] = $this->m_pendaftar->read('PID, NO_UJIAN, NAMA, ASAL_SEKOLAH, WAKTU_DAFTAR, PILIH1, PILIH2', '', $where, 'PID asc', '100', $this->uri->segment(5))->result();
        $count = $this->m_pendaftar->read('count(*) as count', '', $where)->row()->count;
        
        $this->load->library('pagination');
        $config['base_url'] = site_url("cari/semua_peserta/$tingkatan/$jurusan");
        $config['total_rows'] = $count;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['per_page'] = 100;
        $config['uri_segment'] = 5;

        $this->pagination->initialize($config); 
        
        if ($tingkatan == 'smk')
            $sekolah = $this->m_sekolah->read('', '', (!$this->id_sekolah || strpos($this->hak, 'inputrekom') !== false) ? array('NO_TINGKATAN' => 3) : 'LEFT(ID_SEKOLAH, 2) =\''.$this->id_sekolah."'")->result();
        else
            $sekolah = $this->m_sekolah->read()->result();
        $data['sekolah'] = array();
        foreach ($sekolah as $item) {
            $data['sekolah'][$item->ID_SEKOLAH] = $item;
        }
        $data['nama_sekolah'] = $this->nama_sekolah;
        $data['tingkatan'] = $tingkatan;
        $data['jumlah'] = $count;
        $this->load->view('cari/semua_peserta', $data);
    }
    
    public function peserta_pendaftar($tingkatan = '', $jurusan = '') {
        if ($this->hak != 'admin') {
            if (!$tingkatan || $tingkatan == 'x') {
                if (strpos($this->hak, 'inputrekom') !== false) {
                    $tingkatan = substr($this->hak, -3);
                } else {
                    $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk');
                }
                redirect("cari/peserta_pendaftar/$tingkatan/$jurusan");
            }
        }
        if ($jurusan == '') redirect ("cari/peserta_pendaftar/$tingkatan/x");
        if ($tingkatan == 'smk' && ($jurusan == '' || $jurusan == 'x')) {
            $jurusan = (strpos($this->hak, 'inputrekom') !== false || $this->hak == 'admin') ? '7101' : $this->id_sekolah.'01';
            redirect("cari/peserta_pendaftar/$tingkatan/$jurusan");
        }
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $where = array();
        if ($tingkatan == 'smk'){
            $where['PILIH1'] = $jurusan;
        }
        if (strpos($this->hak, 'inputrekom') !== false) {
            $where['JALUR_DAFTAR <>'] = 1;
        } else {
            $where['ID_SEKOLAH'] = $this->id_sekolah;
            $where['JALUR_DAFTAR'] = 1;
        }

        $count = $this->m_pendaftar->read('count(*) as count', '', $where)->row()->count;
        if($count==0){
            unset($where['PILIH1']);
            if($tingkatan != 'smk')
            {
                $where['PILIH2']=$this->id_sekolah;
            }
            else $where['PILIH2']=$jurusan; 
            $count = $this->m_pendaftar->read('count(*) as count', '', $where)->row()->count;
        }
        $data['pendaftar'] = $this->m_pendaftar->read('PID, NO_UJIAN, NAMA, ASAL_SEKOLAH, WAKTU_DAFTAR, PILIH1, PILIH2', '', $where, 'PID asc', '100', $this->uri->segment(5))->result();

        
        
        $this->load->library('pagination');
        $config['base_url'] = site_url("cari/peserta_pendaftar/$tingkatan/$jurusan");
        $config['total_rows'] = $count;
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['per_page'] = 100;
        $config['uri_segment'] = 5;

        $this->pagination->initialize($config); 
        
        if ($tingkatan == 'smk')
            $sekolah = $this->m_sekolah->read('', '', (!$this->id_sekolah || strpos($this->hak, 'inputrekom') !== false) ? array('NO_TINGKATAN' => 3) : 'LEFT(ID_SEKOLAH, 2) =\''.$this->id_sekolah."'")->result();
        else
            $sekolah = $this->m_sekolah->read()->result();
        $data['sekolah'] = array();
        foreach ($sekolah as $item) {
            $data['sekolah'][$item->ID_SEKOLAH] = $item;
        }
        $data['nama_sekolah'] = $this->nama_sekolah;
        $data['tingkatan'] = $tingkatan;
        $data['jumlah'] = $count;
        $this->load->view('cari/peserta_pendaftar', $data);
    }

    public function detail($tingkatan = '', $no_un = '') {

        if (!$no_un || !$tingkatan)
            redirect('');
        // $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : (($this->tingkatan_sekolah == '3') ? 'smk' : 'smp'));
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $data = $this->m_pendaftar->read('', array('NO_UJIAN' => $no_un), ($this->hak != 'admin' && strpos($this->hak, 'inputrekom') === false) ? 'LEFT(PILIH1, 2) = '.$this->id_sekolah : '');
        // $data = $this->m_pendaftar->read2('', array('NO_UJIAN' => $no_un), ($this->hak != 'admin' && strpos($this->hak, 'inputrekom') === false) ? 'LEFT(PILIH1, 2) = '.$this->id_sekolah : '', ($this->hak != 'admin' && strpos($this->hak, 'inputrekom') === false) ? 'LEFT(PILIH2, 2) = '.$this->id_sekolah : '');
        
        // if ($data->num_rows() == 0) redirect('');
        if ($data->num_rows() == 0 && $tingkatan=='sma'){
            $this->load->database();
            $data=$this->db->query('select * from pendaftar_sma where NO_UJIAN='.$no_un);
        }
        if($tingkatan=='smp'){
            $this->load->database();
            $data=$this->db->query('select * from pendaftar_smp where NO_UJIAN='.$no_un);
        }

        $data = $data->row_array();
        $data['tingkatan'] = $tingkatan;
        $sekolah = $this->m_sekolah->read()->result();
        $data['sekolah'] = array();
        foreach ($sekolah as $item) {
            $data['sekolah'][$item->ID_SEKOLAH] = $item;
        }
        $this->load->view('cari/detail', $data);
    }
    
    public function master_un($tingkatanreq = '') {
        $tingkatan = ($this->tingkatan_sekolah == '1') ? 'sd' : 'smp';
        if ($tingkatan != $tingkatanreq && $this->hak != 'admin') redirect('');
        $no_un = trim($this->input->get('un'));
        $nama = trim($this->input->get('nama'));
        $where = (($no_un) ? 'NO_UJIAN = \''.$no_un.'\'' : (($nama) ? 'NAMA LIKE \'%'.$nama.'%\'' : ''));
        $this->m_master_un->set_tingkatan($tingkatanreq);
        $data['pendaftar'] = $this->m_master_un->read('NO_UJIAN, NAMA, JENIS_KEL, ASAL_SEKOLAH, NUN_ASLI', '', $where, 'NO_UJIAN asc', '100', $this->uri->segment(4))->result();
        
        $this->load->library('pagination');
        $config['base_url'] = site_url("cari/master_un/$tingkatanreq/");
        $config['total_rows'] = ($where) ? $this->m_master_un->read('NO_UJIAN', '', $where)->num_rows() : $this->m_master_un->count_all();
        $config['first_link'] = 'Awal';
        $config['last_link'] = 'Akhir';
        $config['per_page'] = 100;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config); 
        $data['links'] = ($where) ? $this->_insertParamsToLinks($this->pagination->create_links(), $this->input->get()) : $this->pagination->create_links();
        
        $this->load->view('cari/master_un', $data);
    }
    
    public function detail_un($no_un = '') {
        $tingkatan = ($this->tingkatan_sekolah == '1') ? 'sd' : 'smp';
        $this->m_master_un->set_tingkatan($tingkatan);
        $data = $this->m_master_un->read('', '', array('NO_UJIAN' => $no_un))->row_array();
        $data['tingkatan'] = $tingkatan;
        $this->load->view('cari/detail_un', $data);
    }
    
    function _insertParamsToLinks($links, $params) {
        if (!$links) return '';
        $matches;
        preg_match_all("/href\=\"?.*?\"/", $links, $matches);
        $matches2 = array();
        foreach ($matches[0] as $key => $val) {
            $matches2[$key] = "@".mysql_real_escape_string($val)."@";
        }
        
        $string = array();
        foreach ($params as $key => $val) {
            if (is_array($val))
                $val = implode( ',', $val );
            $string[] = "{$key}={$val}";
        }
        $string = implode('&', $string);
        
        $replacements = array();
        foreach ($matches[0] as $item) {
            $replacements[] = substr($item, 0, strlen($item)-1).'?'.$string.'"';
        }
        
        return preg_replace($matches2, $replacements, $links);
    }
}