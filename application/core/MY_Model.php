<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    protected $tablename;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select($fields = '') {
        $this->db->select(($fields == '') ? '*' : $fields, false);
        $this->db->from($this->tablename);
    }
    
    public function create($data = '', $data_escaped = '') {
        if ($data != '')
            $this->db->set($data);
        if ($data_escaped != '')
            if (is_array($data_escaped))
                foreach ($data_escaped as $key => $val)
                    $this->db->set($key, $val, false);
        $this->db->insert($this->tablename);
        return $this->db->insert_id();
    }
    
    public function read($fields = '', $where = '', $where_escaped = '', $order = '', $limit = '', $offset = '') {
        $this->select($fields);
        if($limit != false)
            $this->db->limit($limit, $offset);
        if ($where != '')
            $this->db->where($where);
        if ($where_escaped != '') {
            if (is_array($where_escaped))
                foreach ($where_escaped as $key => $val)
                    $this->db->where($key, $val, false);
            else $this->db->where($where_escaped, null, false);
        }
        if ($order != '') $this->db->order_by($order);
        return $this->db->get();
    }
    
    public function read2($fields = '', $where = '', $where_escaped1 = '', $where_escaped2 = '', $order = '', $limit = '', $offset = '') {
        $this->select($fields);
        if($limit != false)
            $this->db->limit($limit, $offset);
        if ($where != '')
            $this->db->where($where);
        if ($where_escaped1 != '' && $where_escaped2 != '') {
            if (is_array($where_escaped1) && is_array($where_escaped2)){
                foreach ($where_escaped1 as $key => $val)
                    $this->db->where($key, $val, false);
                foreach ($where_escaped2 as $key => $val)
                    $this->db->where($key, $val, false);
                
            }
            else {
                $this->db->where($where_escaped1, null, false);
                $this->db->or_where($where_escaped2, null, false);
            }
        }
        if ($order != '') $this->db->order_by($order);
        return $this->db->get();
    }

    public function update($data = '', $data_escaped = '', $where = '', $where_escaped = '') {
        if ($where != '')
            $this->db->where($where);
        if ($where_escaped != '') {
            if (is_array($where_escaped))
                foreach ($where_escaped as $key => $val)
                    $this->db->where($key, $val, false);
            else $this->db->where($where_escaped, null, false);
        }
        if ($data != '')
            $this->db->set($data);
        if ($data_escaped != '')
            if (is_array($data_escaped))
                foreach ($data_escaped as $key => $val)
                    $this->db->set($key, $val, false);
        $this->db->update($this->tablename);
    }
    
    public function delete($where = '', $where_escaped = '') {
        if ($where != '')
            $this->db->where($where);
        if ($where_escaped != '') {
            if (is_array($where_escaped))
                foreach ($where_escaped as $key => $val)
                    $this->db->where($key, $val, false);
            else $this->db->where($where_escaped, null, false);
        }
        $this->db->delete($this->tablename);
    }
    
    public function count() {
        return $this->db->count_all($this->tablename);
    }
}