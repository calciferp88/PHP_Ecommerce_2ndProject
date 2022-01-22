<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

   if (!isset($_SESSION['staffemail']))
      {
           echo "  
             <script>
             alert('You don't have access to Admin Pages); 
             window.location = 'StaffLogin.php'; 
             </script> 
             "; 
      }

      else
      {
        $email  = $_SESSION['staffemail'];    
          $select = "SELECT * FROM `staff` WHERE staffemail = '$email'"; 
   
          $run = mysqli_query($connect,$select);   
          $row = mysqli_fetch_array($run);    
  
          $staffname      = $row[1];  
          $staffrole      = $row[4]; 
      }


	   // ------------------   Supplier Upload

if (isset($_POST ['btn-sup-Upload'])) 

{
      $supname    = $_POST ['txtsupName'];
      $compname   = $_POST ['txtcompName'];
      $conno      = $_POST ['txtconNo'];

      $Insert = "INSERT INTO `supplier`(`SupplierName`, `CompanyName`, `ContactNo`) VALUES ('$supname', '$compname', '$conno')";

      $run = mysqli_query($connect, $Insert);   

      if ($run) 
      {
      echo "    
           <script> 
           alert('The Supplier is uploaded Successfully !');
           window.location = 'EditSupplier.php'
           </script>
           ";
      } 

      else
      { 
        echo mysqli_error($connect);  
      }}


// -------- Supplier Delete code

if (isset($_GET['actionsupplier'])) 
{
  $sid = $_GET['supplierid'];

  $DELETE = "DELETE FROM `supplier` WHERE SupplierID = '$sid'";
  $run = mysqli_query($connect, $DELETE);   

      if ($run) 
      {
      echo "      
           <script>   
           alert('Supplier Deleted Successfully !');
           window.location = 'EditSupplier.php'
           </script>
           ";
      } 

      else
      { 
        echo mysqli_error($connect);
      }
    }



?>

	
<!DOCTYPE html>
<html>
<head>
	<title>Culture Admins | Supplier</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    <link rel="stylesheet" type="text/css" href="../css/styel.css">
    <link rel="stylesheet" type="text/css" href="make.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  <style type="text/css">


  </style>
</head>

<body>

	<!-------------Navigation Bar ----------->

	<header>
    
		<div class="logo">
			<h1 class="logo-text"><span>CULTURE</span>Sneaker</h1>
		</div>
		<i class="fa fa-bars menu-toggle" onclick="openNav()"></i>
	    <ul class="nav"> 
			<li><a href="logout.php" class="logout"><?php echo "$staffname"; ?></a></li>
		</ul>

	</header>

	<!-- Admin Page Wrapper -->

	<div class="admin-wrapper">


  <!-- Left Sidebar --> 

  <div class="left-sidebar">
    <ul>  
  <?php 

    if ($staffrole == 'Manager') 
    {

     ?>
        
      <li>
        <a class="admin-tool">Admin Tools &nbsp; <i class="fa fa-angle-down"></i></a>
      </li>  
      <li><a href='EditStaff.php'>Edit Staff</a></li>
      <li><a id='this' href="EditSupplier.php">Edit Supplier</a></li>
      <li><a href='EditOrder.php'>Edit Order</a></li>

  <?php } ?>

   
    <li>
        <a class="admin-tool">General &nbsp; <i class="fa fa-angle-down"></i></a>
    </li>
        <li><a href="Purchase.php">Purchase</a></li>
        <li><a href="EditUser.php">Edit User</a></li> 
        <li><a href="EditProduct.php">Edit Product</a></li>   
        <li><a href="EditBrand.php">Edit Brand</a></li>   
        <li><a href="EditCategory.php">Edit Category</a></li>
        <li><a href="logout.php" class="logout"> &nbsp;Logout</a></li> 
    </ul>
  </div>



  <!-- // Left Sidebar -->

	<!-- Main Content -->	

	<div class="admin-content">	


		<div class="content">

		  <div class='w3-container w3-center' id='Register'>  

		   <h2>Input Supplier Information</h2>

		   <form action='EditSupplier.php' method='POST'  enctype="multipart/form-data">

      <p><input class='w3-input w3-border' type='text' placeholder='Entet Suplier Name' required name='txtsupName'></p>

      <p><input class='w3-input w3-border' type='text' placeholder='Entet Company Name' required name='txtcompName'></p>

      <p><input class='w3-input w3-border' type='text' placeholder='Entet Contact Number' required name='txtconNo'></p>
      <br><br>

      <p>
        <button class='w3-button w3-black' id='btn-reg' type='submit' name='btn-sup-Upload'>
          <i class='fa fa-paper-plane'></i>  Upload Supplier
        </button>
      </p>
    </form> <br>


<!--------------------Category Table ------>

 <table width="100%" style="text-align: center;" class="tbl" >

      <tr>
         <th><b>Supplier Name</b></th>  
         <th><b>Company</b></th>  
         <th><b>Contact</b></th>  
         <th><b>Action</b></th> 
      </tr> 
 
      <?php   

      $select = "SELECT * FROM `supplier`";  
      $run = mysqli_query($connect, $select); 
      $count = mysqli_num_rows($run);         

    for ($i=0; $i < $count; $i++)  
      { 
        $row = mysqli_fetch_array($run);
        $supid   = $row[0];  
        $supname = $row[1];
        $comp    = $row[2];  
        $con     = $row[3];

        echo "   
         <tr>         
         <td>$supname</td>  
         <td>$comp</td>   
         <td>$con</td>  
         <td>
         <a href='EditSupplier.php?actionsupplier=delete&supplierid=$supid' class='w3-button delete'> DELETE </a>
         </td>
      </tr>"; 
      } 
          
       ?> 
      </table><br><br> 

		</div> 

				</div>
				
			</div>

	<!-- // Main Content -->	
		


	</div> 
	<!-- // Admin Page Wrapper -->







	<!--------------Jquery-------------->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Ckeditor -->
    
	<script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>

	<!--------------Custom Script-------------->
	<script src="scripts.js"></script>




</body>


</html>