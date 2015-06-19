<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_pendaftar extends MY_Model {
    private $tingkatan;
    
    public function __construct() {
        parent::__construct();
        $this->tablename = 'pendaftar_smp';
    }
    
    public function set_tingkatan($tingkatan) {
        $this->tablename = "pendaftar_$tingkatan";
        $this->tingkatan = $tingkatan;
    }
    
    public function read_simple($where = '', $where_escaped = '', $order = '', $limit = '', $offset = '') {
        return $this->read('PID, NAMA, WAKTU_DAFTAR, ASAL_SEKOLAH, PILIH1, PILIH2', $where, $where_escaped, $order, $limit, $offset);
    }
    
    public function read_cek($where = '') {
        return $this->read('NO_TINGKATAN, PILIH1, PILIH2', $where);
    }
    
    public function rekap_persekolah($id_sekolah, $tingkatan){
        $q = "select * from pendaftar_$tingkatan WHERE  id_sekolah = $id_sekolah";
        return $this->db->query($q);
    }
    
    public function get_tgldaftar($id_sekolah, $tingkatan = 'smp')
    {
       $q =  "SELECT DISTINCT WAKTU_DAFTAR FROM pendaftar_$tingkatan WHERE ID_SEKOLAH = '$id_sekolah' ";
       $result =  $this->db->query($q)->result();
       if ($tingkatan != 'smp') {
           $tingkatan = ($tingkatan == 'sma') ? 'smk' : 'sma';
           $q =  "SELECT DISTINCT WAKTU_DAFTAR FROM pendaftar_$tingkatan WHERE ID_SEKOLAH = '$id_sekolah' ";
           $result2 = $this->db->query($q)->result();
           $result = array_merge($result, $result2);
       }
       return $result;
    }


    function rekap_daftar($id_sekolah, $tingkatan){
		
        $data = array();
        $sql = "select * from pendaftar_$tingkatan WHERE  id_sekolah = $id_sekolah";
		$query = $this->db->query($sql);

        if ( $query->num_rows() <= 0 )
        {
           return false;
        }
        
        foreach ($query->result() as $row)
        {
            $val['no_ujian'] = $row->NO_UJIAN;
            $val['nama'] = $row->NAMA;
            
            if($row->JALUR_DAFTAR ==1)
                $val['jalur_daftar'] = "REGULER";
            else if ($row->JALUR_DAFTAR ==2)
                $val['jalur_daftar'] = "REKOMENDASI";
            else if ($row->JALUR_DAFTAR ==0)
                $val['jalur_daftar'] = "TAHUN LALU";
            $val['user'] = $row->USER_FISIK;
            $val['waktu_daftar'] = $row->WAKTU_DAFTAR;
            
            $val['pilih1'] = $row->PILIH1 ;
            
            $val['pilih2'] = $row->PILIH2;
            
            array_push($data, $val);
        
        }
        return $data;
    }
    
    public function create($data = '', $data_escaped = '') {
        $pid = parent::create($data, $data_escaped);
        $this->tablename = "log_pendaftar_$this->tingkatan";
        parent::create($data, $data_escaped);
        $this->tablename = "pendaftar_$this->tingkatan";
        return $pid;
    }
    
    public function update($data = '', $data_escaped = '', $where = '', $where_escaped = '') {
        $this->tablename = "log_pendaftar_$this->tingkatan";
        parent::create($data, $data_escaped);
        if (isset($data['ALASAN_PERUBAHAN']))
            unset($data['ALASAN_PERUBAHAN']);
        if (isset($data['IP_ADDRESS']))
            unset($data['IP_ADDRESS']);
        if (isset($data['USER_FISIK']))
            unset($data['USER_FISIK']);
        if (isset($data['ID_SEKOLAH']))
            unset($data['ID_SEKOLAH']);
        if (isset($data['NO_TINGKATAN']))
            unset($data['NO_TINGKATAN']);
        if (isset($data_escaped['LOG_DAFTAR']))
            unset($data_escaped['LOG_DAFTAR']);
        if (isset($data_escaped['WAKTU_DAFTAR']))
            unset($data_escaped['WAKTU_DAFTAR']);
        $this->tablename = "pendaftar_$this->tingkatan";
        parent::update($data, $data_escaped, $where, $where_escaped);
    }
     public function cekdaftar($no,$tingkatan)
    {
        $query="select * from pendaftar_$tingkatan where NO_PENDAFTARAN='$no'";
        $query=$this->db->query($query);
        return $query->num_rows();
    }
}