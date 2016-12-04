<html>
<head>
<?php 
	echo "<script type='text/javascript' src='".base_url("assets/js/jquery.js")."'></script>";
?>
</head>

<body id = 'body'>

<script type="text/javascript">
	
	function senddata(jum,addr) {
		$.post(addr + "/index.php/artikel/taruhbintang",
			{ jumbintang: jum },
			function( data ) {
				alert(data);
				$("#bintang1").removeAttr("onclick");				
				$("#bintang2").removeAttr("onclick");				
				$("#bintang3").removeAttr("onclick");				
				$("#bintang4").removeAttr("onclick");				
				$("#bintang5").removeAttr("onclick");				
			}
		);	
	}
	
	function kirim(hasil,addr) {
		$.post(addr + "/index.php/ctBase/rating",
			{ result: hasil },
			function( data ) {
				alert(data);
				for(var i = 1 ; i <= 2 ;i++){
					$("#thumbs"+i).removeAttr("onclick");		
				}				
			}
		);	
	}
	function pilbintang(jumbintang,addr)
	{
		for(var i = 1 ; i<=jumbintang ;i++)
		{
			$("#bintang" + i).attr('src',addr+'/assets/img/2.png');
		}
		senddata(jumbintang,addr); 		
	}
	function rating(hasil,addr){
		
		if(hasil =='up')$("#thumbs1").css('color','green');
		else if(hasil =='down')$("#thumbs2").css('color','red');
		kirim(hasil,addr);
	}
</script>
<br>
<?php
		if($data != 0 ){
			if($data== 1){
				echo "<b style='padding-top:0px;margin-top:0px;'> Rating anda : </b>";
				echo "<div class='row' style='padding-left:10%;display:inline;' >
						<span id='thumbs1' class='glyphicon glyphicon-thumbs-up' style= 'font-size:15px; color:green;'></span>&nbsp&nbsp
						<span id='thumbs2' class='glyphicon glyphicon-thumbs-down' style= 'font-size:15px; color:000000;'></span>
					  </div>";
			}
			else{
				echo "<b style='padding-top:0px;margin-top:0px;'> Rating anda : </b>";
				echo "<div class='row' style='padding-left:10%;display:inline;' >
						<span id='thumbs1' class='glyphicon glyphicon-thumbs-up' style= 'font-size:15px; color:000000;'></span>&nbsp&nbsp
						<span id='thumbs2' class='glyphicon glyphicon-thumbs-down' style= 'font-size:15px; color:red;'></span>
					  </div>";
			}
		}
		else{
			echo "<b style='padding-top:0px;margin-top:0px;'> Rating anda : </b>";
			echo "<div class='row' style='padding-left:10%;display:inline;' >
					<span id='thumbs1' onclick=rating('up','".base_url()."') class='glyphicon glyphicon-thumbs-up' style= 'font-size:15px; color:000000;'></span>&nbsp&nbsp
					<span id='thumbs2' onclick=rating('down','".base_url()."') class='glyphicon glyphicon-thumbs-down' style= 'font-size:15px; color:000000;'></span>
				  </div>";
		}
?>
</body >
</html>