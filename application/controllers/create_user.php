<?php 
class Create_user extends CI_Controller {

	public function index() {
		$this->load->model('m_sekolah');
		$this->load->model('m_user_aplikasi');
		$result=$this->m_sekolah->read()->result();
		$id =array();
		$sekolah=array();
		$count = 0;
		foreach ($result as $key) {
			if(substr($key->ID_SEKOLAH,0,2)<15)continue;
			// echo substr($key->ID_SEKOLAH,0,2)." ";
			$id[$count]=substr($key->ID_SEKOLAH,0,2);
			$sekolah[$count]=$key->NAMA_SEKOLAH;
			if($count!=0 && $id[$count]==$id[$count-1])$count--;
			$count++;
			
		}
		function shuffle_string()
		{
			$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
			return $randomString;
		}

		
		// for ($i=0; $i <$count ; $i++) {
		// 	if($id[$i]<25){
		// 		echo "<table border=1 width=1000px >";
		// 		echo "<tr>";
		// 		$j=1;	
		// 		for ($j=1; $j <=6 ; $j++) {
		// 			echo "<td style='font-size:20px; padding-left:10px; padding-top:20px; padding-bottom:20px; height:680px;'>";
		// 				$Pass=shuffle_string();
		// 				echo "<h3>Daftar User Input Data PPDB Sidoarjo </h3>";
		// 				echo "<p style='font-size:25px;'>Nama Sekolah : ".$sekolah[$i]."</p>";
		// 				echo "<p style='font-size:25px; font-weight:bold;'>User : "."sma".$id[$i]."-".$j."";
		// 				echo "</br>Pass : ".$Pass."</p>";

		// 				echo "--------------------------------------------------------------------";
		// 				echo "<h2>Penanggung Jawab</h2>";
		// 				echo "<p style='font-size:25px;'>Nama Sekolah : ".$sekolah[$i]."</p>";
		// 				echo "<p style='font-size:25px; font-weight:bold;'>User : "."sma".$id[$i]."-".$j."";
		// 				echo "</br>Pass : ".$Pass."</p>";
		// 				echo "<p style='font-size:25px;'>Nama Penanggung Jawab : <br>........................................................................ ";
		// 				echo "</br>No. HP : ......................................................... </p>";
		// 			echo "</td>";

		// 			$data['ID_SEKOLAH']=$id[$i];
		// 			$data['NAMAUSER']="sma".$id[$i]."-".$j;
		// 			$data['PASSWD']=md5($Pass);
		// 			$data['HAK']='inputsma';
		// 			$data['KETERANGAN']=$Pass;
		// 			$this->m_user_aplikasi->create($data);
		// 			if($j%2==0){
		// 				echo "</tr>";
		// 				if($j<6)echo "<tr>";
		// 				else echo "</table>";
		// 			}
		// 		}

				
		// 	}
		// 	elseif ($id[$i]<70){
		// 	 	echo "<table border=1 width=1000px>";
		// 		echo "<tr>";
				
		// 		for ($j=1; $j <=6 ; $j++) {  
		// 			echo "<td style='font-size:20px; padding-left:10px; padding-top:20px; padding-bottom:20px; height:680px;'>";
		// 				$Pass=shuffle_string();
		// 				echo "<h3>Daftar User Input Data PPDB Sidoarjo </h3>";
		// 				echo "<p style='font-size:25px;'>Nama Sekolah : ".$sekolah[$i]."</p>";
		// 				echo "<p style='font-size:25px; font-weight:bold;'>User : "."smp".$id[$i]."-".$j."";
		// 				echo "</br>Pass : ".$Pass."</p>";

		// 				echo "----------------------------------------------------------------";
		// 				echo "<h2>Penanggung Jawab</h2>";
		// 				echo "<p style='font-size:25px;'>Nama Sekolah : ".$sekolah[$i]."</p>";
		// 				echo "<p style='font-size:25px; font-weight:bold;'>User : "."smp".$id[$i]."-".$j."";
		// 				echo "</br>Pass : ".$Pass."</p>";
		// 				echo "<p style='font-size:25px;'>Nama Penanggung Jawab : <br>........................................................................ ";
		// 				echo "</br>No. HP : ......................................................... </p>";
		// 			echo "</td>";
		// 			$data['ID_SEKOLAH']=$id[$i];
		// 			$data['NAMAUSER']="smp".$id[$i]."-".$j;
		// 			$data['PASSWD']=md5($Pass);
		// 			$data['HAK']='inputsmp';
		// 			$data['KETERANGAN']=$Pass;
		// 			$this->m_user_aplikasi->create($data);
		// 			if($j%2==0){
		// 				echo "</tr>";
		// 				if($j<6)echo "<tr>";
		// 				else echo "</table>";
		// 			}
		// 		}
		// 	}
		// 	elseif ($id[$i]<90){
		// 		echo "<table border=1 width=1000px>";
		// 		echo "<tr>"; 
		// 		for ($j=1; $j <=6 ; $j++) {
		// 			echo "<td style='font-size:20px; padding-left:10px; padding-top:20px; padding-bottom:20px; height:680px;'>";
		// 				$Pass=shuffle_string();
		// 				echo "<h3>Daftar User Input Data PPDB Sidoarjo </h3>";
		// 				echo "<p style='font-size:25px;'>Nama Sekolah : ".$sekolah[$i]."</p>";
		// 				echo "<p style='font-size:25px; font-weight:bold;'>User : "."smk".$id[$i]."-".$j."";
		// 				echo "</br>Pass : ".$Pass."</p>";

		// 				echo "----------------------------------------------------------------";
		// 				echo "<h2>Penanggung Jawab</h2>";
		// 				echo "<p style='font-size:25px;'>Nama Sekolah : ".$sekolah[$i]."</p>";
		// 				echo "<p style='font-size:25px; font-weight:bold;'>User : "."smk".$id[$i]."-".$j."";
		// 				echo "</br>Pass : ".$Pass."</p>";
		// 				echo "<p style='font-size:25px;'>Nama Penanggung Jawab : <br>........................................................................ ";
		// 				echo "</br>No. HP : ......................................................... </p>";
		// 			echo "</td>";
		// 			$data['ID_SEKOLAH']=$id[$i];
		// 			$data['NAMAUSER']="smk".$id[$i]."-".$j;
		// 			$data['PASSWD']=md5($Pass);
		// 			$data['HAK']='inputsmk';
		// 			$data['KETERANGAN']=$Pass;
		// 			$this->m_user_aplikasi->create($data);
		// 			if($j%2==0){
		// 				echo "</tr>";
		// 				if($j<=6)echo "<tr>";
		// 				else echo "</table>";
		// 			}
		// 		}
		// 	}
	 // 	}
	 	//INPUT REKOM//
		echo "<table border=1 width=1000px>";
		echo "<tr>"; 
		for ($j=7; $j <=9 ; $j++) {
			echo "<td style='font-size:20px; padding-left:10px; padding-top:20px; padding-bottom:20px; height:680px;'>";
				$Pass=shuffle_string();
				echo "<h3>Daftar User Input Data PPDB Sidoarjo </h3>";
				echo "<p style='font-size:25px;'>Nama Sekolah : SMK Negeri 3 Buduran</p>";
				echo "<p style='font-size:25px; font-weight:bold;'>User : "."rekomsmp-".$j."";
				echo "</br>Pass : ".$Pass."</p>";

				echo "----------------------------------------------------------------";
				echo "<h2>Penanggung Jawab</h2>";
				echo "<p style='font-size:25px;'>Nama Sekolah : SMK Negeri 3 Buduran</p>";
				echo "<p style='font-size:25px; font-weight:bold;'>User : "."rekomsmp-".$j."";
				echo "</br>Pass : ".$Pass."</p>";
				echo "<p style='font-size:25px;'>Nama Penanggung Jawab : <br>........................................................................ ";
				echo "</br>No. HP : ......................................................... </p>";
			echo "</td>";
			$data['ID_SEKOLAH']="74-".$j;
			$data['NAMAUSER']="rekomsmp-".$j;
			$data['PASSWD']=md5($Pass);
			$data['HAK']='inputrekomsmp';
			$data['KETERANGAN']=$Pass;
			$this->m_user_aplikasi->create($data);
			// if($j%2==0){
			// 	echo "</tr>";
			// 	if($j<=6)echo "<tr>";
			// 	else echo "</table>";
			// }
		}
		echo "<table border=1 width=1000px>";
		echo "<tr>"; 
		for ($j=7; $j <=9 ; $j++) {
			echo "<td style='font-size:20px; padding-left:10px; padding-top:20px; padding-bottom:20px; height:680px;'>";
				$Pass=shuffle_string();
				echo "<h3>Daftar User Input Data PPDB Sidoarjo </h3>";
				echo "<p style='font-size:25px;'>Nama Sekolah : SMK Negeri 3 Buduran</p>";
				echo "<p style='font-size:25px; font-weight:bold;'>User : "."rekomsma-".$j."";
				echo "</br>Pass : ".$Pass."</p>";

				echo "----------------------------------------------------------------";
				echo "<h2>Penanggung Jawab</h2>";
				echo "<p style='font-size:25px;'>Nama Sekolah : SMK Negeri 3 Buduran</p>";
				echo "<p style='font-size:25px; font-weight:bold;'>User : "."rekomsma-".$j."";
				echo "</br>Pass : ".$Pass."</p>";
				echo "<p style='font-size:25px;'>Nama Penanggung Jawab : <br>........................................................................ ";
				echo "</br>No. HP : ......................................................... </p>";
			echo "</td>";
			$data['ID_SEKOLAH']="74-".$j;
			$data['NAMAUSER']="rekomsma-".$j;
			$data['PASSWD']=md5($Pass);
			$data['HAK']='inputrekomsma';
			$data['KETERANGAN']=$Pass;
			$this->m_user_aplikasi->create($data);
			// if($j%2==0){
			// 	echo "</tr>";
			// 	if($j<=6)echo "<tr>";
			// 	else echo "</table>";
			// }
		}
		echo "<table border=1 width=1000px>";
		echo "<tr>"; 
		for ($j=7; $j <=9 ; $j++) {
			echo "<td style='font-size:20px; padding-left:10px; padding-top:20px; padding-bottom:20px; height:680px;'>";
				$Pass=shuffle_string();
				echo "<h3>Daftar User Input Data PPDB Sidoarjo </h3>";
				echo "<p style='font-size:25px;'>Nama Sekolah : SMK Negeri 3 Buduran</p>";
				echo "<p style='font-size:25px; font-weight:bold;'>User : "."rekomsmk-".$j."";
				echo "</br>Pass : ".$Pass."</p>";

				echo "----------------------------------------------------------------";
				echo "<h2>Penanggung Jawab</h2>";
				echo "<p style='font-size:25px;'>Nama Sekolah : SMK Negeri 3 Buduran</p>";
				echo "<p style='font-size:25px; font-weight:bold;'>User : "."rekomsmk-".$j."";
				echo "</br>Pass : ".$Pass."</p>";
				echo "<p style='font-size:25px;'>Nama Penanggung Jawab : <br>........................................................................ ";
				echo "</br>No. HP : ......................................................... </p>";
			echo "</td>";
			$data['ID_SEKOLAH']="74-".$j;
			$data['NAMAUSER']="rekomsmk-".$j;
			$data['PASSWD']=md5($Pass);
			$data['HAK']='inputrekomsmk';
			$data['KETERANGAN']=$Pass;
			$this->m_user_aplikasi->create($data);
			// if($j%2==0){
			// 	echo "</tr>";
			// 	if($j<=6)echo "<tr>";
			// 	else echo "</table>";
			// }
		}
	 	
	 				 		
	}

}	


?>