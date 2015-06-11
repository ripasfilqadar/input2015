<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_pendaftar_num_row($tingkatan = '', $pid = '', $id_sekolah = '', $jalur_daftar = '') {
    $ci =& get_instance();
    $ci->load->database();
    $sql = "SELECT count(*) as count FROM pendaftar_$tingkatan WHERE PID <= $pid".(($id_sekolah != '') ? " AND ID_SEKOLAH = $id_sekolah" : '').(($jalur_daftar != '') ? " AND JALUR_DAFTAR $jalur_daftar" : '')." GROUP BY ID_SEKOLAH";
    $query = $ci->db->query($sql);
    if ($query->num_rows() > 0) {
        $query = $query->row();
        return $query->count;
    }
    return 1;
}