<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

    // ------------Login  

     if (isset ($_POST ['btnLogin']))

    { 
      $email= $_POST['txtEmail-log'];
      $pass = md5($_POST['txtpsw-log']);  

      $select =  "SELECT * FROM staff WHERE staffemail ='$email' AND password = '$pass' ";

      $run = mysqli_query($connect, $select);

      $count = mysqli_num_rows($run);

	  if ($count != 0)
      {
      $_SESSION['staffemail'] = $email; 
       echo "     
           <script>        	
           alert('Logged In Successfully !');
           window.location = 'EditProduct.php';	
           </script>  
           ";
      }    

      else
      {

      echo "  

          <script>
           
          alert('Try Again');

          </script>
 
          ";
      }
    }   


?>

	
<!DOCTYPE html>
<html>
<head>
	<title>Culture Admins | Login</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    <link rel="stylesheet" type="text/css" href="../css/styel.css">
    <link rel="stylesheet" type="text/css" href="make.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<body>

	<!-------------Navigation Bar ----------->  

	<header>
    
		<div class="logo">
			<h1 class="logo-text"><span>CULTURE</span>Sneaker</h1>
		</div>
		<i class="fa fa-bars menu-toggle" onclick="openNav()"></i>
		<ul class="nav"> 
			<li><a href="#" class="logout">Log In to Your Staff Account</a></li>
		</ul>


	</header>

	<!-- Admin Page Wrapper -->

	<div class="admin-wrapper">
		
	<!-- // Left Sidebar -->

	<!-- Main Content -->	

	<div class="admin-content">	


		<div class="content">

		  <div class='w3-container w3-center' id='Register'>  

		   <h2>Log In to Your Staff Account</h2>
        
		   <form action='StaffLogin.php' method='POST' id="ProductInput" enctype="multipart/form-data">
		   
		      <p><input class='text-input' type='text' placeholder='Enter Email . . .' required name='txtEmail-log'></p>

		      <p><input class='text-input' type='password' placeholder='Enter Password . . .' required name='txtpsw-log'></p><br>

		      <p> 
		        <button class='w3-button w3-black' id='btn-Sn-Upload' type='submit' name='btnLogin'>
		          <i class='fa fa-paper-plane'></i>  Log In  	
		        </button>
		      </p>

		    </form> <br><br>

					

				</div>
				
			</div>

	<!-- // Main Content -->	
		


	</div> 







</body>


</html>