<html>
	<body style="background-color:#FAEBD7;">
		<?php 
			if($this->session->userdata("username")){
				if($this->session->userdata("username") != "admin"){
					$this->load->view('header-after-login-user');
				}
			}
			else{
				redirect("ctBase/home");
			}
		?>
		<div class="container">
			<div class="row" style="background-color:white;border-radius:3%;">
				
				<div class ="col-md-4">
					<?php
						echo form_open_multipart("ctBase/profile");		
						echo "<h1 style='text-align:center'>Profile Picture</h1>";
					?>
					<div style="margin-left:25%; margin-top: 10%">
					<img src="<?php echo base_url("profile/".$user->row()->foto)?>" class="img-thumbnail" alt="Cinque Terre" width="75%" height="75%">
					<?php echo form_upload("txtfoto");?>
					</div>
				</div>
				<div class ="col-md-8">
					<h3>Personal Info</h3><hr>
					<?php
						if(isset($notsuccess)){
							echo '<div class="alert alert-danger">
									  <strong>Success update profile</strong>'.$notsuccess.'
								  </div>';
						}
						else if(isset($success)){
							echo '<div class="alert alert-success">'.$success.'</div>';
						}
					
						echo "First Name".form_input("txtnamadepan",$user->row()->namadepan_user)."<br><br>";
						echo "Last Name".form_input("txtnamabelakang",$user->row()->namabelakang_user)."<br><br>";
						echo "Tanggal Lahir: ".form_input("txttgl",$user->row()->tanggallahir_user)."<br><br>";
						echo "<h3>Private Information</h3>";
						echo "Email: ".form_input("txtemail",$user->row()->email_user)."<br><br>";
						if($user->row()->jeniskelamin_user == "L"){
							echo "Gender: ".form_radio("rdjk","L",true)."Male ".form_radio("rdjk","P")."Female<br><br>";
						}
						else{
							echo "Gender: ".form_radio("rdjk","L")."Male ".form_radio("rdjk","P",true)."Female<br><br>";
						}
						echo form_submit("btnSave","Save",'class ="btn btn-primary"');
						echo form_submit("btnCancel","Cancel",'class ="btn btn-danger"');
						echo form_close();
					?>
				</div>
			</div>
		</div>
	</body>
</html>