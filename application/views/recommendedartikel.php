<div style="width:100%; height:180%; margin-left:5%;">
<h3>Recommended Article</h3><br>
<div class="row" style="width:100%; height:100%;">
		<?php
			foreach($reccomendArtikel->result() as $row){
				echo '<div style="box-shadow: 5px 5px 10px grey;width:97%;">
						<div class="media-left" style="padding:3%;background-color:#FFF8DC;width:40%;height:19%;float:left;">
						  <img src="'.base_url("assets/images/food.jpg").'" class="media-object" style="width:100%; padding-top:3%;">
						</div>
						<div class="media-body" style="padding:5%;height:19%;background-color:	#FFF8DC;">
						  <h4 class="media-heading">'.$row->judul_artikel.'</h4>
						  <p>'.substr($row->isi_artikel,0,100)."...".'</p>
						  <a class="btn btn-primary btn-sm" href="'.site_url("ctBase/readArticle/".$row->kode_artikel).'" role="button">Read more >></a>
						</div>
					</div>
					<div style="clear:both"></div>
					<br>';
			}
		?>
	  </div>
	 <hr>
</div><br>
