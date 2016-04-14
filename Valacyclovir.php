<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8">
	<title>DrugsKnow</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="jquery.mobile.structure-1.0.1.css" />
	<link rel="stylesheet" href="jquery.mobile-1.0.1.css" />
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/jquery.mobile-1.0.1.min.js"></script>
</head> 
<body> 
<div id="choose_drug" data-role="page">
	
	<div data-role="header"> 
		<table data-role="table" class="ui-responsive" width="100%">
			<tr>
				<td><button id="hbtn" data-icon="home"><h1>home</h1></button><button id="bktn">Back</button></td>
				<td><h4>DrugsKnow</h4></td>
			</tr>
		</table>
	</div> 

	<div data-role="content">
	
	<div class="choice_list"> 
	<div align="center">
	<h1> Valacyclovir </h1>
	<img width="250px" src="images/Valacyclovir.jpg"></img>
	</div>
	<ul data-role="listview" data-inset="true" >
	<li><a href="" id="btn1"><h2>Overivew</h2></a></li>
	<div id="content1">
	<h2>Valacyclovir is an antiviral drug. It slows the </h2>
	<h2>growth and spread of the herpes virus to help the </h2>
	<h2>body fight the infection.</h2>
	<h2></h2>
	<h2>Valacyclovir is used to treat infections caused by </h2>
	<h2>herpes viruses, including genital herpes, cold </h2>
	<h2>sores, and shingles (herpes zoster) in adults.</h2>
	<h2></h2>
	<h2>Valacyclovir is used to treat cold sores in children </h2>
	<h2>who are at least 12 years old, or chickenpox in </h2>
	<h2>children who are at least 2 years old.</h2>
	</div>
	<li><a href="" id="btn2"><h2> Side Effects  </h2></a></li>
	<div id="content2">
	<ul>
		<li>Discouragement</li>
		<li>feeling sad or empty</li>
		<li>irritability</li>
		<li>lack of appetite</li>
		<li>loss of interest or pleasure</li>
		<li>tiredness</li>
		<li>trouble concentrating</li>
		<li>trouble sleeping</li>
	</ul>
	</div>
	<li><a href="" id="btn3"><h2> Dosage</h2></a></li>
	<div id="content3">
	<h2>Usual Adult Dose for:</h2>
	<ul>
		<li>Herpes Simplex Labialis</li>
		<li>Herpes Simplex - Mucocutaneous/Immunocompetent Host</li>
		<li>Herpes Simplex - Suppression</li>
		<li>Herpes Zoster</li>
		<li>Herpes Simplex - Mucocutaneous/Immunocompromised Host</li>
		<li>CMV Prophylaxis</li>
	</ul>
	<h2>Usual Pediatric Dose for:</h2>
	<ul>
		<li>Herpes Simplex Labialis</li>
		<li>Varicella-Zoster</li>
	</ul>
	<h2>Additional dosage information:</h2>
	<ul>
		<li>Renal Dose Adjustments</li>
		<li>Liver Dose Adjustments</li>
		<li>Precautions</li>
		<li>Dialysis</li>
		<li>Other Comments</li>
	</ul>
	</div>
	</ul>	
	</div>
	<?php
		include "databaseconnect.php";
		$uid = $_GET['uid'];
		$sql = "select * from favourite where list_by = '$uid';"; 
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)){
			if ($row['list_8'] == "") {
	?>
		<a href="#dialogPage" data-rel="dialog" data-transition="pop" data-role="button">Add to favourite</a>
	<?php
				break;
			}
			else {
	?>
		<a href="#RemovePage" data-rel="dialog" data-transition="pop" data-role="button">Remove from favourite</a>
	<?php
			}
		}		
	?>
	<script>
		$(document).ready(function() {
		
			var userid = localStorage.getItem("lgid");
		
			$("#content1").css("display", "none");
			$("#content2").css("display", "none");
			$("#content3").css("display", "none");
			
			$("#btn1").click(function() {
					$("#content1").toggle();
			});
			
			$("#btn2").click(function() {
					$("#content2").toggle();
			});
			
			$("#btn3").click(function() {
					$("#content3").toggle();
			});
			$("#bktn").click(function(){
				window.location = "drugs.html";
			});
			$("#hbtn").click(function(){
				window.location = "index.html";
			});
		});
	</script>
	</div>
	
	<div data-role="footer" style="text-align:center;">
	<h4></h4>
	</div>
</div><!-- /page -->

<div data-role="page" id="dialogPage">
  <div data-role="header">
    <h2>Add to Favourite?</h2>
  </div>
  <div role="main" class="ui-content" style="overflow: hidden;">
    <button id="yes">Yes</button>
	<button id="no">No thanks you</button>
	<script>
		$(document).ready(function() {
			$("#yes").click(function() {
			
				var userid = localStorage.getItem("lgid");
				
				var list = "<li><a href=\"Valacyclovir.php\" rel=\"external\" id=\"list_8\"> Valacyclovir </a></li>";
			
				var num = 8;
				
				var URLs="handlefavlist.php";			  
			
				var myData = "userid="+ userid + "&list=" + list + "&num=" + num; 
				
				$.ajax({
					url: URLs,
					data: myData,
					type:"PUT",	
					dataType:'text',

					success: function(check){
						if ( check == 1 ) {
							$( "#dialogPage" ).dialog( "close" );
						}
					},

					error:function(xhr, ajaxOptions, thrownError){
						alert(xhr.status);
						alert(thrownError);
					}
				});
			});
			
			$("#no").click(function() {
				$( "#dialogPage" ).dialog( "close" );
			});
		});
	</script>
  </div>
</div>

<div data-role="page" id="RemovePage">
  <div data-role="header">
    <h2>Remove from Favourite?</h2>
  </div>
  <div role="main" class="ui-content" style="overflow: hidden;">
    <button id="ryes">Yes</button>
	<button id="rno">No thanks you</button>
	<script>
		$(document).ready(function() {
			$("#ryes").click(function() {
			
				var userid = localStorage.getItem("lgid");
				
				var list = "";
			
				var num = 8;
				
				var URLs="handlefavlist.php";			  
			
				var myData = "userid="+ userid + "&list=" + list + "&num=" + num; 
				
				$.ajax({
					url: URLs,
					data: myData,
					type:"PUT",	
					dataType:'text',

					success: function(check){
						if ( check == 1 ) {
							$( "#RemovePage" ).dialog( "close" );
						}
					},

					error:function(xhr, ajaxOptions, thrownError){
						alert(xhr.status);
						alert(thrownError);
					}
				});
			});
			
			$("#rno").click(function() {
				$( "#RemovePage" ).dialog( "close" );
			});
		});
	</script>
  </div>
</div>
</body>
</html>