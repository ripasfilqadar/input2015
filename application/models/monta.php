<?php 
	class monta extends MY_Model {
		public function index(){
			$query='select * from pendaftar_sma';
			$data = $this->db->query($query);
			$c=0;
			foreach ($data as $key) {
				$a[$c]=$key;
				$c++;
			}
			foreach ($a[2] as $key) {
				echo ($key);
			}
		}
	}
 ?>