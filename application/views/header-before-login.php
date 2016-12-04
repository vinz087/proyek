<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/mdb.min.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery-ui.css"); ?>" />
	
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.1.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-ui.js"); ?>"></script>
  </head> 
<body>
<?php //echo base_url("assets/js/bootstrap.min.js"); ?>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
			  <a class="navbar-brand" href="<?php echo site_url("ctBase/home");?>">
				<!--<img src="<?php echo base_url("assets/img/blog.png"); ?>" width="30" height="30" class="d-inline-block align-top" alt=""> -->JEFRA
			  </a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="<?php echo site_url("ctBase/home");?>">Home<span class="sr-only">(current)</span></a></li>
			
			<li><a href="#team" id="smoothsc">Team</a></li>
			<li><a href="#">Portofolio</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="<?php echo site_url("ctBase/category/Cooking");?>">Cooking</a></li>
				<li><a href="<?php echo site_url("ctBase/category/Programming");?>">Programming</a></li>
				<li><a href="<?php echo site_url("ctBase/category/Music");?>">Music</a></li>
				<li><a href="<?php echo site_url("ctBase/category/Education");?>">Education</a></li>
				<li><a href="<?php echo site_url("ctBase/category/Miscellaneous");?>">Miscellaneous</a></li>
			  </ul>
			</li>
			
		  </ul>
		  <form class="navbar-form navbar-left" action="<?php echo site_url("ctBase/search");?>" method='post'>
			<div class="form-group">
			  <input name="txtsearch" type="text" data-toggle="popover" data-content="Not what you're looking for? Go to <a href='<?php echo site_url("ctBase/advanceSearch");?>'>Advanced search</a>" class="form-control popup-marker" placeholder="Search" onmouseover="pop()" style="color:white">
			</div>
			<button type="submit" class="btn" ><span class="glyphicon glyphicon-search" style="color:black;"></span></button>
		  </form>
			<script>
				function pop(){
					$("[data-toggle=popover]").popover({html:true})
				}
				$('html').click(function(e) {
					$('.popup-marker').popover('hide');
				});
				
				$('.popup-marker').popover({
					html: true,
					trigger: 'manual'
				}).click(function(e) {
					$(this).popover('toggle');
					e.stopPropagation();
				});
			</script>
		  <ul class="nav navbar-nav navbar-right">
			<!-- Small modal -->
			<li style="padding-top:4%;">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-sm"><span class="glyphicon glyphicon-log-in" aria-hidden="true">&nbsp </span>Log in</button>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
		
	  </div><!-- /.container-fluid -->
	</nav>	
</body>
<!-- MODAL LOGIN -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Login</h4>
	  </div>
	  <?php echo form_open("ctBase/login"); ?>
	  <div class="modal-body">
		<div class="form-group">
		
		  <label for="usr">Name:</label>
		  <input type="text" class="form-control" id="usr" name="txtusername">
		  <label for="pwd">Password:</label>
		  <input type="password" class="form-control" id="pwd" name="txtpassword">
		  <a href="<?php echo site_url("ctBase/forgetpassword_n");?>">Forget Password?</a>
		</div>
		 <div class="panel panel-info">
		  <div class="panel-heading">Not A Member? <a href="<?php echo site_url("ctBase/register");?>">Register Now</a></div>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="submit" class="btn btn-primary" name="btnlogin">Login</button>
	  </div>
	  <?php echo form_close();?>
	</div>
  </div>
</div>

</html>