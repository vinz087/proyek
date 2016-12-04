<html>
<head>
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
</head>
<body>
<?php echo form_open('ctBase/tampilkanvideo/'.$this->session->userdata('idartikel')); ?>
<iframe width = '100%' height ='100%' src= <?php echo "'https://www.youtube.com/embed/".$url."'";  ?>   frameborder='0'  ></iframe>
	<center><button name='btnback' class='btn btn-danger' value='Submit'>
		<span class='glyphicon glyphicon-remove' style= 'font-size:15px; color:#ffffff;'><b> Back </b> </span>
	</button></center>
<?php echo form_close(); ?>
</body>
</html>