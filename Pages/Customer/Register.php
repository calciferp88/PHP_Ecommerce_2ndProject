<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

 

      // ----------------------- User register

  if (isset($_POST ['btn-register'])) 
    { 
      $name         = $_POST ['txtName'];
      $email        = $_POST ['txtEmail'];
      $phone        = $_POST ['txtPhone'];
      $address      = $_POST ['txtaddress'];  
      $password     = md5($_POST ['txtpsw']); 
      $password2    = md5($_POST ['txtpsw-com']);  

      if ($password == $password2)
      {		

	      $select = "SELECT * FROM `customer` where Email = '$email' ";

	      $runs = mysqli_query($connect, $select);

	      $count = mysqli_num_rows($runs); 

		    if ($count < 1)
			{ 	
			  	$Insert = "INSERT INTO `customer`(`CustomerName`, `Email`, `PhoneNo`, `Address`, `Password`) VALUES ('$name','$email','$phone', '$address', '$password')";

                $run = mysqli_query($connect, $Insert);  

				      if ($run) 
				      {

				           echo "  
				           <script>
				           alert('Welcome $name. Your Account Is Created !'); 
				           window.location = 'Home.php'; 
				           </script>
				           ";

				           $_SESSION['email'] = $email;
				      } 

				      else
				      { 
				        echo mysqli_error($connect);
				      }
			}

				  else
				  {

				         echo "  
					     <script>
					     alert('The Email already has an account. Please Try Another !'); 
					     window.location = 'Register.php'; 			
					     </script>
					     ";
			      }

      
      }

      else
      {	

      echo "  
           <script>
           alert('Password are not match !');
           window.location = 'Register.php'; 
           </script>
           ";
      }
  }  

      

 ?>

<!DOCTYPE html>           	
<html> 
<head>  
    <link rel="shortcut icon" href="image/logo.png">  
	<title>Culture | Register</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <style type="text/css">
    
 body
 {
 	background-color: white;
 }

 .Form-div
{
  padding-top: 100px;
}

#button   	
{
	width: 45%;
	padding: 14px 10px;
}

button[type=reset]
{
	background-color: red;
}

.form-container
{
	padding: 60px;
	background-color: white;
}

#mailrem
{
	display: none;
	color: red;
	font-size: 18px; 
}

#close:hover
{
	color: green;
}


/*-------PSW VALID------*/

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: black;
  color: white;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}


  #message p 
  {
    padding: 10px 35px;
    font-size: 18px;
  }

/* Add a green text color and a checkmark when the requirements are right */
.valid 
{
  color: lightgreen;
}

.valid:before 
{
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid 
{
  color: red;
}

.invalid:before 
{
  position: relative;
  left: -35px;
  content: "✖";
}        



    </style>

</head> 
   
<body>

	<!-- Navigation Bar -->

	        
<section id="nav-bar" >
	  <nav class="navbari navbar-expand-lg navbar-light" >


	  <button class="navbar-toggler"  onclick="openNav()" style="color: white;"> 
	  	  <a href="#" class="navbar-brand"><img src="image/logo.png" width="50px" padding="10px;"> </a>
	  <span><i class="fa fa-bars"></i></span>	
	  </button>

	  <div class="collapse navbar-collapse" id="navbarNav"> 

      <img id="top-logo" src="image/logo.png" width="50px"> 

	    <ul class="navbar-nav ml-auto w3-black" >

		      <li class="nav-item" >  
		        <a class="nav-link" href="Home.php"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME<span class="sr-only">(current)</span></a>  	
		      </li>

	    </ul>
	  </div>     
	 </nav>   
</section>

	  <div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<a href="#"><img src="image/logo.png" width="50px;"></a>
			<a href="Home.php"><i class="fa fa-home"></i>Home</a>
      </div>

<script>
	function openNav() {     
	  document.getElementById("mySidenav").style.width = "100%";  
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	}
</script>


	<!-----------------------------Register	------------------->  


<div class="form-container">
	<form action="Register.php" method="POST" class="Form-div" enctype="multipart/form-data">
		  <div class="container">

		    <h1 style="font-size: 3.5vw;">Register New Account</h1>  
		    <p style="font-size: 1.5vw;">Please fill in this form to Register An Account</p>
		    <hr>

		  <input type='text'  style="font-size: 1.2vw;" placeholder='Enter Your Name . . . ' required name='txtName'> 

	      <input type='email'  style="font-size: 1.2vw;"  placeholder='Enter Your Email . . . ' onclick="document.getElementById('mailrem').style.display='block'" required name='txtEmail'>
	      <p id="mailrem"><b>Be careful. Email cannot be updated again.</b>&nbsp; <i id="close" class="fa fa-times"></i></p>

	      <input type='text'  style="font-size: 1.2vw;" placeholder='Enter Your Phone Number . . .' required name='txtPhone'>

	      <textarea style="font-size: 1.2vw;" placeholder="Enter Your Full Address . . . " name="txtaddress" required></textarea>

	      <input  type='password'  id="psw" style="font-size: 1.2vw;"  placeholder='Enter Your Password . . . ' required name='txtpsw'>

	      <div id="message">
		    <h3>Password must contain the following:</h3>
		    <p id="letter" class="invalid">A <b class="vld">lowercase</b> letter</p>
		    <p id="capital" class="invalid">A <b class="vld">capital (uppercase)</b> letter</p>
		    <p id="number" class="invalid">A <b class="vld">number</b></p>
		    <p id="length" class="invalid">Minimum <b class="vld">8 characters</b></p>
		  </div><br>

	      <input  type='password'  style="font-size: 1.2vw;" placeholder='Comfirm Password . . .' required name='txtpsw-com'>

		   <label style="font-size: 1.2vw;">Have an account? <a href="Login.php"> Log In</a></label>
		   
		    <div class="clearfix"  style="font-size: 1.2vw;" >
		      <button type="submit"  id="button" name="btn-register" >Sign Up</button>
		      <button type="reset"   id="button" class="cancelbtn">Cancel</button>
		    </div>

		  </div> 
	</form>
</div>

<script>
  // Get the modal 
  var ptag = document.getElementById('mailrem');
  var close = document.getElementById('close');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == close) 
      {
          ptag.style.display = "none";
      }}     
</script>

<script>
  var myInput = document.getElementById("psw");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");

  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
  }

  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
  }

  // When the user starts to type something inside the password field
  myInput.onkeyup = function() 
  {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) 
    {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } 

    else 
    {
      letter.classList.remove("valid");
      letter.classList.add("invalid");  
    }
    
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } 

    else 
    {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
    
    // Validate length
    if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }
</script>



	


	<!------------ Footer --------->
<footer class="page-footer font-small mdb-color pt-4">

	  <!-- Footer Links -->
	  <div class="container text-center text-md-left">

	    <!-- Footer links -->
	    <div class="row text-center text-md-left mt-3 pb-3">

	      <!-- Grid column -->
	      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
	        <h6 class="text-uppercase mb-4 font-weight-bold" id="foot-head">CULTURE Sneaker</h6>
	        <p>CULTURE is started in 2018 and providing customers with Best sneakers in suitable price.
	        <p>To Learn more, go to </p><a href="about.php" class="this" id="foot-link">About Culture</a></p>
	      </div>
	      <!-- Grid column -->

	      <hr class="w-100 clearfix d-md-none">

	      <!-- Grid column -->
	      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
	        <h6 class="text-uppercase mb-4 font-weight-bold" id="foot-head">Services</h6>
	        <p>
	          <a href="#!" id="foot-link">Free Delivery</a>
	        </p>
	        <p>
	          <a href="#!" id="foot-link">Nice Communication</a>
	        </p>
	        <p>
	          <a href="#!" id="foot-link">Easy Purchase</a>
	        </p>
	        <p>
	          <a href="#!" id="foot-link">Right Pricing</a>
	        </p>
	      </div>
	      <!-- Grid column -->

	      <hr class="w-100 clearfix d-md-none">

	      <!-- Grid column -->
	      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
	        <h6 class="text-uppercase mb-4 font-weight-bold" id="foot-head">links</h6>
	        <p>
	          <a href="#" id="foot-link" >Home</a>
	        </p>
	        <p>
	          <a href="News.php" id="foot-link">News</a>
	        </p>
	        <p>
	          <a href="Contact.php" id="foot-link">Contact Us</a>
	        </p>
	        <p>
	          <a href="about.php" id="foot-link">About Us</a>
	        </p>

	      </div>

	      <!-- Grid column -->
	      <hr class="w-100 clearfix d-md-none">

	      <!-- Grid column -->
	      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
	        <h6 class="text-uppercase mb-4 font-weight-bold" id="foot-head">Contact</h6>
	        <p id="foot-link">
	          <i class="fa fa-home mr-3" ></i> Yangon, Myanmar</p>
	        <p id="foot-link">   
	          <i class="fa fa-envelope mr-3"></i> culturesneaker@gmail.com</p>
	        <p id="foot-link">
	          <i class="fa fa-phone mr-3"></i> +959 784698290</p>
	      </div>
	      <!-- Grid column -->

	    </div>
	    <!-- Footer links -->

	    <hr>

	    <!-- Grid row -->
	    <div class="row d-flex align-items-center">

	      <!-- Grid column -->
	      <div class="col-md-7 col-lg-8">

	        <!--Copyright-->
	        <p class="text-center text-md-left">© 2020 Copyright:
	          <a href="#">
	            <strong> culturesneaker.com</strong>
	          </a>
	        </p>   

	      </div>
	      <!-- Grid column -->

	      <!-- Grid column -->
	      <div class="col-md-5 col-lg-4 ml-lg-0">

	        <!-- Social buttons -->
	        <div class="text-center text-md-right">
	          <ul class="list-unstyled list-inline">
	            <li class="list-inline-item">
	              <a class="btn-floating btn-sm rgba-white-slight mx-1">
	                <i class="fa fa-facebook-f"></i>
	              </a>
	            </li>
	            <li class="list-inline-item">
	              <a class="btn-floating btn-sm rgba-white-slight mx-1">
	                <i class="fa fa-twitter"></i>
	              </a>
	            </li>
	            <li class="list-inline-item">
	              <a class="btn-floating btn-sm rgba-white-slight mx-1">
	                <i class="fa fa-youtube"></i>
	              </a>
	            </li>
	            <li class="list-inline-item">
	              <a class="btn-floating btn-sm rgba-white-slight mx-1">
	                <i class="fa fa-instagram"></i>
	              </a>
	            </li>
	          </ul>      
	        </div>

	      </div>
	      <!-- Grid column -->

	    </div>
	    <!-- Grid row -->

	  </div>
	  <!-- Footer Links -->

</footer>

</body>
</html>