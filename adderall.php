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
	<h1> Adderall </h1>
	<img width="250px" src="images/adderall.jpg"></img>
	</div>
	<ul data-role="listview" data-inset="true" >
	<li><a href="" id="btn1"><h2>Overivew</h2></a></li>
	<div id="content1">
	<h2>Adderall contains a combination of amphetamine and </h2>
	<h2>dextroamphetamine. Amphetamine and dextroamphetamine are </h2>
	<h2>central nervous system stimulants that affect chemicals in the </h2>
	<h2>brain and nerves that contribute to hyperactivity and impulse </h2>
	<h2>control.</h2>
	<h2></h2>
	<h2>Adderall is used to treat narcolepsy and attention deficit </h2>
	<h2>hyperactivity disorder (ADHD).</h2>
	</div>
	<li><a href="" id="btn2"><h2> Side Effects  </h2></a></li>
	<div id="content2">
	<ul>
		<li>Bladder pain</li>
		<li>bloody or cloudy urine</li>
		<li>difficult, burning, or painful urination</li>
		<li>fast, pounding, or irregular heartbeat or pulse</li>
		<li>frequent urge to urinate</li>
		<li>lower back or side pain</li>
		<li>Cold or flu-like symptoms</li>
		<li>cough or hoarseness</li>
		<li>fever or chills</li>
	</ul>
	</div>
	<li><a href="" id="btn3"><h2> Patient Tips</h2></a></li>
	<div id="content3">
	<h2>How it works</h2>
	<h2></h2>
	<h3>Adderall is an amphetamine-type product that </h3>
	<h3>consists of different amphetamine salts </h3>
	<h3>(dextroamphetamine saccharate and sulfate, </h3>
	<h3>amphetamine aspartate and sulfate). Experts aren't </h3>
	<h3>sure exactly how Adderall works in ADHD but think </h3>
	<h3>it affects the reuptake of dopamine and </h3>
	<h3>norepinephrine, two neurotransmitters. Adderall is </h3>
	<h3>a central nervous system (CNS) stimulant.</h3>
	</div>
	</ul>	
	</div>
	<?php
		include "databaseconnect.php";
		$uid = $_GET['uid'];
		$sql = "select * from favourite where list_by = '$uid';"; 
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)){
			if ($row['list_2'] == "") {
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
				
				var list = "<li><a href=\"adderall.php\"  rel=\"external\" id=\"list_2\"> Adderall </a></li>";
			
				var num = 2;
				
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
			
				var num = 2;
				
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