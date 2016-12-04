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
					<h3>Security Question 2</h3><hr>
					<?php
						echo form_open("ctBase/forgetpassword2/".$username);
						echo $sq->row()->q_message2;
						echo form_input("txtanswer2");
						echo form_submit("btnSubmit","Submit",'class ="btn btn-primary"');
						echo form_close();
					?>
				</div>
				<div class ="col-md-2">
				</div>
			</div>
		</div>
	</body>
</html>