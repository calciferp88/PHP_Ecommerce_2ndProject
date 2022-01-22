<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");
  include('function.php');

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

      if (!isset($_GET['orid']))
    {   
       echo "  
             <script>
             alert('Please Choose an Order'); 
             window.location = 'EditOrder.php'; 
             </script> 
             "; 
    }


  // ------------------ Delivery Upload
   
    if (isset($_POST['btn-delivery-con'])) 
    { 

    $DeliID     = AutoID('delivery', 'DeliveryID', 'DeliID_', 6);  
    $orid       = $_POST ['txt_deli_oid']; 
    $staffid    = $_POST ['sel_deli_staff']; 
    $date       = $_POST ['txt_deli_date']; 

    $Insert = "INSERT INTO `delivery` VALUES ('$DeliID', '$orid', '$staffid', '$date')"; 

    $run = mysqli_query($connect, $Insert);   

    $Update = "UPDATE `order`  
               SET status = 'Delivered' 
               WHERE OrderID = '$orid'";  

    $run2 = mysqli_query($connect, $Update);   

        if ($run2) 
        {
        echo "      
             <script>   
             alert('Delivery for $orid is Assigned !');
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
  <title>Culture Admins | Delivery </title>

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

    .info-div
    {
      background-color: #a8ced7;
      padding: 30px;
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


 

  <!-- Main Content --> 

  <div class="admin-content"> 


    <div >

      <div class='w3-container' id='Register'>  

      <h2 style="text-align: center;">Manage Delivery</h2><br>  

      <?php 
      if (isset($_GET['orid']))
     {
      $oid = $_GET['orid'];  
      $select = "SELECT * FROM `order` WHERE OrderID = '$oid' ";
      $run = mysqli_query($connect, $select);
      $row = mysqli_fetch_array($run);   
      $Add  = $row[2]; 
      $date = $row[4]; 
     }

       ?>
      <form action="" method="POST">

          <div class="info-div">
            <p><?php echo "OrderID    : $oid"; ?></p>
            <p><?php echo "Address    : $Add"; ?></p>
            <p><?php echo "Order Date : $date"; ?></p> 
          </div>

            <input type="hidden" name="txt_deli_oid" class="w3-input w3-border" value="<?php echo($oid) ?>">

            <p><b>Choose Delivery Staff</b></p>
            <p>
              <select  class='w3-input w3-border' id='half' name="sel_deli_staff">
                <?php
          
                    $select = "SELECT * FROM `staff` WHERE `role` = 'Delivery Staff' "; 
                    $run = mysqli_query($connect, $select);     
                    $COUNT = mysqli_num_rows($run);

                    for ($i=0; $i < $COUNT; $i++) 
                   { 
                       $row     = mysqli_fetch_array($run); 
                       $id      = $row[0];
                       $name    = $row[1]; 
                      echo 
                      " 
                      <option value='$id'>$name</option> 
                      ";
                    }
                ?>      
              </select>
            </p>

            <div>
                <?php 

                 ?>

            </div>

            <p><b>Choose Date to deliver</b></p>
            <p>
              <input type="DATE" name="txt_deli_date" class="w3-input w3-border" required>
            </p>

          <p> 
            <button class='w3-button w3-black' id='btn-Sn-Upload' type='submit' name='btn-delivery-con'>
              <i class='fa fa-paper-plane'></i>  Confirm Delivery
            </button>
          </p>    

      </form>

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