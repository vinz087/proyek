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
					<h3>Security Question 1</h3><hr>
					<?php
						echo form_open("ctBase/forgetpassword1/".$username);
						echo $sq->row()->q_message1;
						echo form_input("txtanswer1");
						echo form_submit("btnNext","Next",'class ="btn btn-primary"');
						echo form_close();
					?>
				</div>
				<div class ="col-md-2">
				</div>
			</div>
		</div>
	</body>
</html>