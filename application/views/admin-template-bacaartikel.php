<!DOCTYPE html>
<html lang="en">
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<?php
					foreach($this->session->userdata('hasil')->result() as $row)
					{
						echo "<H1>".$row->judul_artikel."</H1>";
						echo $row->isi_artikel;	
					}
				?>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</body>
</html>
  		
