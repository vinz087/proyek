<!DOCTYPE html>
  <head>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<!-- Custom styles for this template -->
	
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	
	<?php // ini tinymce ?>

	<script src="<?php echo base_url("assets/tinymce/js/tinymce/tinymce.min.js");  ?>"></script>
	<script>tinymce.init({ selector:'textarea'});</script>
    
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery.easing.1.3.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-func.js"); ?>"></script>

    <!-- ini file upload-->
	
	<script src="<?php echo base_url("assets/fileinput/fileinput.min.js"); ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/fileinput/plugins/canvas-to-blob.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/fileinput/jquery-func.js"); ?>"></script>
	<link href="<?php echo base_url(); ?> assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?> assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?> assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?> assets/js/fileinput.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?> assets/js/fileinput_locale_fr.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?> assets/js/fileinput_locale_es.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?> assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
		$("#file-0").fileinput({
			'allowedFileExtensions' : ['jpg', 'png','gif'],
		});
	</script>
	<script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
  </head>
 <h1 align='center' style='color:#33CCCC; background-color:#000000; font-weight:"strong";'> <b>Buat Artikel </h1>
<body data-spy="scroll" data-offset="0" data-target="#navbar-main" style='background-color:#000000;'>
<div style='padding-left: 10%; padding-right: 10%;'>
	<?php
	echo "<label align='left' class='control-label' style='color:#33CCCC;  background-color:#11111;'>Select File : </label>";
		echo form_open_multipart("ctBase/create");
		$attributes = array(
        'style' => 'color: 	#33CCCC; background-color: 	#000000'
		);
		$data1 = array(
        'name'          => 'txturl',
        'maxlength'     => '5000',
        'size'          => '1000',
        'style'         => 'width:94%'
		);
		echo "<input id='file-0a' name='gambar' class='file' type='file' multiple data-show-upload='false'  multiple style=' position: absolute; opacity: 0; filter: alpha(opacity=0); '>";
		echo form_label("Url Youtube (Jika ada video masukkan url kesini | www.youtube.com/ watch?v= {<u> BBXdQPyl3Fk </u> => ini format yg di inputkan 	} ) : ","",$attributes)."</div><div style= 'padding-left:100px;'>".form_input($data1)."</div><br>";
		
	echo "</div><br>";
		echo "<div style=' float:left; padding-right:5%;'>";
		$data = array(
        'maxlength'     => '5000',
        'size'          => '100%',	
        'style'         =>  'position:absolute;'
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
		echo form_label("Kategori Artikel : ","",$attributes)."</div><div style= 'padding-left:10%;'>".form_dropdown("txtkategori",$value,$value1,$attributes)."</div><br>";
		echo form_label("Judul Artikel : ","",$attributes)."<div style= 'padding-left:10%;float:left;'>".form_input('txtjudul',$value2,$data)."</div><br>";
		echo form_textarea("txt","");
		echo "<div align='center'>";
		echo "<button name='btnsubmit' class='btn btn-info' value='Submit'>
				<span class='glyphicon glyphicon-envelope' style= 'font-size:15px; color:#ffffff;'><b> Submit</span>
			  </button>";
		echo "<button name='btncancel' class='btn btn-danger' value='Cancel'>
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
  		
