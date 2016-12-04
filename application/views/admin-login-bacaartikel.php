<html lang="en">
	<body  style="background-color:#FAEBD7;width:100%;">
	<?php
		if($this->session->userdata("username")){
			if($this->session->userdata("username") == "admin"){
				$this->load->view('header-after-login-admin');
			}
		}
		else{
			redirect("ctBase/home");
		}
	?>
		<div style="clear:both"></div>
		<div class = 'container-fluid'>	
		
			<?php 
				$this->load->view("admin-template-bacaartikel");
			?>		
		</div>
	</body>
</html>