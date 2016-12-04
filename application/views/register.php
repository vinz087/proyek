<html lang="en">
<script type="text/javascript">
$(document).ready(function() {
		$('.error1').hide(); $('.error2').hide(); $('.error3').hide();
		$('.error4').hide(); $('.error5').hide(); $('.erro6').hide();
		$('.error7').hide(); $('.error8').hide(); $('.error9').hide();
		$('.error10').hide();
		$('#btnRegister').click(function(event){
			$('.error1').hide(); $('.error2').hide(); $('.error3').hide();
			$('.error4').hide(); $('.error5').hide(); $('.erro6').hide();
			$('.error7').hide(); $('.error8').hide(); $('.error9').hide();
			$('.error10').hide();
			document.getElementById("inputUsername").style.border = "none";
			document.getElementById("inputPassword").style.border = "none";
			document.getElementById("inputFN").style.border = "none";
			document.getElementById("inputLN").style.border = "none";
			document.getElementById("email").style.border = "none";
			document.getElementById("inputQ1").style.border = "none";
			document.getElementById("inputA1").style.border = "none";
			document.getElementById("inputQ2").style.border = "none";
			document.getElementById("inputA2").style.border = "none";
			   var dtVal=$('#datepicker').val();

			   if(ValidateDate(dtVal))
			   {
				  $('.error5').hide();
			   }
			   else
			   {
				 $('.error5').show();
				 event.preventDefault();
			   }
			   var inputUsername = $('#inputUsername').val();
			   var inputPassword = $('#inputPassword').val();
			   var inputFN = $('#inputFN').val();
			   var inputLN = $('#inputLN').val();
			   var email = $('#email').val();
			   var inputQ1 = $('#inputQ1').val();
			   var inputA1 = $('#inputA1').val();
			   var inputQ2 = $('#inputQ2').val();
			   var inputA2 = $('#inputA2').val();
			   if(inputUsername == "")
			   {
				   document.getElementById("inputUsername").style.border = "2px solid red"; 
				   $('.error1').show();
			   }
			   if(inputPassword == "")
			   {
				   document.getElementById("inputPassword").style.border = "2px solid red"; 
				   $('.error2').show();
			   }
			   if(inputFN == "")
			   {
				   document.getElementById("inputFN").style.border = "2px solid red"; 
				   $('.error3').show();
			   }
			   if(inputLN == "")
			   {
				   document.getElementById("inputLN").style.border = "2px solid red"; 
				   $('.error4').show();
			   }
			   if(email == "")
			   {
				   document.getElementById("email").style.border = "2px solid red"; 
				   $('.error6').show();
			   }
			   if(inputQ1 == "")
			   {
				   document.getElementById("inputQ1").style.border = "2px solid red"; 
				   $('.error7').show();
			   }
			   if(inputA1 == "")
			   {
				   document.getElementById("inputA1").style.border = "2px solid red"; 
				   $('.error8').show();
			   }if(inputQ2 == "")
			   {
				   document.getElementById("inputQ2").style.border = "2px solid red"; 
				   $('.error9').show();
			   }
			   if(inputA2 == "")
			   {
				   document.getElementById("inputA2").style.border = "2px solid red"; 
				   $('.error10').show();
			   }
		   });
	});

	function ValidateDate(dtValue)
	{
		var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
		return dtRegex.test(dtValue);
	}		  
</script>
<body style="background-color:#FAEBD7;">
<?php echo form_open('ctBase/register')?>
<div style="clear:both"></div>
<div class = 'container' style="background-color:white;width:30%;border-radius: 25px;">
	<div class='row'>
	<div class='col-md-1'></div>
	<div class='col-md-10'>
		<center><h1> Register <h1></center>
		<div class="form-group">
			<label for="inputUsername">Username</label>
				<input class="form-control" id="inputUsername" name="inputUsername" type="text">
				<span class="error1" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
			<label for="inputPassword">Password</label>
				<input class="form-control" id="inputPassword" name="inputPassword" type="text">
				<span class="error2" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
			<label for="inputFN">First Name</label>
				<input class="form-control" id="inputFN" name="inputFN" type="text">
				<span class="error3" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
			<label for="inputLN">Last Name</label>
				<input class="form-control" id="inputLN" name="inputLN"type="text">
				<span class="error4" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
			<label for="inputdefault">Gender</label><br>
			<div class="radio-inline">
			  <label><input type="radio" name="optGender" value="L" checked>Male</label>
			</div>
			<div class="radio-inline">
			  <label><input type="radio" name="optGender" value="P">Female</label>
			</div>
		</div>
		<div class="form-group">
			<label for="inputdefault">Birth Date</label><br>
			<p>Date: <input type="text" id="datepicker" name="datepicker" placeholder="DD-MM-YYYY" ></p>
			<span class="error5" Style="display:none;"> Invalid Date. Format Date : DD-MM-YYYY</span>
		<script type="text/javascript">		
		  $( function() {
				var date = $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();
			  } );
		
		</script>
		</div>
		<div class="form-group">
			<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email" name="inputEmail">
				<span class="error6" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
			<label for="inputQ1">Question 1</label>
				<input class="form-control" id="inputQ1" name="inputQ1" type="text">
				<span class="error7" Style="display:none;"> Must Required!</span>

		</div>
		<div class="form-group">
			<label for="inputA1">Answer 1</label>
				<input class="form-control" id="inputA1" name="inputA1" type="text">
				<span class="error8" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
			<label for="inputQ2">Question 2</label>
				<input class="form-control" id="inputQ2" name="inputQ2" type="text">
				<span class="error9" Style="display:none;"> Must Required!</span>
		</div>
		<div class="form-group">
		<label for="inputA2">Answer 2</label>
			<input class="form-control" id="inputA2" name="inputA2" type="text">
			<span class="error10" Style="display:none;"> Must Required!</span>
	</div>
		<input type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister" ></input>
	</div>
	<div class='col-md-1'></div>
</div>
<?php echo form_close()?>
</body>


</html>