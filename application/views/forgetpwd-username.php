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
						echo form_open("ctBase/forgetpassword_n");
						echo "Username:";
						echo form_input("txtusername");
						echo form_submit("btnUsername","Next",'class ="btn btn-primary"');
						echo form_close();
					?>
				</div>
				<div class ="col-md-2">
				</div>
			</div>
		</div>
	</body>
</html>