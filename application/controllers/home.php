<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    private $nama_user, $id_sekolah, $nama_sekolah, $tingkatan_sekolah;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('mydb');
        $this->load->model('m_user_aplikasi');
        $this->nama_user = $this->session->userdata('NAMA_USER');
        $this->id_sekolah = $this->session->userdata('ID_SEKOLAH');
        $this->nama_sekolah = $this->session->userdata('NAMA_SEKOLAH');
        $this->tingkatan_sekolah = $this->session->userdata('TINGKATAN_SEKOLAH');
    }
    
    public function index() {
//        $this->load->view('login2');return;
        if ($this->nama_user == '') redirect('home/login');
        $data['tingkatan']=$this->nama_user;
        $this->load->view('home',$data);
    }
    
    public function login() {
//        redirect('');
        if ($this->nama_user) redirect('');
        $this->form_validation->set_rules('nama_user', 'Nama User', 'required');
        $this->form_validation->set_rules('passwd', 'Password', 'required');
        
        $this->form_validation->set_message('required', '%s harus diisi');
        if (!$this->form_validation->run()) {
            $data = array(
                'errors' => validation_errors('<span>', '</span><br />')
            );
            $this->load->view('login', $data);
        } else {
            $nama_user = $this->input->post('nama_user');
            $passwd = $this->input->post('passwd');
            $user = $this->m_user_aplikasi->read('', array('NAMAUSER' => $nama_user));
            if ($user->num_rows() > 0) {
                $user = $user->row();
                if ($user->PASSWD == md5($passwd)) {
                    $data = array(
                        'NAMA_USER' => $nama_user,
                        'ID_SEKOLAH' => $user->ID_SEKOLAH,
                        'NAMA_SEKOLAH' => $user->NAMA_SEKOLAH,
                        'TINGKATAN_SEKOLAH' => (!$user->NO_TINGKATAN) ? ((strpos($user->HAK, 'smp') !== false) ? 1 : ((strpos($user->HAK, 'sma') !== false ? 2 : 3))) : $user->NO_TINGKATAN,
                        'HAK' => $user->HAK
                    );
                    $this->session->set_userdata($data);
                    redirect('');
                } else {
                    $data = array(
                        'errors' => 'Nama user atau password salah. Login gagal.'
                    );
                    $this->load->view('login', $data);
                }
            } else {
                $data = array(
                    'errors' => 'Nama user atau password salah. Login gagal.'
                );
                $this->load->view('login', $data);
            }
        }
    }
    
    public function logout() {
        $data = array(
            'NAMA_USER' => '',
            'ID_SEKOLAH' => '',
            'NAMA_SEKOLAH' => '',
            'TINGKATAN' => '',
            'terdaftar_terakhir' => ''
        );
        $this->session->unset_userdata($data);
        redirect('');
    }
    
    public function pendaftarsmk() {
        //return;
        $this->load->model('m_pendaftar');
        $this->load->model('m_sekolah');
        
        $sekolahtemp = $this->m_sekolah->read();
        $sekolah = array();
        foreach ($sekolahtemp->result() as $row) {
            $sekolah[$row->ID_SEKOLAH] = $row;
            if ($row->ID_SEKOLAH > 7000) $sekolah[substr($row->ID_SEKOLAH, 0, 2)] = $row;
        }
        
        $this->m_pendaftar->set_tingkatan('smk');
        $pendaftar = $this->m_pendaftar->read('NO_UJIAN, NAMA, PILIH1, PILIH2', '', 'LEFT(PILIH1, 2) = \'71\'', 'PILIH1 asc, NAMA asc');
        echo $sekolah[71]->NAMA_SEKOLAH.";;;;;;\r\n";
        echo "No. Ujian;Nama;Kode Pil1;Pilihan 1;Kode Pil2;Pilihan 2;\r\n";
        $jalur = array(1 => 'Reguler', 0 => 'Tahun Lalu', 20 => 'Rekomendasi1', 21 => 'Rekomendasi2');//($row->JALUR_DAFTAR == 1) ? "Reguler" : (($row->JALUR_DAFTAR == 0) ? "Tahun lalu" : "Rekomendasi");
        foreach ($pendaftar->result() as $row) {
            
//            if ($sekolahtemp != $row->PILIH1) {
//                $sekolahtemp = $row->PILIH1;
//                echo $sekolah[$row->PILIH1]->NAMA_SEKOLAH.";;;;\r\n";
//                echo "No. Ujian;Nama;Asal Sekolah;Jalur Daftar;\r\n";
//            }
            echo "$row->NO_UJIAN;$row->NAMA;".$sekolah[$row->PILIH1]->ID_SEKOLAH.';'.$sekolah[$row->PILIH1]->JURUSAN.";".$sekolah[$row->PILIH2]->ID_SEKOLAH.';'.$sekolah[$row->PILIH2]->JURUSAN.";\r\n";
        }
        
        echo "\r\n";
        return;
        $this->m_pendaftar->set_tingkatan('sma');
        $pendaftar = $this->m_pendaftar->read('NO_UJIAN, NAMA, ASAL_SEKOLAH, JALUR_DAFTAR', '', 'JALUR_DAFTAR <> 1', 'NAMA asc');
        echo "SMA;;;\r\n";
        echo "No. Ujian;Nama;Asal Sekolah;Jalur Daftar;\r\n";
        foreach ($pendaftar->result() as $row) {
            $jalur = ($row->JALUR_DAFTAR == 1) ? "Reguler" : (($row->JALUR_DAFTAR == 0) ? "Tahun lalu" : "Rekomendasi");
//            if ($sekolahtemp != $row->PILIH1) {
//                $sekolahtemp = $row->PILIH1;
//                echo $sekolah[$row->PILIH1]->NAMA_SEKOLAH.";;;\r\n";
//                echo "No. Ujian;Nama;Asal Sekolah;Jalur Daftar;\r\n";
//            }
            echo "$row->NO_UJIAN;$row->NAMA;".$row->ASAL_SEKOLAH.";$jalur;\r\n";
        }
    }
    
    public function tes() {
        return;
        $this->load->model('m_master_un');
        $this->load->model('m_sekolah');
        
        $tingkatan = 'sd';
        $this->m_master_un->set_tingkatan($tingkatan);
        
        $temp = $this->m_sekolah->read()->result();
        $sekolah = array();
        foreach ($temp as $item) {
            $sekolah[$item->ID_SEKOLAH] = $item;
        }
        unset($temp);
        
        
    }
    
    function _datasettopdf($namasekolah, $datareguler, $datalalu, $datarekom) {
        
    }
    
    public function bikinuser() {
        return;
        $this->load->model('m_sekolah');
        $sekolah = $this->m_sekolah->read();
        
        $tempsmk = array();
        $count1 = 0;
        $count2 = 0;
        echo $sekolah->num_rows().'<br />';
        foreach ($sekolah->result() as $item) {
            if ($item->NO_TINGKATAN == 3 && !in_array(($idsmk = substr($item->ID_SEKOLAH, 0, 2)), $tempsmk)) {
                $tempsmk[] = substr($item->ID_SEKOLAH, 0, 2);
                for ($i = 1; $i <= 5; $i++) {
                    $data = array(
                        'ID_SEKOLAH' => $idsmk,
                        'NAMAUSER' => (($item->NO_TINGKATAN == 1) ? 'smp' : (($item->NO_TINGKATAN == 2) ? 'sma' : (($item->NO_TINGKATAN == 3) ? 'smk' : 'entri'))).$idsmk.'-'.$i,
                        'PASSWD' => $this->_createRandomPassword(),
                        'HAK' => 3
                    );
                    $data['NAMALENGKAP'] = $data['KETERANGAN'] = $data['NAMAUSER'];
                    echo 'user: '.$data['NAMAUSER'].' pass: '.$data['PASSWD'].'<br />';
                    $data['PASSWD'] = md5($data['PASSWD']);
                    $this->m_user_aplikasi->create($data);
                    $count2++;
                }
                $count1++;
            } else if ($item->NO_TINGKATAN != 3) {
                for ($i = 1; $i <= 5; $i++) {
                    $data = array(
                        'ID_SEKOLAH' => $item->ID_SEKOLAH,
                        'NAMAUSER' => (($item->NO_TINGKATAN == 1) ? 'smp' : (($item->NO_TINGKATAN == 2) ? 'sma' : (($item->NO_TINGKATAN == 3) ? 'smk' : 'entri'))).$item->ID_SEKOLAH.'-'.$i,
                        'PASSWD' => $this->_createRandomPassword(),
                        'HAK' => 3
                    );
                    $data['NAMALENGKAP'] = $data['KETERANGAN'] = $data['NAMAUSER'];
                    echo 'user: '.$data['NAMAUSER'].' pass: '.$data['PASSWD'].'<br />';
                    $data['PASSWD'] = md5($data['PASSWD']);
                    $this->m_user_aplikasi->create($data);
                    $count2++;
                }
                $count1++;
            }
        }
        echo "sekolah $count1 user $count2";
    }
    
    function _createRandomPassword() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i < 4) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }
}
