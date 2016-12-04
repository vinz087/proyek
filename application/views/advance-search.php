<html>
	<body style="background-color:#FAEBD7;">
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
		<div class="container">
			<div class="row" style="background-color:white;border-radius:3%;">
				<div class ="col-md-2"></div>
				<div class ="col-md-8">
				<h1>Advance Search</h1><br>
				<?php
					$arr = array(
								"K01" => "Programming",
								"K02" => "Music",
								"K03" => "Cooking",
								"K04" => "Education",
								"K05" => "Miscellaneous"
						   );
					echo form_open("ctBase/advanceSearch");
					echo "Category: ".form_dropdown("cbkat",$arr)."<br><br>";
					echo "Article content: ".form_input("txtarticlecontent")."<br>";
					echo "Article title: ".form_input("txtarticletitle")."<br>";
					echo form_submit("btnSearch","Search",'class ="btn btn-primary"');
					echo form_close();
				?>
				</div>
				<div class ="col-md-2"></div>
			</div>
		</div>
	</body>
</html>