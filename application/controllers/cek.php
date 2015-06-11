<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cek extends CI_Controller 
{
    public function __construct() 
    {
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
    }
    
    function index()
    {       
            if($this->hak != 'admin') redirect('');
            //if (!$this->form_validation->run()) {
                $this->load->view('cek/cek_form');
            /*}
            
            else 
            {
                $this->load->view('cek/cek_sukses');
            }*/
    }
    
    public function kode() {
        if($this->hak != 'admin') redirect('');
        
        $no_un = $this->input->post('NO_UN');
        $kode = $this->input->post('KODE');
        
        $tingkatan = $this->input->post('TINGKATAN');
        
        $this->m_pendaftar->set_tingkatan($tingkatan);
        $data= $this->m_pendaftar->read('', array('NO_UJIAN' => $no_un))->row_array();
        
        if($data)
        {
            $data['kode'] = $kode;
            $data['tingkatan'] = $tingkatan;   
            $sekolah = $this->m_sekolah->read()->result();
            $data['sekolah'] = array();
            foreach ($sekolah as $item) {
                $data['sekolah'][$item->ID_SEKOLAH] = $item;
            }
        }
        
        else
        {
            $data['kode'] = '';  
            $data['tingkatan'] = ''; 
            $data['PILIH1'] = '';
            $data['PILIH2'] = '';
        }
        
        $datacetak = "ppdbsda".$data['tingkatan'].$no_un."p1".$data['PILIH1']."p2".$data['PILIH2']."bismillah2013";    
        //$datacetak = "ppdbsda".$data['NO_TINGKATAN'].$no_un."p1".$data['PILIH1']."p2".$data['PILIH2']."bismillah2013";
        $kodeaslinya = substr(md5(base64_encode($datacetak)),-10);
       
        if($kode == $kodeaslinya) {
            $data['status'] = "DATA VALID";
            $this->load->view('cek/test', $data);
        }
        else {
            $data['status'] = "DATA TIDAK VALID";
            redirect('/cek');
        }
    }

}
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
