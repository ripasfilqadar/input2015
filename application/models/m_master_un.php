<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_master_un extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->tablename = 'master_un_sd';
    }
    
    public function set_tingkatan($tingkatan) {
        $this->tablename = "master_un_$tingkatan";
    }
    
    public function count_all() {
        return $this->db->count_all($this->tablename);
    }
}