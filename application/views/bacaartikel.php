<!DOCTYPE html>

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
		<div class = 'container-fluid'>	
		
			<?php
			
				
					
				foreach($dataArtikel->result() as $row)
				{
					$judul = $row->judul_artikel;
					$isi =  $row->isi_artikel;	
					$kode =  $row->kode_artikel;
					$url = $row->url;
				}
			?>
			
			<div class="col-md-8" style="position:absolute;top:17%;left:17%">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="background-image: url('<?php echo base_url("assets/images/food.jpg");?>');">
				  <div style="padding:2%;background-color:white;opacity:0.9;">
				  <?php
				  if(isset($msg)){
						echo '<div class="alert alert-success fade in"> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
					}
				  ?>
				  <div><h1 class="display-3" style="text-align:center;"><?php echo $judul?></h1>
				  <hr class="my-2">
				  <p align="justify">
				  <?php 
						echo $isi;
						if($this->session->userdata('urlvideo'))
							echo  "<br><br><a href='".site_url('ctBase/tampilkanvideo/'.$url)."'>Check this for video!!</a>";
				  ?>
				  </p>
				  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalku"><span class="glyphicon glyphicon-list-alt" aria-hidden="true">&nbsp </span>Report This Article</button>
				 </div></div>
				</div>
				<div class="col-md-2" style='position:absolute;top:80%;left:45%;'>
					<?php 
						$a = 0;
						$b = 0;
						$a = $this->db_sdp->selectup($this->session->userdata('idartikel'));
						$b = $this->db_sdp->selectdwn($this->session->userdata('idartikel'));
						echo "<div class='row' style='display:inline;' >
								".$a." <span id='thumbs1' class='glyphicon glyphicon-thumbs-up' style= 'font-size:15px; color:green;'></span>&nbsp&nbsp
								".$b." <span id='thumbs2' class='glyphicon glyphicon-thumbs-down' style= 'font-size:15px; color:red;'></span>
							</div>";
					?>
				</div>
				<div class="col-md-2" style='position:absolute;top:88%;left:68%;'>
					<?php 
							$jum = $this->db_sdp->getAllCommend($this->session->userdata('idartikel'))->num_rows();
							if($jum != 0)
							echo "<label style='color:gray;' data-toggle='modal' data-target='#asd'>".$jum." Komentar ....</label>";
					?>
				</div>
			</div>
			<div class="col-md-2" style='position:absolute;top:63%;left:60%;'>
				
			</div>
		</div>
		
	</body>
	
	
	
		  
	<!-- MODAL LOGIN -->
	<div id='modalku' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Report This Article</h4>
		  </div>
		  <?php echo form_open("ctBase/reportArticle/".$kode); ?>
		  <div class="modal-body">
			<div class="form-group">
			
			  <label for="usr">Name:</label>
			  <input type="text" class="form-control" id="usr" name="txtname" placeholder="Insert your name...">
			  <label for="reason">Choosing a reason for reporting this post:</label>
			  <?php
					$arrCb = array(
								"contains SARA" => "Contains SARA",
								"contains pornography" => "Contains Pornography",
								"is a spam" => "It's a spam",
								"is inappropriate" => "It's inappropriate"
							);
							
					echo form_dropdown("cbReason",$arrCb);
			  ?>
			</div>
			<button type="submit" class="btn btn-danger" name="btnlogin">Report</button>
		  </div>
		  
		  
		

		  <?php echo form_close();?>
		</div>
	  </div>
	</div>
	
	<div id='asd' class="modal fade" role="dialog">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Buat Komentar</h4>
		  </div>
		  <div class="modal-body" style="height:500px; overflow-y: scroll;">
				<?php
				$allcmd = $this->db_sdp->getAllCommend($this->session->userdata('idartikel'));
				echo validation_errors();
				echo form_open("ctBase/createcmd");
				if($this->session->userdata('username')){
					//echo "Kode_cmd :".form_input("txtkd")."<br>";
					echo form_textarea("txtcmd","","id='txtcmd' class=form-control")."<br>";
					$attributes = array(
						'id' => 'status',
						'style' => 'color: #000; padding-right : 12%;'
					);
					echo form_label('200', 'status', $attributes);
					echo form_submit("btncmd", "Post Commend");
					echo form_close();
					$test = $this->db_sdp->selectrat($this->session->userdata('username'),$this->session->userdata('idartikel'));
					if($test->row() == null) $hasil = 0;
					else  $hasil = $test->row()->value;
					$param['data'] = $hasil;
					echo "<script>alert(".$param['data'].");</script>";
					$this->load->view('test',$param);
				}
				$ctr =1;
				$ctrjam=1;
				if($allcmd != null ){
					foreach($allcmd->result() as $row){
						echo "<div >";
						if($row->nama_lengkap==null) $nama = $row->username;
						else $nama = $row->nama_lengkap;
						echo form_open("artikel/deletecmd");
						echo '<div id="commend'.$ctr++.'" style="font-size:14px; width: 100%; border: 1px solid black;">';
						echo '<div style="font-size:14px; float:left;">'.$nama." &nbsp&nbsp&nbsp @".$row->username."</div><br>";
						echo '<div id="jam'.$ctrjam++.'" style="font-size:14px; float:right;">'.$row->jam."</div><br>";
						echo '<div style="font-size:14px;" align="center">'.$row->isi."</div>";
						$isicmd = $row->isi;
						$usercmd = $row->username;
						$jamcmd = $row->jam;
						
						echo form_input("txtisi",$isicmd,"style='display:none'");
						echo form_input("txtusername",$usercmd,"style='display:none'");
						echo form_input("txtjam",$jamcmd,"style='display:none'");

						echo "</div><br>";
						echo form_close();
					
					}
				}
				echo form_input("txtctr",$ctr-1,"id=txtctr style='display:none'");
				echo "</div>";
			?>
		  </div>
		</div>
	  </div>
	</div>
</html>
  		
