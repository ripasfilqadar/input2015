<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends CI_Controller {
    private $nama_user, $id_sekolah, $nama_sekolah, $tingkatan_sekolah;
    
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
        $this->load->model('m_sekolah');
    }
    
    public function index() {
        $data["id_sekolah"] = $this->id_sekolah;
        $data["nama_sekolah"] = $this->nama_sekolah;
        $data["nama_user"] = $this->nama_user;
        $data['tanggal'] = $this->m_pendaftar->get_tgldaftar($this->id_sekolah, ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk'));
        if (strpos($this->hak, 'inputrekom') === false)
            $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : (($this->tingkatan_sekolah == '3') ? 'smk' : 'smp'));
        else
            $tingkatan = substr ($this->hak, -3);
        $where_escaped = array();
        if (strpos($this->hak, 'inputrekom') === false) {
            $where_escaped['ID_SEKOLAH'] = $this->id_sekolah;
        }
        $where = array();
        if (strpos($this->hak, 'inputrekom') !== false)
            $where['JALUR_DAFTAR !='] = 1;
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $data['tanggal'] = $this->m_pendaftar->read('distinct WAKTU_DAFTAR', $where, $where_escaped);
        $this->load->view('rekap/main', $data);
    }
    
    
   
}