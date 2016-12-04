<!DOCTYPE html>
<html lang="en">
<body>
		<div class="container">
		  <div class="row">
			<div class="col-md-3">
			  <ul class="nav nav-pills nav-stacked">
				
				<li ><a href=<?php echo site_url("ctBase/gotouserControl")?>>User</a></li>
				<li class="active"><a href=<?php echo site_url("ctBase/gotoarticleControl")?>>Artikel</a></li>
				<li><a href=<?php echo site_url("ctBase/gotoreportControl")?>>Report</a></li>
			  </ul>
			</div>
			<div class="col-md-9">
				<?php		
					
					if(isset($msg)){
						echo '<div class="alert alert-success fade in"> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';
					}
						
					echo "<table class='table table-sm table-inverse'>";
					echo "<thead>";
						echo "<th> judul artikel </th>";
						echo "<th> isi artikel </th>";
					echo "</thead>";
					echo "<tbody>";
					$js = ' class ="btn btn-deep-purple btn-default"';
					$js2 = ' class ="btn btn-success"';
					$js3 = ' class ="btn btn-danger"';
					foreach($this->session->userdata('selectAllArtikel')->result() as $user)
					{
						echo form_open("ctBase/admin");
						echo "<tr>";
							echo form_hidden("hiddenID",$user->kode_artikel);
							echo "<td>".$user->judul_artikel."</td>";
							echo "<td>".substr($user->isi_artikel, 0, 100)."...".form_submit("btnbacaartikel","View More!",$js)."</td>";
							echo "<td>".form_submit("btnsahkan","SAHKAN",$js2)."</td>";
							echo "<td>".form_submit("btnbatalkan","BATALKAN",$js3)."</td>";
						echo "</tr>";
						echo form_close();
					}
					echo "</tbody>";
					echo "</table>";
					
				?>
			</div>
		  </div>
</div>
</body>
</html>
  		
