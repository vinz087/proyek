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
	
	<?php // ini tinymce ?>
	
	<script src="<?php echo base_url("assets/tinymce/js/tinymce/tinymce.min.js");  ?>"></script>
	<script>tinymce.init({ selector:'textarea'});</script>
    
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
    <!-- ini file upload-->
	
	<script src="<?php echo base_url("assets/fileinput/fileinput.min.js"); ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/fileinput/plugins/canvas-to-blob.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/fileinput/jquery-func.js"); ?>"></script>
	
	<script>
$(document).on('ready', function() {
    $("#input-20").fileinput({
		showUpload: false,
        layoutTemplates: {
            main1: "{preview}\n" +
            "<div class=\'input-group {class}\'>\n" +
            "   <div class=\'input-group-btn\'>\n" +
            "       {browse}\n" +
            "       {upload}\n" +
            "       {remove}\n" +
            "   </div>\n" +
            "   {caption}\n" +
            "</div>"
        },
		allowedFileExtensions: ["png", "jpg", "ini", "text"],
		elErrorContainer: "#errorBlock",
    });
});
</script>

	
	<script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      
    <![endif]-->
  </head>
  <?php
	if($this->session->userdata("username")){
			if($this->session->userdata("username") == "admin"){
				$this->load->view('header-after-login-admin');
			}
			else if($this->session->userdata("username") != "admin"){
				$this->load->view('header-after-login-user');
			}
		}
		else{
			$this->load->view('header-before-login');
		}
  ?>
 <h1 align='center' style='color:#33CCCC; background-color:#000000; font-weight:"strong";'> <b>Create Post </h1>
<body data-spy="scroll" data-offset="0" data-target="#navbar-main" style='background-color:#000000;'>
<div style='padding-left: 10%; padding-right: 10%;'>
	<?php
		
	echo "<label align='left' class='control-label' style='color:#33CCCC;  background-color:#000000;'>Select File : </label>";
	echo "<div style='padding-left: 5%; padding-right: 5%; '>";
	// 1mb =1024
/*        previewFileType: "image",
        browseClass: "btn btn-success",
        browseLabel: "Pick Image",
        browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
        removeClass: "btn btn-danger",
        removeLabel: "Delete",
        removeIcon: "<i class=\"glyphicon glyphicon-trash\"></i> ",
		maxFileSize :1024,
		allowedFileExtensions: ["png", "jpg", "ini", "text"],
		maxFileCount: 10*/
		echo form_open("Welcome/index");

		$attributes = array(
        'style' => 'color: 	#33CCCC; background-color: 	#000000'
		);
		$data1 = array(
        'name'          => 'txturl',
        'maxlength'     => '5000',
        'size'          => '1000',
        'style'         => 'width:94%'
		);
		echo "<input align='center' id='input-20' name='gambar' type='file' class='file-loading' multiple data-show-upload='false' style=' position: absolute; opacity: 0; filter: alpha(opacity=0); '>";
		echo "<div id='errorBlock' class='help-block'></div>";
		
		echo form_label("Url (Jika ada video masukkan url kesini) : ","",$attributes)."</div><div style= 'padding-left:100px;'>".form_input($data1)."</div><br>";
		
	echo "</div><br>";
		echo "<div style=' float:left; padding-right:5%;'>";
		$data = array(
        'maxlength'     => '5000',
        'size'          => '1000',
        'style'         =>  'width:80%;position:absolute;left:10%;top:52%;'
		);
		$value = array(
			'K01' => 'Programing',
			'K02' => 'Cooking',
			'K03' => 'Music',
			'K04' => 'Education',
			'K05' => 'Miscellaneous'
		);
		$value1 = "1";$value2 = "";
		if($this->session->userdata("keCoba4untuknulisRequest"))
		{
			foreach($this->session->userdata("keCoba4untuknulisRequest")->result() as $tulis)
			{
				$value1 = $tulis->jenisrequest;
				$value2 = $tulis->judul_artikel;
				//echo form_input($value1,$value1)." ".form_input($value2,$value2);
			}
		}
		echo form_label("Kategori Artikel : ","",$attributes)."</div><div style= 'padding-left:100px;'>".form_dropdown("txtkategori",$value,$value1,$attributes)."</div><br>";
		echo form_label("Judul Artikel : ","",$attributes)."</div><div style= 'padding-left:100px;'>".form_input('txtjudul',$value2,$data)."</div><br>";
		echo form_textarea("txt","");
		echo "<div align='center'>";
		echo "<button name='btnsubmit' class='btn btn-info' value='Submit'>
				<span class='glyphicon glyphicon-envelope' style= 'font-size:15px; color:#ffffff;'><b> Submit</span>
			  </button>";
		echo "<button name='btnsubmit' class='btn btn-danger' value='Submit'>
				<span class='glyphicon glyphicon-remove' style= 'font-size:15px; color:#ffffff;'><b> Cancel </span>
			  </button>";
		echo "</div>";
		echo form_close();
	?>
</div>
	<br>
	<br>
	<br>
</body>
</html>
  		
