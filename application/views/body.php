<html lang="en">
	<body>
		<div style="clear:both"></div>
		<div class = 'container'>
			<div class="row">
				<div class="col-md-8">
					<?php
						$ctr =0;
						foreach($mostViewArtikel->result() as $row){
							if($ctr == 0){
								$judulArtikel = $row->judul_artikel;
								$penulis = $row->username;
								$kategori = $row->nama_kategori;
								$isi = $row->isi_artikel;
								$kode = $row->kode_artikel;
							}
							$ctr++;
						}
					?>
					<div class="jumbotron" style="background-image: url('<?php echo base_url("assets/images/food.jpg");?>');">
					  <div style="padding:2%;background-color:white;opacity:0.9;"><div><h1 class="display-3" style="text-align:center;"><?php echo $kategori; ?></h1>
					  <p class="lead" style="text-align:center"><?php echo $judulArtikel;
											echo "<br>By: ".$penulis;
									  ?></p>
					  <hr class="my-2">
					  <p><?php echo substr($isi,0,143)."..."; ?></p>
					  <p class="lead">
						<a class="btn btn-primary btn-lg" href="<?php echo site_url("ctBase/readArticle/".$kode);?>" role="button">Read more >></a>
					  </p></div></div>
					</div>
					<div class="row">
						<?php
							$ctr =0;
							foreach($mostViewArtikel->result() as $row){
								if($ctr > 0){
									echo '<div class="col-md-3">
										<div class="card" style="background-color:#F5F5F5;height:42%;">
										  <img src="'.base_url("assets/images/food.jpg").'" alt="Avatar" style="width:100%">
										  <div style="padding-left:10%;padding-bottom:2%;">
											<h4><b>'.$row->nama_kategori.'</b></h4> 
											<p>'.$row->judul_artikel.'</p> 
											<div style="position:absolute;top:80%;">
											<a class="btn btn-primary btn-sm" href="'.site_url("ctBase/readArticle/".$row->kode_artikel).'" role="button">Read more >></a></div>
										  </div>
										</div>
									</div>';
								}
								$ctr++;
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>