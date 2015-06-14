<?php 
	class admin_panel extends CI_Controller {
		public function index(){
			
			$this->load->model('monta');
			$this->monta->index();
		}
	}

 ?>