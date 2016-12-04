<!DOCTYPE html>
<html lang="en">
<body style="background-color:#FAEBD7;width:100%;">
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
		<div class="container">
		  <div class="row">
			<div class="col-md-3">
			  <ul class="nav nav-pills nav-stacked">
				<li><a href=<?php echo site_url("ctBase/gotouserControl")?>>User</a></li>
				<li><a href=<?php echo site_url("ctBase/gotoarticleControl")?>>Artikel</a></li>
				<li class="active"><a href=<?php echo site_url("ctBase/gotoreportControl")?>>Report</a></li>
			  </ul>
			</div>
			<div class="col-md-9">
			  <tbody>
				<?php		
					if(isset($msg)){
						echo '<div class="alert alert-success fade in"> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
					}
					
					echo "<table class='table table-sm table-inverse'>";
					echo "<thead>";
						echo "<th> Judul Artikel </th>";
						echo "<th> Isi Artikel </th>";
						echo "<th> Jumlah Report </th>";
						echo "<th> Hapus Artikel </th>";
					echo "</thead>";
					echo "<tbody>";
					$js = ' class ="btn btn-deep-purple btn-default"';
					$js3 = ' class ="btn btn-danger" style="width:100%"';
					if($articleReport->num_rows() > 0){
						foreach($articleReport->result() as $row)
						{
							echo form_open("ctBase/gotoreportControl/".$row->kode_artikel);
							echo "<tr>";
								echo "<td>".$row->judul_artikel."</td>";
								echo "<td>".substr($row->isi_artikel, 0, 100)."...".form_submit("btnbacaartikel","View More!",$js).form_submit("btndetailreport","View Report Detail",$js)."</td>";
								echo "<td>".$row->jumlah_report."</td>";
								echo "<td>".form_submit("btnhapus","Delete",$js3)."</td>";
							echo "</tr>";
							echo form_close();
						}
					}
					
					echo "</tbody>";
					echo "</table>";
					
				?>
			  </tbody>
			</div>
			<div class="clearfix visible-lg"></div>
		  </div>
</div>
</body>
</html>
  		
