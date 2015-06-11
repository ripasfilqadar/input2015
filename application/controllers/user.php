<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    //private $nama_user, $id_sekolah, $nama_sekolah, $tingkatan_sekolah, $hak, $terdaftar_terakhir;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('mydb');
        
        if (!($this->nama_user = $this->session->userdata('NAMA_USER'))) redirect('');
        
        $this->hak = $this->session->userdata('HAK');
        
        $this->load->library('form_validation');
        
        $this->load->model('m_sekolah');
        $this->load->model('m_user_aplikasi');
        
        $this->form_validation->set_message('required', '%s harus diisi.');
        $this->form_validation->set_message('exact_length', '%s harus berisi %s karakter.');
        $this->form_validation->set_message('min_length', '%s harus berisi %s karakter.');
        $this->form_validation->set_message('numeric', '%s harus berisi karakter angka.');
        $this->form_validation->set_message('decimal', '%s harus berupa pecahan desimal dengan separator \'titik\', misal 8.75.');
    }
    
    public function tingkatan() {
        if ($this->hak != 'admin') redirect('');
        
        //if($this->input->post('TINGKATAN')) redirect('/user/tambah');
        
        $this->load->view('user/user_form_tingkatan');
    }
    
    public function tambah() {
        if ($this->hak != 'admin') redirect('');
        
        $tingkatan = $this->input->post('TINGKATAN');
        
        $this->load->model('m_sekolah');
        $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN')->result();
        $data['sekolah'] = array();
        
        foreach ($sekolah as $item) {
            $data['sekolah'][$item->ID_SEKOLAH] = $item;
        }
        
        if($tingkatan == 'smp') $data['tingkatan'] = '1';
        else if($tingkatan == 'sma') $data['tingkatan'] = '2'; 
        else $data['tingkatan'] = '3'; 
        
        $this->load->view('user/user_form', $data);
    }
    
    public function buat() {
        if ($this->hak != 'admin') redirect('');
        
        $TEMP = '';
        $regex = '';
        $USERNAME = '';
        
        $PASSWORD = $this->generate_pass();
        $SEKOLAH = $this->input->post('SEKOLAH');
        
        if($SEKOLAH > 7000) $SEKOLAH = substr($SEKOLAH,0,2);

        if(strpos($this->input->post('HAK'), 'rekom'))
        { 
            $SEKOLAH = '74';
            $hak = $this->input->post('HAK');
            $regex = 's';
            
            if((strpos($hak, 'smp'))) $hak = 'inputrekomsmp';
            else if((strpos($hak, 'sma'))) $hak = 'inputrekomsma';
            else $hak = 'inputrekomsmk';
            
            $kode = $this->m_user_aplikasi->read('NAMAUSER,hak', array('user_aplikasi.ID_SEKOLAH' => $SEKOLAH))->result();
            
            foreach ($kode as $item) {
               if($item->hak == $hak) 
                   $USERNAME = $item->NAMAUSER;
                //$USERNAME = $SEKOLAH.$hak.$item->hak.' '.$item->hak;
            }
        }
        
        else 
        {
            $hak = $this->input->post('HAK');
            $regex = '-';
            
            if((strpos($hak, 'smp'))) $hak = 'inputsmp';
            else if((strpos($hak, 'sma'))) $hak = 'inputsma';
            else $hak = 'inputsmk';
            
            $kode = $this->m_user_aplikasi->read('NAMAUSER,hak', array('user_aplikasi.ID_SEKOLAH' => $SEKOLAH, 'user_aplikasi.HAK' => $hak))->result();
            
            foreach ($kode as $item) {
               //if($item->hak == $hak) 
                   $USERNAME = $item->NAMAUSER;
                   //$USERNAME = $hak.$item->hak.'-'.$item->hak;
           }
        }
        
        $SPLIT = explode($regex, $USERNAME);
        $TEMP = $SPLIT[1];
        $TEMP = $TEMP + 1;
        $USERNAME = $SPLIT[0].$regex.$TEMP;
        
        $data['NAMAUSER'] = $USERNAME;
        $data['NAMALENGKAP'] = $this->input->post('NAMA');
        $data['PASSWD'] = md5($PASSWORD);
        $data['KETERANGAN'] = $this->input->post('TELP');
        $data['hak'] = $this->input->post('HAK');
        
        $data_escaped = array(
            'ID_SEKOLAH' => (strpos($this->input->post('HAK'), 'inputrekom')) ? '74' : $SEKOLAH 
        );
        
        $this->m_user_aplikasi->create($data, $data_escaped);
        
        $data['PASSWD'] = $PASSWORD;
        
        $data['SEKOLAH']='';
        
        if(strpos($this->input->post('HAK'),'rekom'))
        {
            $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN')->result();
            $sekolah2 = array();

            foreach ($sekolah as $item) {
                $sekolah2[$item->ID_SEKOLAH] = $item;
            }

            for ($i = $start = intval(74)*100; $i < $start + 100; $i++) {
                if (isset($sekolah2[$i])) {
                     $data['SEKOLAH'] = $sekolah2[$i]->NAMA_SEKOLAH;
                    break;
                }
            }
        }
        
        else
        {
            $sekolah = $this->m_sekolah->read('NAMA_SEKOLAH', array('ID_SEKOLAH'=>$this->input->post('SEKOLAH')))->result();
            foreach ($sekolah as $item) {
                $data['SEKOLAH'] = $item->NAMA_SEKOLAH;
            }
        }
        
        $this->load->view('user/user_sukses', $data);
    }
    
    public function cari() {
        if ($this->hak != 'admin') redirect('');
        
        $username = $this->input->get('user');
        
        $data = array();
        $data['status'] = 'kosong';

        $kode = $this->m_user_aplikasi->read('NAMAUSER, NAMALENGKAP, PASSWD, KETERANGAN, hak, user_aplikasi.ID_SEKOLAH', array('user_aplikasi.NAMAUSER' => $username))->result();
        //$kode = $this->m_user_aplikasi->read('NAMAUSER','NAMALENGKAP','PASSWD','KETERANGAN','hak','ID_SEKOLAH', array('user_aplikasi.ID_SEKOLAH' => $SEKOLAH))->result();
        
        if($data['status']) {
            
            $data['hak']= '';
            $data['ID_SEKOLAH'] = '';
            
            foreach ($kode as $item) {
                $data['NAMAUSER'] = $item->NAMAUSER;
                $data['NAMALENGKAP'] = $item->NAMALENGKAP;
                $data['PASSWD'] = $item->PASSWD;
                $data['KETERANGAN'] = $item->KETERANGAN;
                $data['hak'] = $item->hak;
                $data['ID_SEKOLAH'] = $item->ID_SEKOLAH;
            }
                
            if(strpos($data['hak'],'smk') || strpos($data['hak'],'rekom'))
            { 
                $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN')->result();
                $sekolah2 = array();

                foreach ($sekolah as $item) {
                    $sekolah2[$item->ID_SEKOLAH] = $item;
                }
                
                for ($i = $start = intval($data['ID_SEKOLAH'])*100; $i < $start + 100; $i++) {
                    if (isset($sekolah2[$i])) {
                         $data['SEKOLAH'] = $sekolah2[$i]->NAMA_SEKOLAH;
                         $data['status'] = 'go';
                        break;
                    }
                }
            }
            
            else {
                $sekolah = $this->m_sekolah->read('ID_SEKOLAH, NO_TINGKATAN, NAMA_SEKOLAH, JURUSAN', array('ID_SEKOLAH'=>$data['ID_SEKOLAH']))->result();
                $data['SEKOLAH']='';
                
                if(count($sekolah)) $data['status'] = 'go';
                
                foreach ($sekolah as $item) {
                    $data['SEKOLAH'] = $item->NAMA_SEKOLAH;
                }
            }
        }
        
        else $data['status'] = 'kosong';
        $this->load->view('user/user_cari', $data);
    }
    
    public function detail() {
        if ($this->hak != 'admin') redirect('');
        
        $this->load->view('user/user_detail', $data);
        
    }
    
    private function generate_pass($l = 4) {
        //$seed = str_split('abcdefghijklmnopqrstuvwxyz');
                 //.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 //.'0123456789!@#$%^&*()'); // and any other characters
        //shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 4)), 0, 4);
        //$rand = implode('', array_rand($seed, 4));
        
        return $rand;
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
