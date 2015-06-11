<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_user_aplikasi extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->tablename = 'user_aplikasi';
    }
    
    public function select($fields = '') {
        if ($fields == '') {
            $this->db->select('user_aplikasi.ID_SEKOLAH');
            
            $this->db->select('NAMAUSER');
            $this->db->select('NAMALENGKAP');
            $this->db->select('PASSWD');
            $this->db->select('HAK');
            $this->db->select('KETERANGAN');
            
            $this->db->select('NAMA_SEKOLAH');
            $this->db->select('NO_TINGKATAN');
        } else
            $this->db->select($fields);
        $this->db->from($this->tablename);
        $this->db->join('sekolah', 'user_aplikasi.id_sekolah = LEFT(sekolah.id_sekolah, 2)', 'left');
    }
    
    public function read($fields = '', $where = '', $where_escaped = '', $order = '', $limit = '', $offset = '') {
        return parent::read($fields, $where, $where_escaped, $order, $limit, $offset);
    }
    
    public function create($data = '', $data_escaped = '') {
        parent::create($data, $data_escaped);
        $this->tablename = "user_aplikasi";
    }
}