<?php
class db_sdp extends CI_model
{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function selectmaksrat(){
		$this->db->select("max(substr(kode_rating,3)) as tot");
		$this->db->from("rating");
		$this->db->where("substr(kode_rating,1,2)","RT");
		$query = $this->db->get();
		if($query->num_rows() == 0) { return "01"; }
		else {
			foreach($query->result() as $qry) {
				if($qry->tot < 10) { return "0".($qry->tot + 1); }
				else {
					return ($qry->tot + 1);
				}
			}
		}
	}
	public function selectup($id){
		$this->db->where("kode_artikel",$id);
		$this->db->where("value",1);
		return $this->db->get('rating')->num_rows();
	}
	public function selectdwn($id){
		$this->db->where("kode_artikel",$id);
		$this->db->where("value",2);
		return $this->db->get('rating')->num_rows();
	}
	public function selectrat($user,$id){
		$this->db->where('username',$user);
		$this->db->where('kode_artikel',$id);
		$hasil = $this->db->get('rating');
		return $hasil;
	}
	public function insertrating($kd,$kdart,$username,$value){
		$myarr = array(
			"kode_rating"=> $kd,
			"kode_artikel"=> $kdart,
			"username"=> $username,
			"value"=> $value
		);
		$hasil = $this->db->insert("rating",$myarr);
		return $hasil;
	}
	public function login($username,$password){
		$index = -3;
		$Find = "select * from user";
		$select = $this->db->query($Find);
		foreach($select->result() as $row)
		{
			if($username == $row->username && $password == $row->password && $row->jenis_user == 1)
			{
				$index = 1;
			}
			if($username == $row->username && $password == $row->password && $row->jenis_user == 0)
			{
				$index = 3;
			}
			else if($username == $row->username && $password != $row->password)
			{
				$index = 2;
			}
		}
		if($index == 1)return 1;
		else if($index == 2)return 0;
		else if($index == 3)return 2;
		else return -1;
	}
	
	public function tampilkan(){
		$this->db->where("kode_artikel = 'AR001'");
		return $this->db->get("artikel")->result_array();
	}
	public function countall_artikel(){
		return $this->db->count_all("artikel"); 
	}
	public function insert_artikel($id_kategori,$isi_artikel,$judul_artikel,$judul_foto,$username,$url){
		$kode_artikel = "AR".str_pad($this->countall_artikel()+1,3,"0",STR_PAD_LEFT);
		$status_artikel = 0;
		$tanggalverifikasi_artikel = "";
		$tanggalapply_artikel = date('Y-m-d');
		$koderequest = "";
		$myarr = array(
			'kode_artikel' => $kode_artikel,
			'id_kategori' => $id_kategori,
			'isi_artikel' => $isi_artikel,
			'judul_foto' => $judul_foto,
			'status_artikel' => $status_artikel,'tanggalverifikasi_artikel' => $tanggalverifikasi_artikel,
			'tanggalapply_artikel' => $tanggalapply_artikel,
			'judul_artikel' => $judul_artikel,
			'username' => $username,
			'koderequest' => $koderequest,
			'jumlah_lihat' => 0,
			'url' => $url
		);
		$this->db->insert('artikel',$myarr);
		return $this->db->affected_rows();
	}
	
	//editan jenni
	//-------------------------------------------------------------------------
	
	public function tambahmostview($kode){
		$this->db->select("jumlah_lihat");
		$this->db->where("kode_artikel",$kode);
		$awal = $this->db->get("artikel")->row()->jumlah_lihat;
		$awal +=1;
		$this->db->where("kode_artikel",$kode);
		$arr = array(
			"jumlah_lihat" => $awal
		);
		$this->db->update("artikel",$arr);
	}
	
	public function fpcekuser($username){
		$index = -1;
		$String = "select * from user";
		$Select = $this->db->query($String);
		foreach($Select->result() as $row)
		{
			if($username == $row->username)
			{
				$index = -2;
			}
		}
		if($index == -1)
		{
			return false;
		}
		else{
			return true;
		}
	}
	
	public function cek_username($username,$password,$nd,$nb,$gender,$tl,$email,$q1,$a1,$q2,$a2){
		$index = -1;
		$String = "select * from user";
		$Select = $this->db->query($String);
		foreach($Select->result() as $row)
		{
			if($username == $row->username)
			{
				$index = -2;
			}
		}
		if($index == -1)
		{
			$this->register($username,$password,$nd,$nb,$gender,$tl,$email,$q1,$a1,$q2,$a2);
			return 1;
		}
		else{
			return 0;
		}
	}
	
	public function getMaxKodeReport(){
		$this->db->select("max(kode_report) maxi");
		$kodemax = substr($this->db->get("report")->row()->maxi,2);
		return $kodemax+1;
	}
	
	public function report($kode,$nama,$alasan){
		$kode_report =  "RE".str_pad($this->getMaxKodeReport(),3,"0",STR_PAD_LEFT);
		$arr = 
		array(
			"kode_report" => $kode_report,
			"kode_artikel" => $kode,
			"alasan_report" => $alasan,
			"nama" => $nama
		);
		$this->db->insert("report",$arr);
	}
	
	public function hapusArticle($kode){
		$arr = array("status_artikel"=>3);
		$this->db->where("kode_artikel",$kode);
		$this->db->update("artikel",$arr);
	}
	
	public function getDetailReport($kode)
	{
		$this->db->select("artikel.*,report.*");
		$this->db->where("report.kode_artikel",$kode);
		$this->db->join("artikel","artikel.kode_artikel = report.kode_artikel");
		return $this->db->get("report");
	}
	
	public function articleReport(){
		$this->db->select("artikel.*,kode_report,count(*) jumlah_report");
		$this->db->join("artikel","artikel.kode_artikel = report.kode_artikel");
		$this->db->where("artikel.status_artikel",1);
		$this->db->group_by("kode_artikel");
		$this->db->order_by("jumlah_report","desc");
		return $this->db->get("report");
	}
	
	public function getSecurityQuestion1($username){
		$this->db->select("q_message1");
		$this->db->where("username",$username);
		return $this->db->get("user");
	}
	
	public function getAnswerQuestion1($username,$answer){
			$this->db->where("username",$username);
			$this->db->where("a_message1",$answer);
			return $this->db->get("user");
	}
	
	public function getSecurityQuestion2($username){
		$this->db->select("q_message2");
		$this->db->where("username",$username);
		return $this->db->get("user");
	}
	
	public function getAnswerQuestion2($username,$answer){
		$this->db->where("username",$username);
		$this->db->where("a_message2",$answer);
		return $this->db->get("user");
	}
	
	public function checkOldPassword($old,$username){
		$this->db->where("password",$old);
		$this->db->where("username",$username);
		return $this->db->get("user");
	}
	
	public function gantinewpass($username,$newpass){
		$sql = "update user set password = '$newpass' where username='".$username."'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	public function register($username,$password,$nd,$nb,$gender,$tl,$email,$q1,$a1,$q2,$a2){
		$input = "insert into user values('".$username."','".$password."','".$nd."','".$nb."','".$gender."','".$tl."','".$email."','"."0"."','"."1"."','".$tl."','".$q1."','".$a1."','".$q2."','".$a2."')";
		$this->db->query($input);
		return 1;
	}
	public function getUser($username)
	{
		$this->db->where("username",$username);
		return $this->db->get("user");
	}
	public function selectuser($username = null)
	{
		if($username == null)
		{
			$select = "select * from user where isblock_user = 0";
			$hasil = $this->db->query($select);
			return $hasil;
		}
		else {
			$select = "update user set isblock_user = 1 where username =?";
			$hasil = $this->db->query($select,$username);
			return 1;		
		}
		
	}
	
	public function getCategory($namacat){
		$id_kategori=$this->carikodeCategory($namacat);
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori",$id_kategori);
		return $this->db->get();
	}
	
	public function getHasilSearchAdvance($categorySearch,$articleContent,$articleTitle){
		$this->db->select("artikel.*,nama_kategori");
		$this->db->join("kategori","kategori.id_kategori = artikel.id_kategori");
		$this->db->where("status_artikel","1");
		$this->db->where("judul_artikel like","%$articleTitle%");
		$this->db->or_where("isi_artikel like","%$articleContent%");
		$this->db->or_where("artikel.id_kategori","$categorySearch");
		$this->db->order_by("jumlah_lihat","desc");
		return $this->db->get("artikel");
	}
	
	public function getHasilSearch($search){
		$this->db->select("artikel.*,nama_kategori");
		$this->db->join("kategori","kategori.id_kategori = artikel.id_kategori");
		$this->db->where("status_artikel","1");
		$this->db->where("judul_artikel like","%$search%");
		$this->db->order_by("jumlah_lihat","desc");
		return $this->db->get("artikel");
	}
	
	//category
	public function carikodeCategory($apa)
	{
		$this->db->select("id_kategori");
		$this->db->from("kategori");
		$this->db->where("nama_kategori",$apa);
		$hasil = $this->db->get();
		foreach($hasil->result() as $row)
		{
			$id_kategori = $row->id_kategori;
		}
		return $id_kategori;
	}
	public function getNumberOfRowsAllArticle($idkategori) {
		$this->db->where("id_kategori",$idkategori);
		return $this->db->get("artikel")->num_rows(); 
	}
	public function getCategoryArticle1($apa,$satu)
	{	
		$id_kategori=$this->carikodeCategory($apa);
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu); // sebanyak, dari
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori",$id_kategori);
		$hasil = $this->db->get();
		return $hasil;
	}
	public function getCategoryArticle2($apa,$dua)
	{	
		$id_kategori=$this->carikodeCategory($apa);
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$dua);
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori",$id_kategori);
		$hasil = $this->db->get();
		return $hasil;
	}
	public function getCategoryArticle3($apa,$tiga)
	{	
		$id_kategori=$this->carikodeCategory($apa);
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$tiga);
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori",$id_kategori);
		$hasil = $this->db->get();
		return $hasil;
	}
	public function selectmaks(){
		$this->db->select("max(substr(kode_commend,3)) as tot");
		$this->db->from("commend");
		$this->db->where("substr(kode_commend,1,2)","CM");
		$query = $this->db->get();
		if($query->num_rows() == 0) { return "01"; }
		else {
			foreach($query->result() as $qry) {
				if($qry->tot < 9) { return "0".($qry->tot + 1); }
				else {
					return ($qry->tot + 1);
				}
			}
		}
	}
	public function insertCommend($kdart,$username,$nama,$isi,$jam){
		$kdcmd = "CM".$this->selectmaks();
		$myarr = array(
			"kode_commend"=> $kdcmd,
			"kode_artikel"=> $kdart,
			"username"=> $username,
			"nama_lengkap"=> $nama,
			"isi"=> $isi,
			"jam"=> $jam
		);
		$hasil = $this->db->insert("commend",$myarr);
		return $hasil;
	}
	public function getAllCommend($a){
		$this->db->where("kode_artikel",$a);
		return $this->db->get("commend");
	}	
	public function selectArtikel($kode_artikel = null)
	{
		if($kode_artikel== null)
		{
			$select = "select * from artikel";
			$hasil = $this->db->query($select);
			return $hasil;
		}
		else if($kode_artikel== "Stat_artikel")
		{
			$select = "select * from artikel where status_artikel = 0";
			$hasil = $this->db->query($select);
			return $hasil;
		}
		else{
			$select = "select * from artikel where kode_artikel=?";
			$hasil = $this->db->query($select,$kode_artikel);
			return $hasil;		
		}
	}
	//==
	//frincent edit
	public function getNumberOfRowsAllArticle1() {
		$this->db->where("status_artikel","1");
		return $this->db->get("artikel")->num_rows(); 
	}
	
	public function getsearchArticle1($satu,$search)
	{	
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu);
		$this->db->where("status_artikel",1);
		$this->db->where("judul_artikel like ","%".$search."%");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	public function getsearchArticle2($satu,$search)
	{	
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu);
		$this->db->where("status_artikel",1);
		$this->db->where("judul_artikel like ","%".$search."%");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	public function getsearchArticle3($satu,$search)
	{	
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu);
		$this->db->where("status_artikel",1);
		$this->db->where("judul_artikel like ","%".$search."%");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	public function getsearchAArticle1($satu,$search,$user,$judul,$isi)
	{	
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu);
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori like ","%".$search."%");
		$this->db->where("username like ","%".$user."%");
		$this->db->where("judul_artikel like ","%".$judul."%");
		$this->db->where("isi_artikel like ","%".$isi."%");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	public function getsearchAArticle2($satu,$search,$user,$judul,$isi)
	{	
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu);
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori like ","%".$search."%");
		$this->db->where("username like ","%".$user."%");
		$this->db->where("judul_artikel like ","%".$judul."%");
		$this->db->where("isi_artikel like ","%".$isi."%");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	public function getsearchAArticle3($satu,$search,$user,$judul,$isi)
	{	
		$this->db->select("*");
		$this->db->from("artikel");
		$this->db->limit(3,$satu);
		$this->db->where("status_artikel",1);
		$this->db->where("id_kategori like ","%".$search."%");
		$this->db->where("username like ","%".$user."%");
		$this->db->where("judul_artikel like ","%".$judul."%");
		$this->db->where("isi_artikel like ","%".$isi."%");
		$hasil = $this->db->get();
		return $hasil;
	}
	
	public function loadkategori(){
		$this->db->from("kategori");
		$data = $this->db->get();
		$arrItem = [];
		$arrItem['all'] = 'All';
		foreach($data->result() as $d)
		{
			$arrItem[$d->id_kategori] = $d->nama_kategori ;
		}
		return $arrItem;
	}

	//jenni edit
	//-----------------------------------------------
	public function sahkan_artikel($kdartikel)
	{
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date("Y-m-d");
		$arr = array(
			"status_artikel" => 1,
			"tanggalverifikasi_artikel" => $tgl
		);
		$this->db->where("kode_artikel",$kdartikel); 
		$this->db->update("artikel",$arr); 	
		return 1;	
		
	}
	public function batalkan_artikel($kdartikel)
	{
		date_default_timezone_set('Asia/Jakarta');
		$tgl = date("Y-m-d");
		$arr = array(
			"status_artikel" => 2,
			"tanggalverifikasi_artikel" => $tgl
		);
		$this->db->where("kode_artikel",$kdartikel); 
		$this->db->update("artikel",$arr); 	
		return 1;	
		
	}
	
	public function getDataArtikel($id){
		$this->db->select("artikel.*,nama_kategori");
		$this->db->join("kategori","kategori.id_kategori = artikel.id_kategori");
		$this->db->where("kode_artikel","$id");
		return $this->db->get("artikel")->row();
	}
	
	public function mostview_artikel(){
		$this->db->select("artikel.*,nama_kategori");
		$this->db->join("kategori","kategori.id_kategori = artikel.id_kategori");
		$this->db->where("status_artikel","1");
		$this->db->order_by("jumlah_lihat","desc");
		$this->db->limit(5);
		return $this->db->get("artikel");
	}
	
	public function reccomend_artikel(){
		$this->db->select("artikel.*,nama_kategori");
		$this->db->join("kategori","kategori.id_kategori = artikel.id_kategori");
		$this->db->where("status_artikel","1");
		$this->db->limit(5);
		return $this->db->get("artikel");
	}
	
	public function newest_artikel(){
		$this->db->select("artikel.*,nama_kategori");
		$this->db->join("kategori","kategori.id_kategori = artikel.id_kategori");
		$this->db->where("status_artikel","1");
		$this->db->order_by("tanggalverifikasi_artikel");
		$this->db->limit(4);
		return $this->db->get("artikel");
	}
	//------------------------------------------------
	public function update_userProfile($fn,$ln,$email,$gender,$username,$foto,$tgl) 
	{
		$arr = array(
			"namadepan_user" => $fn,
			"namabelakang_user" => $ln,
			"email_user" => $email,
			"jeniskelamin_user" => $gender,
			"tanggallahir_user" => $tgl,
			"foto" => $foto
		);
		
		$this->db->where("username",$username); 
		$this->db->update("user",$arr); 	
		return 1;
	}
	
	public function getFoto($username){
		$this->db->select("foto");
		$this->db->where("username",$username);
		return $this->db->get("user")->row();
	}
}

?>