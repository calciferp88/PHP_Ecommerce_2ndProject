

<?php 
    session_start();
    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");


     if (isset ($_POST ['btn-profile-up']))

          {  

            $usname      = $_POST['txtusname'];
            $usemail     = $_POST['txtusemail']; 
            $usphone     = $_POST['txtusphone'];
            $Address      = $_POST['txtaddress']; 

            $update =  "UPDATE `customer` SET `CustomerName`='$usname', `Email`='$usemail', `PhoneNo`='$usphone', `Address`='$Address' WHERE Email='$usemail'";

            $run = mysqli_query($connect, $update);

            if ($run)
            {   
             echo 
             "   <script> 
                 alert('Profile Updated Successfully !');
                 window.location = 'Home.php'   
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
  <link rel="shortcut icon" href="image/logo.png"> 
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/fonts-awesome.min.css ">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/ libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <meta name="description" content="particles.js">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="style.css"> 

    <style type="text/css">

      .uploadfrm
      {
        padding-top: 100px;
      }

      table
      {
        width: 100%;
        border-collapse: collapse;
        font-size: 1.1rem;
      }

      th, td
      {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid lightgrey;
      }

    </style>
</head>
<body>


    <section id="nav-bar" >

      <nav class="navbari navbar-expand-lg navbar-light" > 

      <button class="navbar-toggler"  onclick="openNav()" style="color: white;"> 
          <a href="#" class="navbar-brand"><img src="image/logo.png" width="50px" padding="10px;"> </a>
      <span><i class="fa fa-bars"></i></span>    
      </button>
  
      <div class="collapse navbar-collapse" id="navbarNav"> 

        <a href="#" class="navbar-brand"><img src="image/logo.png" width="50px"> </a>
        <ul class="navbar-nav ml-auto w3-black"> 

            <li class="nav-item" > 
              <a class="nav-link" href="Home.php"><i class="fa fa-home"></i>&nbsp;&nbsp;Home<span class="sr-only">(current)</span></a> 
            </li>  

        </ul>
      </div>     
     </nav> 
  </section>

      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#"><img src="image/logo.png" width="50px;"></a>
        </div>

  <script>
    function openNav() {       
      document.getElementById("mySidenav").style.width = "100%";
    }  
    
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>

    <!----------- Profile ---------> 

    
   <form class="uploadfrm" action="Profile.php" method="post">

              <h2 style="text-align: center;">Update Your Information</h2>

              <?php  

           

        if (isset($_SESSION['email'])) 
 
         {     
          $email  = $_SESSION['email'];    
          $select = "SELECT * FROM `customer` WHERE Email = '$email'"; 
   
          $run = mysqli_query($connect,$select);   
          $row = mysqli_fetch_array($run);    

          $name      = $row[1];  
          $email     = $row[2];   
          $phone     = $row[3];  
          $address   = $row[4];  

          echo 
          "    
            <div class='container'>  
              <label for='uname'><b>Username</b></label>
              <input type='text' name='txtusname' value='$name' required>  
           
              <label for='uname'><b>Email</b></label>      
              <input type='text' name='txtusemail' value='$email' readonly required>
  
              <label for='uname'><b>PhoneNo</b></label>
              <input type='text' name='txtusphone' value='$phone' required>

              <label for='uname'><b>Address</b></label>
              <input type='text' name='txtaddress' value='$address' required>

              <button type='submit' name='btn-profile-up'>Update</button>

            </div>

          ";
        }   
         ?>

  </form> 


  <!---------------- Order Hsitory ----------------->
  <hr>
    <h2 style="text-align: center;">Purchase History</h2> <hr>

    <div style="overflow-x: auto;" class="w3-center">
       <table width="100%" class="tbl" >

          <tr>
             <th><b>Order ID</b></th>   
             <th><b>Order Date</b></th>   
             <th><b>Total Price</b></th>    
             <th><b>Payment Type</b></th> 
             <th><b>Action</b></th> 

          </tr> 
     

          <?php   


          $email  = $_SESSION['email'];      
          $select = "SELECT * FROM `customer` WHERE Email = '$email'"; 
          $run = mysqli_query($connect,$select);   
          $row = mysqli_fetch_array($run);    
          $id      = $row[0];  



          $select1 = "SELECT * FROM `order` WHERE CustomerID = '$id' ";   
          $run1 = mysqli_query($connect, $select1); 
          $count1 = mysqli_num_rows($run1); 

          for ($i=0; $i < $count1; $i++) 
          { 
            
            $row1   = mysqli_fetch_array($run1);
            $oid   = $row1[0]; 
            $odate = $row1[4]; 
            $total = $row1[5];   
            $payment  = $row1[6];

            echo "   
             <tr>         
             <td>$oid</td>  
             <td>$odate</td>
             <td>$ $total</td>
             <td>$payment</td>
             <td>
             <a href='Voucher.php?orderid=$oid' class='w3-black w3-button'>Show Voucher </a>
             </td>
          </tr>";   
          } 
           ?>
          </table><br><br>

    </div>



</body>
</html>