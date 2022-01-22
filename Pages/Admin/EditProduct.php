<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

  		if(!isset($_SESSION['staffemail']))
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




	// ------------------ Sneaker Upload
	 
	if (isset($_POST ['btn-Sn-Upload'])) 
	{
	  $snname = $_POST ['txtSnName']; 
	  $desc = $_POST ['txtDesc'];   
	  $buyprice = $_POST ['txtbuyprice'];
	  $sellprice = $_POST ['txtsellprice']; 
	  $cate = $_POST ['sel-cat'];   
	  $brand = $_POST ['sel-brand'];
	  $date  = $_POST ['txtqdate'];   



	  $image1 = $_FILES['txtimg']['name'];  
	  $folder = "../sneaker/";

	  if ($image1)  
	  {    
	    $filename1 = $folder."_".$image1;       
	    $copied = copy($_FILES['txtimg']['tmp_name'], $filename1);     

	    if (!$copied) 
	    {   
	    exit("Problem Occured. Cannot upload image");   
	    }       
	  }  

	 $select1 = "SELECT * FROM `category` WHERE `Category` = '$cate'";    
	 $run1 = mysqli_query($connect, $select1);   
	 $row     = mysqli_fetch_array($run1); 
	 $cateid      = $row[0];  

	 $select2 = "SELECT * FROM `brand` WHERE `BrandName` =  '$brand'";   
	 $run2 = mysqli_query($connect, $select2);     

	 $row     = mysqli_fetch_array($run2); 
	 $brandid      = $row[0];    

	$Insert = "INSERT INTO `sneaker`(`SneakerName`,`Description`, `BuyPrice`, `SellStockPrice`, `InstockQTY`, `Image`, `CategoryID`, `BrandID`) 
	           VALUES ('$snname', '$desc', '$buyprice', '$sellprice', 0, '$filename1', '$cateid', '$brandid')";

	      $run = mysqli_query($connect, $Insert);   

	      if ($run) 
	      {
	      echo "      
	           <script>   
	           alert('This Sneaker is uploaded Successfully !');
	           window.location = 'EditProduct.php'
	           </script>
	           "; 
	      } 
	      

	      else
	      { 
	        echo mysqli_error($connect);
	      }
	   } 

		// -------- Sneaker Delete code

		if (isset($_GET['actionsneaker']))   
		{
		  $sid = $_GET['snid'];

		  $DELETE = "DELETE FROM `sneaker` WHERE SneakerID = '$sid'";
		  $run = mysqli_query($connect, $DELETE);   
		  
		      if ($run) 
		      {
		      echo "      
		           <script>   
		           alert('Sneaker Deleted Successfully !');		
		           window.location = 'EditProduct.php' 
		           </script>
		           ";
		      } 

		      else
		      { 
		        echo mysqli_error($connect);
		      }
		    }?>

	
<!DOCTYPE html>
<html>
<head>
	<title>Culture Admins | Product</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
    <link rel="stylesheet" type="text/css" href="../css/styel.css">
    <link rel="stylesheet" type="text/css" href="make.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=replaceleway">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
	<style type="text/css">	
		#half
		{
			width: 50%;
			float: left;
		}
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
      <li><a href="EditSupplier.php">Edit Supplier</a></li>
      <li><a href='EditOrder.php'>Edit Order</a></li>

  <?php } ?>

   
    <li>
        <a class="admin-tool">General &nbsp; <i class="fa fa-angle-down"></i></a>
    </li>
        <li><a href="Purchase.php">Purchase</a></li>
        <li><a href="EditUser.php">Edit User</a></li> 
        <li><a id='this' 	href="EditProduct.php">Edit Product</a></li>   
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

		   <h2>Input A Sneaker</h2>

		   <form action='EditProduct.php' method='POST' id="ProductInput" enctype="multipart/form-data">
		   
		      <p><input class='w3-input w3-border' type='text' placeholder='Enter Sneaker Name' required name='txtSnName'></p>

		      <p><textarea class="w3-input w3-border" name='txtDesc' placeholder='Enter Sneaker Description' required ></textarea></p>

		      <script type="text/javascript">			
							CKEDITOR.replace( 'txtDesc' );
							$(document).ready(function(){
							$(document).on('mousemove',function(e){
							$("#cords").html("Cords: Y: "+e.clientY);
							})
							});
		      </script>

		      <input type="hidden" class="qdate" name="txtqdate" value="<?php echo date('Y-M-D');?>">

	
		   
		  <p><input class='w3-input w3-border' type='number' placeholder='Enter Buying Price' required name='txtbuyprice'></p>

          <p><input class='w3-input w3-border' type='number' placeholder='Enter Sell Stock Price' required name='txtsellprice'></p>

          	      <p><select class='w3-input w3-border' id='half' name="sel-brand"> 

		      <?php 

		       $select = "SELECT * FROM `brand`"; 
		      $run = mysqli_query($connect, $select); 
		      $COUNT = mysqli_num_rows($run);        

		      for ($i=0; $i < $COUNT; $i++) 
		    { 
		         $row     = mysqli_fetch_array($run); 
		         $id      = $row[0];
		         $name    = $row[1];

		        echo 
		        " 
		        <option>$name</option>
		        <option hidden>$id</option>
		        ";  
		      }   
		       ?>

		      </select></p>
		  
		      <p><select class='w3-input w3-border' id='half' name="sel-cat"> 

		      <?php
		      
		      $select = "SELECT * FROM `category`"; 
		      $run = mysqli_query($connect, $select);     
		      $COUNT = mysqli_num_rows($run);

		      for ($i=0; $i < $COUNT; $i++) 
		    { 
		         $row     = mysqli_fetch_array($run); 
		         $id      = $row[0];
		         $name    = $row[1]; 
		        echo 
		        " 
		        <option>$name</option>
		        <option hidden>$id</option>
		        ";
		      }
		  ?>      
		      </select></p>

		      <p><input type="File"  class="w3-input" name="txtimg" placeholder="Choose Sneaker Photo" required>
		      </p>

		      <p> 
		        <button class='w3-button w3-black' id='btn-Sn-Upload' type='submit' name='btn-Sn-Upload'>
		          <i class='fa fa-paper-plane'></i>  Upload Sneaker
		        </button>
		      </p>
		    </form> <br><br>

		<div style="overflow-x: auto;">
		   <table width="100%" class="tbl" >

		      <tr>
		         <th><b>Name</b></th>   
		         <th><b>Buy Price</b></th>   
		         <th><b>Sell Price</b></th>  
		         <th><b>Instock</b></th> 
		         <th><b>Category</b></th>  
		         <th><b>Brand</b></th>  
		         <th><b>Action</b></th> 
		      </tr> 
		 
		      <?php   

		      $select = "SELECT * FROM `sneaker`";   
		      $run = mysqli_query($connect, $select); 
		      $count = mysqli_num_rows($run); 

		      for ($i=0; $i < $count; $i++) 
		      { 
		        
		        $row = mysqli_fetch_array($run);
		        $sid = $row[0]; 
		        $sname = $row[1]; 
		        $desc = $row[2];   
		        $buyprice = $row[3];    
		        $sellprice = $row[4]; 
		        $instock = $row[5];
		        $image = $row[6];  
		        $cid = $row[7]; 
		        $bid = $row[8];  

		       $select1 = "SELECT * FROM `category` WHERE `CategoryID` = '$cid'"; 
		       $run1 = mysqli_query($connect, $select1);
		       $row     = mysqli_fetch_array($run1); 
		       $catename      = $row[1];

		       $select2 = "SELECT * FROM `brand` WHERE `BrandID` = '$bid'"; 
		       $run2 = mysqli_query($connect, $select2); 
		       $row  = mysqli_fetch_array($run2);         
		       $brandname = $row[1];        

		        echo "   
		         <tr>         
		         <td>$sname</td>  
		         <td>$buyprice</td>
		         <td>$sellprice</td>
		         <td>$instock</td>
		         <td>$catename</td>
		         <td>$brandname</td>
		         <td>
		         <a href='StaffEdit.php?sneakerid=$sid' class='w3-button'>EDIT </a>
		         <a href='EditProduct.php?actionsneaker=delete&snid=$sid' class='w3-button'> DELETE </a>
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


</body>


</html>