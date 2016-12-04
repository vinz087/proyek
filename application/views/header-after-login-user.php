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
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Article <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Request Article</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">List Request Article</a></li>
			  </ul>
			</li>
		  </ul>
		  <form class="navbar-form navbar-left" action="<?php echo site_url("ctBase/search");?>" method='post'>
			<div class="form-group">
			  <input type="text" data-toggle="popover" data-content="Not what you're looking for? Go to <a href='<?php echo site_url("ctBase/advanceSearch");?>'>Advanced search</a>" class="form-control popup-marker" placeholder="Search" onmouseover="pop()">
			</div>
			<button type="submit" class="btn"><span class="glyphicon glyphicon-search" style="color:black;"></span></button>
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
				<div class="btn-group">
				  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:5%">
					<?php echo $this->session->userdata("username");?>
					<span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
					<li><a href="<?php echo site_url("ctBase/profile");?>">User Profile</a></li>
					<li><a href="<?php echo site_url("ctBase/changepwd");?>">Change Password</a></li>
					<li><a href="<?php echo site_url("ctBase/create");?>">Write Article</a></li>
					<li><a href=<?php echo site_url("ctBase/logout")?>> Logout </a></li>
				  </ul>
				</div>
			</li>
		  </ul>
		</div><!-- /.navbar-collapse -->
		
	  </div><!-- /.container-fluid -->
	</nav>	
</body>

</html>