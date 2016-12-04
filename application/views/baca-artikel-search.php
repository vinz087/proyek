<?php
	if($this->session->userdata("username")){
		if($this->session->userdata("username") == "admin"){
			$this->load->view('header-after-login-admin');
		}
		else if($this->session->userdata("username") != "admin"){
			$this->load->view('header-after-login-user');
		}
	}
	else{
		$this->load->view('header-before-login');
	}
?>
<html>
	<body style="background-color:#FAEBD7">
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php
						if($artikelSearch->num_rows() == 0){
							echo '<div class="alert alert-warning fade in">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>No Article Found!</strong>
								  </div>';
						}
						else{
							$ctr=1;
							foreach($artikelSearch->result() as $row){
								if($ctr % 4 == 1){
									echo "<div class='row' style='margin-top:3%'>";
								}
								echo '<div class="col-md-3">
									<div class="card" style="background-color:#F5F5F5;height:38%; ">
									  <img src="'.base_url("assets/images/food.jpg").'" alt="Avatar" style="width:100%">
									  <div style="padding-left:10%;padding-bottom:2%;">
										<h4>'.$row->judul_artikel.'</h4>
										<div style="position:absolute;top:80%;">
										<a class="btn btn-primary btn-sm" href="'.site_url("ctBase/readArticle/".$row->kode_artikel).'" role="button">Read more >></a></div>
									  </div>
									</div>
								</div>';
								if($ctr % 4== 0){
									echo "</div>";
								}
								$ctr++;
							}
						}
						
					?>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>	
	</body>
</html>		
	
