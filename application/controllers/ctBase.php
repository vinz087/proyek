<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctBase extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form"); 
		$this->load->library("form_validation"); 
		$this->load->helper("url"); 
		$this->load->model("db_sdp");
		$this->load->library("session");
		$this->load->library("pagination"); 
		$this->load->library("upload");
		//hapus cache
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	public function index()
	{
		redirect("ctBase/home");
	}
	
	public function home(){
		$data["newestArtikel"] = $this->db_sdp->newest_artikel();
		$data["mostViewArtikel"] = $this->db_sdp->mostview_artikel();
		$data["reccomendArtikel"] = $this->db_sdp->reccomend_artikel();
		$this->load->view('body-home',$data);
	}

	public function create(){
		if($this->session->userdata("username")){
			if($this->input->post("btnsubmit")){
				$isi_artikel = $this->input->post("txt"); //<< bwt ambil txt tiny mce
				$judul_artikel = $this->input->post("txtjudul");
				$id_kategori = $this->input->post("txtkategori");
				$url = $this->input->post('txturl');
				$config['upload_path'] = './assets/img';	
				$config['allowed_types'] = 'png|gif|jpg';
				$config['overwrite'] = true;
				$gambar = $this->input->post('gambar');
				$username = $this->session->userdata("username");
				$this->upload->initialize($config);
				if($url == ""){
					$url = "none";
				}
				if(!$this->upload->do_upload("gambar"))	// jika upload tidak berhasil
				{
					$err = $this->upload->display_errors();
					if(!(strpos($err,"filetype") === false)) { 
						echo "type file tidak sama<br><br>"; 
					}
					else if(!(strpos($err,"maximum height") === false)) { 
						echo "ukuran gambar salah<br><br>"; 
					}
					echo $err;
				}
				else										// jika upload berhasil
				{
					$judul_foto  = $this->upload->data()['file_name']; 

					$data = $this->db_sdp->insert_artikel($id_kategori,$isi_artikel,$judul_artikel,$judul_foto,$username,$url);
					if ($data > 0)
					{
						echo "<script>alert('Berhasil Insert!');</script>";
					}
					else
					{
						echo "<script>alert('Gagal Insert!');</script>";
					}
				}
			}
			else if($this->input->post("btncancel")){
				redirect('ctBase/home');
			}
			$this->load->view("user-createartikel");
		}
	}
	public function register(){
		if($this->input->post('btnRegister'))
		{
			$username = $this->input->post('inputUsername');
			$password = $this->input->post('inputPassword');
			$nd		  = $this->input->post('inputFN');
			$nb       = $this->input->post('inputLN');
			$gender   = $this->input->post('optGender');
			$tl       = $this->input->post('datepicker');
			$tanggal = "";
			$pieces = explode("-", $tl);
			for($i = 2; $i>= 0 ;$i--)
			{
				if($i == 0)
				{
					$tanggal = $tanggal.$pieces[$i];	
				}
				else
				{
					$tanggal = $tanggal.$pieces[$i]."-";			
				}
			}
			$email    = $this->input->post('inputEmail');
			$q1       = $this->input->post('inputQ1');
			$a1       = $this->input->post('inputA1');
			$q2       = $this->input->post('inputQ2');
			$a2       = $this->input->post('inputA2');
			
			$berhasil = $this->db_sdp->cek_username($username,$password,$nd,$nb,$gender,$tanggal,$email,$q1,$a1,$q2,$a2);
			if($berhasil == 0)
				$this->session->set_flashdata('pesan', 'gagal register username kembar');
			else
				$this->session->set_flashdata('pesan', 'Berhasil Register');
			
			if($this->session->flashdata('pesan')!== null)
			{
				echo "<script> alert('".$this->session->userdata('pesan')."')</script>";
			}
			$this->load->view('user-registering');
		}
		else{
			$this->load->view('user-registering');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata("username");
		redirect("ctBase/home");
	}
	public function login()
	{
		$username = $this->input->post("txtusername");
		$password = $this->input->post("txtpassword");
		$hasil = $this->db_sdp->login($username,$password);
		
		$stat_artikel = "Stat_artikel";
		$this->session->set_userdata('selectAllArtikel',$this->db_sdp->selectArtikel($stat_artikel));
		//$data['selectAllArtikel'] = $this->db_sdp->selectArtikel($stat_artikel);
		$data['Userlogin'] = $this->db_sdp->getUser($username);
		$data["suksesgak"] = "";
		foreach($data['Userlogin']->result() as $row)
		{
			$data["username"] = $row->username;
			$data["password"] = $row->password;
			$data["email"] = $row->email_user;
			$data["namadepan"] = $row->namadepan_user;
			$data["namabelakang"] = $row->namabelakang_user;
			//$data["Answer1"] = $row->a_message1;
			//$data["Answer2"] = $row->a_message2;
		}
		if($hasil == 1)	
		{
			$this->session->set_userdata("username","admin");
			redirect("ctBase/home");
		}
		else if($hasil == 2)	
		{
			$this->session->set_userdata("username",$username);
			redirect("ctBase/home");
		}
		else if($hasil == 0) 
		{
			//echo "password salah gagal login";
			redirect("ctBase/home");
		}
		else 
		{
			//echo "gagal login";
			redirect("ctBase/home");
		}	
	}
	
	public function forgetpassword_n(){
		if($this->input->post("btnUsername")){
			$username = $this->input->post("txtusername");
			$data["sq"] = $this->db_sdp->getSecurityQuestion1($username);
			$data["username"] = $username;
			if($data["sq"]->num_rows() > 0){
				$this->load->view("forgetpwd1",$data);
			}
			else{
				echo "<script>alert('Username Tidak Terdaftar')</script>";
				$this->load->view("forgetpwd-username");
			}
		}
		else{
			$this->load->view("forgetpwd-username");
		}	
	}
	
	public function forgetpassword1($username){
		if($this->input->post("btnNext")){
			$answer = $this->input->post("txtanswer1");
			if($this->db_sdp->getAnswerQuestion1($username,$answer)->num_rows() > 0){
				$data["sq"] = $this->db_sdp->getSecurityQuestion2($username);
				$data["username"] = $username;
				$this->load->view("forgetpwd2",$data);
			}
			else{
				echo "<script>alert('Jawaban Anda Salah')</script>";
				$data["sq"] = $this->db_sdp->getSecurityQuestion1($username);
				$data["username"] = $username;
				$this->load->view("forgetpwd1",$data);
			}
		}
		else{
			$data["sq"] = $this->db_sdp->getSecurityQuestion1($username);
			$data["username"] = $username;
			$this->load->view("forgetpwd1",$data);
		}	
	}
	
	public function forgetpassword2($username){
		if($this->input->post("btnSubmit")){
			$answer = $this->input->post("txtanswer2");
			if($this->db_sdp->getAnswerQuestion2($username,$answer)->num_rows() > 0){
				$data["username"] = $username;
				$this->load->view("changepwd-sq",$data);
			}
			else{
				echo "<script>alert('Jawaban Anda Salah')</script>";
				$data["sq"] = $this->db_sdp->getSecurityQuestion2($username);
				$data["username"] = $username;
				$this->load->view("forgetpwd2",$data);
			}
		}
		else{
			$data["sq"] = $this->db_sdp->getSecurityQuestion2($username);
			$data["username"] = $username;
			$this->load->view("forgetpwd2",$data);
		}	
	}
	
	public function changepassword($username){
		$this->form_validation->set_rules("txtpw","Password","required");
		$this->form_validation->set_rules("txtcpw","Password","matches[txtpw]");
		if($this->form_validation->run() == TRUE){
			$newpass = $this->input->post("txtcpw");
			$this->db_sdp->gantinewpass($username,$newpass);
			redirect("ctBase/home");
		}
		else{
			$data["username"] = $username;
			$this->load->view("changepwd-sq",$data);
		}
	}
	
	public function reportArticle($kode){
		$nama = $this->input->post("txtname");
		$alasan = $this->input->post("cbReason");
		$this->db_sdp->report($kode,$nama,$alasan);
		redirect("ctBase/readArticle/".$kode."/success");
	}
	
	public function gotouserControl()
	{
		$data['selectuser'] = $this->db_sdp->selectuser();			
		$this->load->view("admin-login-user",$data);		
	}	
	
	public function gotoarticleControl()
	{
		redirect("ctBase/admin");
	}
	
	public function gotoreportControl($kode = null)
	{
		if($this->input->post("btnbacaartikel")){
			$data["ID_artikel"]=$kode;
			$this->session->set_userdata('hasil',$this->db_sdp->selectArtikel($data["ID_artikel"]));
			$this->load->view('admin-login-bacaartikel',$data);
		}
		else if($this->input->post("btnhapus")){
			$this->db_sdp->hapusArticle($kode);
			$data['articleReport'] = $this->db_sdp->articleReport();	
			$this->load->view("admin-template-report",$data);
		}
		else if($this->input->post("btndetailreport")){
			$data["detailReport"] = $this->db_sdp->getDetailReport($kode);
			$this->load->view("admin-detail-report",$data);
		}
		else{
			$data['articleReport'] = $this->db_sdp->articleReport();	
			$this->load->view("admin-template-report",$data);	
		}
	}
	
	public function profile(){
		$username = $this->session->userdata("username");
		if($this->input->post("btnSave")){
			$namadepan = $this->input->post("txtnamadepan");
			$namabelakang = $this->input->post("txtnamabelakang");
			$tanggallahir = $this->input->post("txttgl");
			$email = $this->input->post("txtemail");
			$jk = $this->input->post("rdjk");
			$fotolama = $this->db_sdp->getFoto($username)->foto;
			
			$config["upload_path"] ="./profile/";
			$config["allowed_types"] ="JPG|jpg|png|PNG";
			$config["overwrite"] = true;
			$config["file_name"] = $username;
			$this->upload->initialize($config);
			$bolehupdate = false;
			if(!$this->upload->do_upload("txtfoto")){
				if(strpos($this->upload->display_errors(),"You did not select a file to upload.")){
					$foto=$fotolama;
					$bolehupdate=true;
				}
				else{
					$data["notsuccess"] = $this->upload->display_errors();
				}
			}
			else{
				$file = $this->upload->data();
				$foto = $file["file_name"];
				$bolehupdate=true;
			}
			if($bolehupdate){
				$this->db_sdp->update_userProfile($namadepan,$namabelakang,$email,$jk,$username,$foto,$tanggallahir);
				$data["success"] = "You have successfully updated your profile";
			}
			$data["user"] = $this->db_sdp->getUser($this->session->userdata("username"));
			$this->load->view("user-profile",$data);
		}
		else if($this->input->post("btnCancel")){
			redirect("ctBase/home");
		}
		else{
			$data["user"] = $this->db_sdp->getUser($this->session->userdata("username"));
			$this->load->view("user-profile",$data);
		}
			
	}
	
	public function changepwd(){
		$username = $this->session->userdata("username");
		if($this->input->post("btnSave")){
			$old = $this->input->post("txtoldpassword");
			$new = $this->input->post("txtnewpassword");
			$cnew = $this->input->post("txtconfirm");
			if($this->db_sdp->checkOldPassword($old,$username)->num_rows() > 0){
				$this->form_validation->set_rules("txtnewpassword","Password","required");
				$this->form_validation->set_rules("txtconfirm","Password","matches[txtnewpassword]");
				if($this->form_validation->run() == TRUE){
					$newpass = $this->input->post("txtconfirm");
					$this->db_sdp->gantinewpass($username,$newpass);
					$data["msgs"] = "You have succesfully changed your password";
				}
				else{
					$data["msgn"] = validation_errors();
				}
				
				$this->load->view("user-account-settings",$data);
			}
			else{
				$data["msgn"] = "Wrong old password";
				$this->load->view("user-account-settings",$data);
			}
		}
		else if($this->input->post("btnCancel")){
			redirect("ctBase/home");
		}
		else{
			$this->load->view("user-account-settings");
		}
	}
	//disini
	
	
	public function advanceSearch(){
		if($this->input->post("btnSearch")){
			$categorySearch = $this->input->post("cbkat");
			$articleContent = $this->input->post("txtarticlecontent");
			$articleTitle = $this->input->post("txtarticletitle");
			$data["artikelSearch"] = $this->db_sdp->getHasilSearchAdvance($categorySearch,$articleContent,$articleTitle);
			$this->load->view("baca-artikel-search",$data);
		}
		else{
			$this->load->view("advance-search");
		}
		
	}
	
	public function search(){
		$search = $this->input->post("txtsearch");
		if($search !=""){
			$data["artikelSearch"] = $this->db_sdp->getHasilSearch($search);
			$this->load->view("baca-artikel-search",$data);
		}
		else{
			redirect("ctBase/home");
		}
	}
	
	public function admin(){
		if($this->input->post("btnbacaartikel"))
		{
			$data["ID_artikel"]=$this->input->post("hiddenID");
			$this->session->set_userdata('hasil',$this->db_sdp->selectArtikel($data["ID_artikel"]));
			$this->load->view('admin-login-bacaartikel',$data);
		}
		else if($this->input->post("btnblocked")){
			$hasil = $this->input->post("btnblocked");
			$block = $this->db_sdp->selectuser($hasil);
			if($block == 1){
				$data["msg"] = "User has been successfully blocked";
			}
			$data['selectuser'] = $this->db_sdp->selectuser();
			$this->load->view("admin-login-user",$data);
		}
		else if($this->input->post("btnsahkan"))
		{
			$data["ID_artikel"]=$this->input->post("hiddenID");
			$data['hasil'] = $this->db_sdp->sahkan_artikel($data["ID_artikel"]);
			$this->session->set_userdata('selectAllArtikel',$this->db_sdp->selectArtikel("Stat_artikel"));
			if($data['hasil']== 1){
				$data["msg"] = "Article has been successfully verified";
			}
			$this->load->view("admin-login-artikel",$data);
		}
		else if($this->input->post("btnbatalkan"))
		{
			$data["ID_artikel"]=$this->input->post("hiddenID");
			$data['hasil'] = $this->db_sdp->batalkan_artikel($data["ID_artikel"]);
			$this->session->set_userdata('selectAllArtikel',$this->db_sdp->selectArtikel("Stat_artikel"));
			if($data['hasil']== 1){
				$data["msg"] = "Article has been successfully canceled";
			}
			$this->load->view("admin-login-artikel",$data);
		}
		else{
			$this->session->set_userdata('selectAllArtikel',$this->db_sdp->selectArtikel("Stat_artikel"));
			$data['Userlogin'] = $this->db_sdp->getUser($this->session->userdata("username"));
			$data["suksesgak"] = "";
			$data["msg"] = "";
			$this->load->view("admin-login-artikel"); 
		}
	}
	
	public function readArticle($kode,$msg = "a"){
		$this->session->unset_userdata("urlvideo");
		$this->session->set_userdata("idartikel",$kode);
		$data["ID_artikel"]=$this->input->post("hiddenID");
		$data["dataArtikel"] = $this->db_sdp->selectArtikel($kode);
		if($msg != "a"){
			$data["msg"] = "This article has been successfully reported";
		}
		$url = $data["dataArtikel"]->row()->url;
		if($url!="none"){
			$this->session->set_userdata("urlvideo",$url);
		}
		$this->load->view("bacaartikel",$data);
	}
	public function tampilkanvideo($a){
		if($this->input->post("btnback")){
			$this->session->unset_userdata("urlvideo");
			redirect("ctBase/readArticle/".$a);
		}
		$param['url']= $this->session->userdata('urlvideo');
		$this->load->view('video',$param);
	}
	public function rating()
	{
		$kdart = $this->session->userdata("idartikel");
		
		$temp = $this->input->post("result");
		
		if($temp == 'up'){
			$hasil = 1;
		}
		else if($temp == 'down'){
			$hasil = 2;
		}
		else{
			$hasil = 0;
		}
		$username = $this->session->userdata('username');
		$kd = "RT".$this->db_sdp->selectmaksrat();
		if($this->db_sdp->insertrating($kd,$kdart,$username,$hasil)){
			echo "sukses";
		}
		else
		{
			echo "gagal";
		}
	}
	public function createcmd(){
		$fullname = "";
		$temp = $this->db_sdp->getuser($this->session->userdata("username"));
		if($this->input->post("btncmd") && $this->input->post("txtcmd")){
			$kdart = $this->session->userdata("idartikel");
			foreach($temp->result_array() as $temp){
				$fullname = $temp['namadepan_user']." ".$temp['namabelakang_user'];
			}
			echo $fullname."nama";
			$user = $this->session->userdata('username');
			date_default_timezone_set("Asia/Jakarta");
			$isicommend = $this->input->post("txtcmd");
			$jamcommend = date("Y-m-d H:i:s");
			if($this->db_sdp->insertCommend($kdart,$user,$fullname,$isicommend,$jamcommend) >0) echo "<script>alert('Berhasil mengomentari');</script>";
			else
			"<script>alert('Gagal mengomentari');</script>";
			redirect("ctBase/readArticle/".$this->session->userdata("idartikel"));
		}
	}
	public function writearticle(){
		$this->load->view("user-createartikel");
	}
	public function category($cat){
		$data["allArtikel"] = $this->db_sdp->getCategory($cat);
		$this->load->view("category",$data);
	}
}
