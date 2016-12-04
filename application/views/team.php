<html lang="en">
	<body  style="background-color:#FAEBD7;width:100%;">
		<div style="clear:both"></div>
		<div class = 'container'>
			<div id="team">
				<h1>Meet The Team</h1>
				<div class="row" style="background-color:white;">
					<div class="col-md-3" style="text-align:center;margin-top:3%;margin-bottom:3%;">
					<img src="<?php echo base_url('team/erwin.jpg');?>" class="img-circle" alt="Cinque Terre" width="70%" height="30%"><br>
					<h3> Erwin Tandean</h3>
					</div>
					<div class="col-md-3" style="text-align:center;margin-top:3%;margin-bottom:3%;">
					<img src="<?php echo base_url('team/jenni.jpg');?>" class="img-circle" alt="Cinque Terre" width="70%" height="30%"><br>
					<h3>Jenni Irawan</h3>
					</div>
					<div class="col-md-3" style="text-align:center;margin-top:3%;margin-bottom:3%;">
					<img src="<?php echo base_url('team/frincent.jpg');?>" class="img-circle" alt="Cinque Terre" width="70%" height="30%"><br>
					<h3>Frincent</h3>
					</div>
					<div class="col-md-3" style="text-align:center;margin-top:3%;margin-bottom:3%;">
					<img src="<?php echo base_url('team/angelo.jpg');?>" class="img-circle" alt="Cinque Terre" width="70%" height="30%"><br>
					<h3>Kevin Angelo</h3>
					</div>
				</div>
			</div>
		</div>
		<script>
		$(document).ready(function(){
		  // Add smooth scrolling to all links
		  $("#smoothsc").on('click', function(event) {
			if (this.hash !== "") {
			  // Prevent default anchor click behavior
			  event.preventDefault();

			  // Store hash
			  var hash = this.hash;

			  // Using jQuery's animate() method to add smooth page scroll
			  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
			  $('html, body').animate({
				scrollTop: $(hash).offset().top
			  }, 800, function(){
		   
				// Add hash (#) to URL when done scrolling (default click behavior)
				window.location.hash = hash;
			  });
			} // End if
		  });
		});
		</script>
	</body>
</html>