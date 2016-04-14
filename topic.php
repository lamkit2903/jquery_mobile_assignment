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
	
	var userid = localStorage.getItem("lgid");
	
	var topicid = <?php echo $_GET['topic_id'];?>;
	
	$.getJSON('replyjson.php?topicid=' + topicid + '', function(data) {

    $.each(data, function(key, val) {
            $('#listID').append('<li><h4>' + val.reply_date + '</h4> Writer: ' + val.reply_by + ' <h3>Message: ' + val.reply_content + ' ' + '</h3></li>');
			topicid = val.reply_topic;
	});
	
	$('#listID').listview("refresh");
	
	$("#newreply").click(function(){
        $(location).attr('href',"#newReply");
    });
	
	$("#createReply").click(function() {
				
		    var URLs="reply.php";
          
		    var autor = userid;
			
			var replytopic = topicid;

			var message = $("#replyMessage").val();
		
            var myData = "userid="+ autor + "&replytopic=" + replytopic + "&message=" + message; 			
			
            $.ajax({
                url: URLs,
                data: myData,
                type:"POST",
                dataType:'text',

                success: function(msg){	
					$(location).attr('href',"#topicPage");
					location.reload();
                },

                 error:function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
                 }
            });
   
	});
});

	$("#bktn").click(function(){
        window.location = "forum.html";
    });
	$("#hbtn").click(function(){
        window.location = "index.html";
    });
});
       
</script>
</head> 

<body> 
 
    <div data-role="page" id="topicPage" data-theme="c">
        <div data-role="header">
			<table data-role="table" class="ui-responsive" width="100%">
				<tr>
					<td><button id="hbtn" data-icon="home"><h1>home</h1><button id="bktn"><h1>back</h1></button></td>
					<td><h4><?php echo $_GET['topic_sub'];?></h4></td>
				</tr>
			</table>
        </div>

        <div data-role="content">
		<ul data-role="listview" data-inset="true" id="listID">
		</ul>
        </div>

        <div data-role="footer">
            <button id="newreply">New Reply</button>
        </div>
    </div>

    <div data-role="page" id="newReply" data-role="page" data-theme="a">

        <div data-role="header">
            <h1>Creat Post</h1>
        </div>

        <div data-role="content">
        <label for="replyMessage"><strong>Reply Message:</strong></label>
        <textarea name="replyMessage" id="replyMessage"></textarea>

        <fieldset class="ui-grid-a">
            <div class="ui-block-a"><a href="#topicPage" id="goBackButton" data-role="button">Go Back</a></div>
            <div class="ui-block-b"><button data-theme="a" id="createReply" name="createReply">Confirm</input>
        </fieldset>
        </div>

        <div data-role="footer">
            <h4></h4>
        </div>
    </div>
 
</body>
</html>
