<html>
	<div class = "commentBox">
		<img class = "itemBoxImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>">
		<form action = "post_comment.php?id=<?php echo $_GET['link']; ?>&type=<?php echo $_GET['type']; ?>" method = "post">
			<textarea class = "cBox" placeholder = "Write a comment..." name = "text"/></textarea>
			<button id = "postButton" onclick = "document.forms["pComment"].submit();"><img class = "sendImg" src = "images/sent.png"></button>
		</form>
		<script src = "js/jquery-2.1.3.min.js"></script>
		<script>
			$('.cBox').css('width', '790px');
			$('.cBox').on('keyup', function(){
				$(this).css('height','auto');
				$(this).height(this.scrollHeight - 2);
			});
		</script>
	</div>
</html>