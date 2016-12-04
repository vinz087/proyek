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
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php
					foreach($detailReport->result() as $row){
						$judul = $row->judul_artikel;
					}
					echo "<h3>Judul Artikel: ".$judul."</h3>";
				?>
				<table class='table table-sm table-inverse'>
					<thead>
						<th>Report Code</th>
						<th>Name</th>
						<th>Reason</th>
					</thead>
					<tbody>
						<?php
							foreach($detailReport->result() as $row){
								echo "<tr>";
									echo "<td>".$row->kode_report."</td>";
									if($row->nama != ""){
										echo "<td>".$row->nama."</td>";
									}
									else{
										echo "<td>-</td>";
									}
									echo "<td>"."This article ".$row->alasan_report."</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-md-2"></div>
			<div class="clearfix visible-lg"></div>
		  </div>
</div>
</body>
</html>
  		
