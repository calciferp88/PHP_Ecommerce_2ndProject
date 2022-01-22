<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

   if (!isset($_SESSION['staffemail']))
      {
           echo "  
             <script>
             alert('You don't have access to Admin Pages'); 
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


   
// -------- Order Delete code

if (isset($_GET['actionorder'])) 
{
  $oid = $_GET['orderid'];

  $DELETE = "DELETE FROM `order` WHERE OrderID = '$oid'";
  $run = mysqli_query($connect, $DELETE);   

      if ($run) 
      {
      echo "      
           <script>   
           alert('Order Deleted !');  
           window.location = 'EditOrder.php'
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
  <title>Culture Admins | Order </title>

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
      <li><a href="#" class="logout"><?php echo "$staffname"; ?></a></li>
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
      <li><a id='this' href='EditOrder.php'>Edit Order</a></li>

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


    <div >

      <div class='w3-container w3-center ' id='Register'>  

             <h2>Manage Order</h2><br>

      <table width="100%" style="text-align: center;" class="tbl" >

      <tr>
         <th><b>Order ID</b></th>
         <th><b><i class="fa fa-map-marker"></i>&nbsp;Address</b></th>  
         <th><b><i class="fa fa-calendar"></i>&nbsp;Order Date</b></th>
         <th><b><i class="fa fa-tasks"></i>&nbsp;Action</b></th> 
      </tr> 
 
      <?php   

       $select = "SELECT * FROM `order` where `Status` = '' ";
       $run = mysqli_query($connect, $select);
       $count = mysqli_num_rows($run);

       for ($i=0; $i < $count; $i++)  
      { 
        $row    = mysqli_fetch_array($run);
        $orid   = $row['OrderID'];  
        $add    = $row['Address'];
        $ordate = $row['OrderDate'];

        echo "   
         <tr>         
         <td>$orid</td>  
         <td>$add</td> 
         <td>$ordate</td> 
         <td>
         <a href='ManageDelivery.php?orid=$orid' class='w3-button'>Delivery </a>
         <a href='EditOrder.php?actionorder=delete&orderid=$orid' class='w3-button'> DELETE </a>
         </td>
      </tr>";
      } 
          
       ?>
      </table>




 
  










      </div> 

    </div>
        
  </div>

  <!-- // Main Content -->  
    


  </div> 
  <!-- // Admin Page Wrapper -->




  <script> 
      var coll = document.getElementsByClassName("collapsible");
      var i;

      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.display === "block") {
            content.style.display = "none";
          } else {
            content.style.display = "block";
          }
        });
      }
  </script>


  <!--------------Jquery-------------->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Ckeditor -->
    
  <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>

  <!--------------Custom Script-------------->
  <script src="scripts.js"></script>




</body>


</html>