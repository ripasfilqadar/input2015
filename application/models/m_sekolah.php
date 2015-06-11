<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_sekolah extends MY_Model {
    public function __construct() {
        parent::__construct();
        $this->tablename = 'sekolah';
    }
    
    public function read($fields = '', $where = '', $where_escaped = '', $order = 'id_sekolah', $limit = '', $offset = '') {
        return parent::read($fields, $where, $where_escaped, $order, $limit, $offset);
    }
}