<html lang="en">
	<body  style="background-color:#FAEBD7;width:100%;">
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
		<div style="clear:both"></div>
		<div class = 'container'>
			<div class="row">
				<div class="col-md-8">
				<?php 
					$this->load->view("body");
					echo "<br>";
					$this->load->view("newestartikel");
				?>
				</div>	
				<div class="col-md-4">
				<?php 
					$this->load->view("recommendedartikel");
				?>
				</div>	
			</div>
			<div class="row">
				<?php $this->load->view("team");?>
			</div>
		</div>
		<?php 
					$this->load->view("footer");
		?>
	</body>
</html>