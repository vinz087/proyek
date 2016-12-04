<html lang="en">
	<body>
		<div class = 'container'>
			<div class="row">
				<div class="col-md-8">
					<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin:2%;">
						<!-- Indicators -->
						<ol class="carousel-indicators">
						  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						  <li data-target="#myCarousel" data-slide-to="1"></li>
						  <li data-target="#myCarousel" data-slide-to="2"></li>
						  <li data-target="#myCarousel" data-slide-to="3"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
						  <?php
								$ctr=0;
								foreach($newestArtikel->result() as $row){
									if($ctr ==0){
										echo '<div class="item active">';
										 echo '<img src="'.base_url("assets/images/bootstrap.png").'" alt="Bootstrap">';
										 echo '<div class="carousel-caption"><br><br>';
											echo '<div style="background-color:white;opacity:0.8">';
											echo '<h3 style="color:black;">'.$row->nama_kategori.'</h3>';
											echo '<a href="'.site_url("ctBase/readArticle/".$row->kode_artikel).'"><p>'.$row->judul_artikel.'</p></a>';
											echo "</div>";
										 echo ' </div>';
										echo '</div>';
									}
									else{
										echo '<div class="item">';
										 echo '<img src="'.base_url("assets/images/bootstrap.png").'" alt="Bootstrap">';
										 echo '<div class="carousel-caption">';
										 echo '<div style="background-color:white;opacity:0.8">';
											echo '<h3 style="color:black;">'.$row->nama_kategori.'</h3>';
											echo '<a href="'.site_url("ctBase/readArticle/".$row->kode_artikel).'"><p>'.$row->judul_artikel.'</p></a>';
											echo ' </div>';
										 echo ' </div>';
										echo '</div>';
									}
									$ctr++;
								}
						  ?>
						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						  <span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						  <span class="sr-only">Next</span>
						</a>
					  </div>
				</div>
			</div>
		</div>
	</body>
</html>