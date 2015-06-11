<?php

class Upload extends CI_Controller {
        
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
                $this->load->model('m_pendaftar');
                $this->load->model('m_master_un');
                $this->load->model('m_sekolah');
		$this->load->helper(array('form', 'url'));
                
                $config['upload_path'] = './inputnilai/';
		$config['allowed_types'] = 'csv';
		$config['max_size']	= '2048';
                $config['file_name'] = 'nilai';
                $config['overwrite'] = TRUE;
		
                $this->load->library('upload', $config);
                
                $this->load->library('csvreader');
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	function index()
	{
                
                if($this->hak != 'admin') redirect('');
		$this->load->view('upload/upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload/upload_form_test', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			//$this->load->view('upload/upload_success', $data);
                        $filePath = './inputnilai/nilai.csv';
                        
                        $data['csvData'] = $this->csvreader->parse_file($filePath);
                        
                        $nRows = sizeof($data['csvData']);
                        
                        $this->load->library('pagination');
                        $config['base_url'] = site_url("upload/do_upload");
                        $config['total_rows'] = $nRows;
                        $config['first_link'] = 'Awal';
                        $config['last_link'] = 'Akhir';
                        $config['per_page'] = 20;
                        $config['uri_segment'] = 3;
                        
                        $this->pagination->initialize($config); 
                        
                        $data['links'] = $this->_insertParamsToLinks($this->pagination->create_links(), $this->input->get());
                        $data['total'] = $nRows;
                        
                        $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk');
                        $data['tingkatan'] = $tingkatan;
                        
                        
                        if($this->uri->segment(3)=='') $num = 0;
                        else $num = $this->load->helper('url');
                        
                        $num2 = $num+20;
                        
                        $data['num'] = $num;
                        $data['num2'] = $num2;
                        
                        $this->load->view('upload/csv_view', $data);
		}
	}
        
        
        public function updateNilai($data) 
        {
            $no_ujian = $data['id'];
            
            $tingkatan = ($this->tingkatan_sekolah == '1') ? 'smp' : (($this->tingkatan_sekolah == '2') ? 'sma' : 'smk');
            
            $this->m_pendaftar->set_tingkatan($tingkatan);
            $data2 = $this->m_pendaftar->read('', array('NO_UJIAN' => $no_ujian), ($this->hak != 'admin' && strpos($this->hak, 'inputrekom') === false) ? 'LEFT(PILIH1, 2) = '.$this->id_sekolah : '');
            
            if ($data2->num_rows() == 0) return;
            
            else 
            {
                $nilai_akhir = $data2['NILAI_AKHIR'];
                //$pendaftar = $this->m_pendaftar->read('', array('NILAI_AKHIR' => $nilai_akhir), "LEFT(PILIH1, 2) = '$this->id_sekolah'");

                $ntmb = $data['nilai1'];
                $ntk = $data['nilai2'];

                $nilai_terpadu = (($nilai_akhir*2) + ($ntmb*2) + $ntk)/5;

                $data_escaped = array(
                    'NTMB' => $ntmb,
                    'NTK' => $ntk,
                    'NILAI_AKHIR' => $nilai_terpadu
                );

                $this->m_pendaftar->set_tingkatan('smk');
                $this->m_pendaftar->update('', $data_escaped, array('NO_UJIAN' => $no_ujian));
            }
            
        }
        
        public function doUpdate()
        {
            $data = array('upload_data' => $this->upload->data());
            $filePath = './inputnilai/nilai.csv';

            $data['csvData'] = $this->csvreader->parse_file($filePath);
            
            foreach($data['csvData'] as $row)
            {
                //$this->updateNilai($row); 
                $no_ujian = $row['id'];
//                echo 'ini'.$no_ujian.'<br/>';
                $this->m_pendaftar->set_tingkatan('smk');
                $data2 = $this->m_pendaftar->read('', array('NO_UJIAN' => $no_ujian), ($this->hak != 'admin' && strpos($this->hak, 'inputrekom') === false) ? 'LEFT(PILIH1, 2) = '.$this->id_sekolah : '');

                if ($data2->num_rows() == 0) {
                    return;
                }
                else 
                {
                    $nilai_akhir = $row['NILAI_AKHIR'];
                    //$pendaftar = $this->m_pendaftar->read('', array('NILAI_AKHIR' => $nilai_akhir), "LEFT(PILIH1, 2) = '$this->id_sekolah'");

                    $ntmb = $row['nilai1'];
                    $ntk = $row['nilai2'];

                    $nilai_terpadu = (($nilai_akhir*2) + ($ntmb*2) + $ntk)/5;
                    
//                    echo $no_ujian.' '.$row['nilai1'].' '.$row['nilai2'].'<br/>';
                    
                    $data_escaped = array(
                        'NTMB' => $ntmb,
                        'NTK' => $ntk,
                        'NILAI_AKHIR' => $nilai_terpadu
                    );

                    $this->m_pendaftar->set_tingkatan('smk');
                    $this->m_pendaftar->update('', $data_escaped, array('NO_UJIAN' => $no_ujian));
                }
            }

            $this->load->view('upload/upload_success');
        }
        
        function _insertParamsToLinks($links, $params) 
        {
            if (!$links) return '';
            $matches;
            preg_match_all("/href\=\"?.*?\"/", $links, $matches);
            $matches2 = array();
            foreach ($matches[0] as $key => $val) {
                $matches2[$key] = "@".mysql_real_escape_string($val)."@";
            }

            $string = array();
            foreach ($params as $key => $val) {
                if (is_array($val))
                    $val = implode( ',', $val );
                $string[] = "{$key}={$val}";
            }
            $string = implode('&', $string);

            $replacements = array();
            foreach ($matches[0] as $item) {
                $replacements[] = substr($item, 0, strlen($item)-1).'?'.$string.'"';
            }

            return preg_replace($matches2, $replacements, $links);
        }
}
?>