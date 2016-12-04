<html>
	<body style="background-color:#FAEBD7;">
		<?php 
			if($this->session->userdata("username")){
				if($this->session->userdata("username") != "admin"){
					$username = $this->session->userdata("username");
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
						
						echo form_open("ctBase/changepwd");
					?>
				</div>
				<div class ="col-md-8">
					<h3>Change Password</h3><hr>
					<?php
						if(isset($msgn)){
							echo '<div class="alert alert-danger">'.$msgn.'</div>';
						}
						else if(isset($msgs)){
							echo '<div class="alert alert-success">'.$msgs.'</div>';
						}
						
						echo "Old Password: ".form_password("txtoldpassword")."<br><br>";
						echo "New Password: ".form_password("txtnewpassword")."<br><br>";
						echo "Confirm New Password: ".form_password("txtconfirm")."<br><br>";
						echo "<a href='".site_url("ctBase/forgetpassword1/".$username)."'>Forget Password?</a><br>";
						echo form_submit("btnSave","Save",'class ="btn btn-primary"');
						echo form_submit("btnCanel","Cancel",'class ="btn btn-danger"')."<br><br>";
						echo form_close();
					?>
				</div>
			</div>
		</div>
	</body>
</html>