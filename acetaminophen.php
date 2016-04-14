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
<div id="choisir_restau" data-role="page">
	
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
	<h1> Acetaminophen </h1>
	<img width="250px" src="images/acetaminophen.jpg"></img>
	</div>
	<ul data-role="listview" data-inset="true" >
	<li><a href="" id="btn1"><h2>Overivew</h2></a></li>
	<div id="content1">
	<h2>Acetaminophen is a pain reliever and a fever reducer.</h2>
	<h2>Acetaminophen is used to treat many conditions such as headache, muscle aches, </h2>
	<h2>arthritis, backache, toothaches, colds, and fevers.</h2>
	<h2>Acetaminophen may also be used for purposes not listed in this medication guide.</h2>
	</div>
	<li><a href="" id="btn2"><h2> Side Effects  </h2></a></li>
	<div id="content2">
	<ul>
		<li>Bloody or black, tarry stools</li>
		<li>bloody or cloudy urine</li>
		<li>fever with or without chills (not present before treatment and not caused by the condition being treated)</li>
		<li>pain in the lower back and/or side (severe and/or sharp)</li>
		<li>pinpoint red spots on the skin</li>
		<li>skin rash, hives, or itching</li>
		<li>sore throat (not present before treatment and not caused by the condition being treated)</li>
		<li>sores, ulcers, or white spots on the lips or in the mouth</li>
	</ul>
	</div>
	<li><a href="" id="btn3"><h2> Patient Tips</h2></a></li>
	<div id="content3">
	<h2>How it works</h2>
	<h2></h2>
	<h3>Experts aren't sure exactly how acetaminophen works, but suspect it </h3>
	<h3>blocks a specific type of cyclo-oxygenase (COX) enzyme, located mainly in the brain.</h3>
	</div>
	</ul>	
	</div>
	<?php
		include "databaseconnect.php";
		$uid = $_GET['uid'];
		$sql = "select * from favourite where list_by = '$uid';"; 
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)){
			if ($row['list_1'] == "") {
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
				
				var list = "<li><a href=\"acetaminophen.php\"  rel=\"external\" id=\"list_1\"> Acetaminophen </a></li>";
			
				var num = 1;
				
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
			
				var num = 1;
				
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