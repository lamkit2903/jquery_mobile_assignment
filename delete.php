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
<script>
$(document).ready(function() {
	var checklogin = localStorage.getItem("lgname");
	var userid = localStorage.getItem("lgid");
	var selectedPost = <?php $checktid = $_GET['topicid'];
						if ($checktid == null) {
							echo 0;
						}
						else {
							echo $checktid;
						}
						?>;
	var selectedReply = <?php $checkrid = $_GET['replyid'];
						if ($checkrid == null) {
							echo 0;
						}
						else {
							echo $checkrid;
						}
						?>;
	
	$("#delete").click(function() {
			
				var URLs="forum.php";
				var myData;
				
				if (selectedPost != 0) {
					var topicid = selectedPost;
					myData = "topicid=" + topicid; 	
				}
				if (selectedReply != 0) {
					var replyid = selectedReply;
					myData = "replyid=" + replyid; 	
				}	
				
				$.ajax({
					url: URLs,
					data: myData,
					type:"DELETE",	
					dataType:'text',

					success: function(msg){	
						if (msg != 0 && selectedReply != 0) {
							window.location = "myreply.html";
						}
						else if (msg != 0 && selectedPost != 0) {
							window.location = "mypost.html";
						}
						else {
							
						}
						alert("Your items are deleted.");
					},

					 error:function(xhr, ajaxOptions, thrownError){
						alert(xhr.status);
						alert(thrownError);
					 }
				});
   
	});

});
       
</script>
</head> 

<body> 
	
	<div data-role="page" id="myPost" data-theme="c">
        <div data-role="header">
            <h1>Warning</h1>
        </div>

        <div data-role="content">
		<div id="selected">Are you sure want to delete the selected item?</div>
        </div>

        <div data-role="footer">
			<table data-role="table" class="ui-responsive" width="100%">
				<tr>
					<td><a href="#" data-role="button" data-rel="back">Cancel</a><button id="delete" data-icon="delete">Confirm</button></td>
				</tr>
			</table>
        </div>
    </div>
 
</body>
</html>
