<!DOCTYPE  html>
<html>
<head>
	<?php include('functions.php'); ?>
</head>
<body>
 
	<div  id="contentbox"  >
		<script  type="text/javascript">
			function  countdown()  {
				var  i  =  document.getElementById('timecount');
				if  (parseInt(i.innerHTML)<=1)  {
					location.href  =  'index.php';
				}
				i.innerHTML  =  parseInt(i.innerHTML)-1;
			}
			setInterval(function(){  countdown();  },1000);
		</script>
		<?php
			$_SESSION['user'] = getUserById($logged_in_user_id);
			$sql="DELETE  FROM  users  WHERE  username='$username'";
			$result=mysql_query($sql);
			if($result){
				echo  "<div  align='center'>";
				echo  "Account  Deleted  Sucessfully.";
				echo  "<a  href='index.php'  >Click  here</a>  to  go  back.";
				echo  "</div>";
				session_start();
			}
			elseif(!isset($loggedin_session)  ||  $loggedin_session==NULL) {
				header("Location:  index.php");
			}
			else {
				echo  "Unable  to  delete  Your  Account";
			}
		?>
		<?php //  close  connection mysql_close(); ?>
	</div>
</body>
</html>