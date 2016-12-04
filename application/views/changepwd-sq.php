<html>
	<body style="background-color:#FAEBD7;">
		<?php 
			if($this->session->userdata("username")){
				if($this->session->userdata("username") != "admin"){
					$this->load->view('header-after-login-user');
				}
			}
			else{
				$this->load->view('header-before-login');
			}
		?>
		<div class="container">
			<div class="row" style="background-color:white;border-radius:3%;">
				<div class ="col-md-2">
				</div>
				<div class ="col-md-8">
					<h3>Username</h3><hr>
					<?php
						echo validation_errors();
						echo form_open("ctBase/changepassword/".$username);
						echo "New Password:";
						echo form_input("txtpw");
						echo "Confirm New Password:";
						echo form_input("txtcpw");
						echo form_submit("btnChange","Change",'class ="btn btn-primary"');
						echo form_close();
					?>
				</div>
				<div class ="col-md-2">
				</div>
			</div>
		</div>
	</body>
</html>