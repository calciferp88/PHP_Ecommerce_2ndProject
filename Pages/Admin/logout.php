<?php 
	

    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");
	session_start();
	session_destroy();


	echo " 
	
	<script>

	alert('Logout');
	window.location = ('StaffLogin.php');
	</script>

	"; 
 

 ?>