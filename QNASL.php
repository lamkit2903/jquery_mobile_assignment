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
	<h1> QNASL </h1>
	<img width="250px" src="images/QNASL.jpeg"></img>
	</div>
	<ul data-role="listview" data-inset="true" >
	<li><a href="" id="btn1"><h2>Overivew</h2></a></li>
	<div id="content1">
	<h2>QNASL contains beclomethasone, a </h2>
	<h2>corticosteroid. It prevents the release of </h2>
	<h2>substances in the body that cause inflammation.</h2>
	<h2>QNASL Nasal Aerosol (80 mcg) is a prescription </h2>
	<h2>medicine that treats seasonal nasal and year-</h2>
	<h2>round nasal allergy symptoms in adults and </h2>
	<h2>children 12 years of age and older.</h2>
	</div>
	<li><a href="" id="btn2"><h2> Side Effects  </h2></a></li>
	<div id="content2">
	<ul>
		<li>Chills</li>
		<li>dizziness</li>
		<li>fast heartbeat</li>
		<li>lightheadedness</li>
		<li>rapid, shallow breathing</li>
		<li>rash</li>
		<li>unusual bleeding or bruising</li>
	</ul>
	</div>
	</div>
	<?php
		include "databaseconnect.php";
		$uid = $_GET['uid'];
		$sql = "select * from favourite where list_by = '$uid';"; 
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)){
			if ($row['list_7'] == "") {
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
			
			$("#btn1").click(function() {
					$("#content1").toggle();
			});
			
			$("#btn2").click(function() {
					$("#content2").toggle();
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
				
				var list = "<li><a href=\"QNASL.php\" rel=\"external\" id=\"list_7\"> QNASL </a></li>";
			
				var num = 7;
				
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
			
				var num = 7;
				
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