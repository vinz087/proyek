<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SHIELD - Free Bootstrap 3 Theme">
    <meta name="author" content="Carlos Alvarez - Alvarez.is - blacktie.co">
	<link rel="shortcut icon" href="<?php echo base_url("assets/ico/favicon.png"); ?>" />
    <title> SHIELD - Free Bootstrap 3 Theme</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/main.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/icomoon.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/animate-custom.css"); ?>" />
	
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/interact.js"); ?>"></script>
	
    <script type="text/javascript" src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.easing.1.3.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-func.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/modernizr.custom.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/retina.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/smoothscroll.js"); ?>"></script>

    <!-- yang ini gimana ubah e -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
    <!-- -->
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
<body data-spy="scroll" data-offset="0" data-target="#navbar-main">
		<!-- ==== SECTION DIVIDER2 -->
		<br><br><br><br>
			<?php
				echo validation_errors();
				echo form_open("artikel/createcmd");
				echo "<div><b>Comment Here</div><br>";
				echo form_hidden("txtid",$ID_artikel);
				//echo "Kode_cmd :".form_input("txtkd")."<br>";
				echo form_textarea("txtcmd","","id='txtcmd' onkeyup='hitung()' width='60%'")."<br>";
				$attributes = array(
					'id' => 'status',
					'style' => 'color: #000; padding-right : 12%;'
				);
				echo form_label('200', 'status', $attributes);
				echo form_submit("btncmd", "Post Commend");
				echo form_close();
				$ctr =1;
				$ctrjam=1;
				if($allcmd == null ){
					
				}
				else{
					foreach($allcmd->result() as $row){
						echo "<div align = 'center'>";
						echo form_open("artikel/deletecmd");
						echo '<div align = "center" id="commend'.$ctr++.'" style="font-size:14px; width: 40%; border: 1px solid black;padding:1%; ">';
						echo '<div style="font-size:14px; float:left;">'.$row->nama_lengkap." &nbsp&nbsp @".$row->username."</div>";
						echo '<div id="jam'.$ctrjam++.'" style="font-size:14px; float:right;">'.$row->jam."</div><br>";
						echo $row->isi;
						$isicmd = $row->isi;
						$usercmd = $row->username;
						$jamcmd = $row->jam;
						
						echo "<button name='btndelete' class='btn btn-info' value='Delete' style = 'float : right;'>
			<span class='glyphicon glyphicon-trash' style= 'font-size:15px; color:#ffffff;'></span>
		  </button>";
						echo form_input("txtisi",$isicmd,"style='display:none'");
						echo form_input("txtusername",$usercmd,"style='display:none'");
						echo form_input("txtjam",$jamcmd,"style='display:none'");

						echo "</div><br>";
						echo form_close();
					
					}
				}
				echo form_input("txtctr",$ctr-1,"id=txtctr style='display:none'");
				echo "</div>";
			?>
</body>
</html>
  		
