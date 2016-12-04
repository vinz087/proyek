<!DOCTYPE html>
<html lang="en">
<body>
		<div class="container">
		  <div class="row">
			<div class="col-md-3">
			  <ul class="nav nav-pills nav-stacked">
				<li class="active"><a href=<?php echo site_url("ctBase/gotouserControl")?>>User</a></li>
				<li ><a href=<?php echo site_url("ctBase/gotoarticleControl")?>>Artikel</a></li>
				<li><a href=<?php echo site_url("ctBase/gotoreportControl")?>>Report</a></li>
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
						echo "<th> username </th>";
						echo "<th> Tanggal </th>";
						echo "<th> Block User </th>";
					echo "</thead>";
					echo "<tbody>";
					$js3 = ' class ="btn btn-danger" style="width:100%"';
					foreach($selectuser->result() as $user)
					{
						echo form_open("ctBase/admin");
						echo "<tr>";
							echo "<td>".$user->username."</td>";
							echo "<td>".$user->tanggaljoin_user."</td>";
							echo "<td>".form_submit("btnblocked",$user->username,$js3)."</td>";
						echo "</tr>";
						echo form_close();
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
  		
