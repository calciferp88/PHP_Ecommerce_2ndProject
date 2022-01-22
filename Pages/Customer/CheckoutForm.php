<?php 

    session_start();
    include('function.php');
    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

  if(!empty($_SESSION["shopping_cart"]))   
  
  {  
      $total = 0;  
                              
      foreach($_SESSION["shopping_cart"] as $keys => $values)  
      { 
          $total = $total + ($values["item_quantity"] * $values["item_price"]);  
      }  
  }


  if (isset($_POST ['btnCheckOut'])) 

  { 
      $OrderID         =AutoID('order','OrderID','ORID_',6);  
      $cusid           = $_POST ['txtid'];
      $address         = $_POST ['txtaddress'];
      $phone           = $_POST ['txtphone'];
      $date            = date('Y-m-d');
      $payment         = $_POST ['rdopayment'];
      $cardno          = $_POST ['txtcardnumber'];
      $scode           = md5($_POST ['txtsecuritycode']);

      $Insert = "INSERT INTO `order`(`OrderID`, `CustomerID`, `Address`, `PhoneNo`, `OrderDate`, `Totalprice`, `PaymentType`, `CardNumber`, `SecurityCode`) 
                             VALUES ('$OrderID', '$cusid','$address','$phone', '$date', '$total', '$payment', '$cardno', '$scode')";


      $run = mysqli_query($connect, $Insert); 
 
        foreach($_SESSION["shopping_cart"] as $keys => $values) 
        {  

          $ProductID  = $values["item_id"]; 
          $Quantity   = $values["item_quantity"]; 

          $Insert2 = "INSERT INTO `ordersneaker` VALUES ('$OrderID', '$ProductID', '$Quantity')";


          $run2 = mysqli_query($connect, $Insert2); 

          $minus = "UPDATE `sneaker`  
                     SET `InstockQTY` = `InstockQTY`-'$Quantity' 
                     WHERE `SneakerID` = '$ProductID'  ";   
                     
          $run3 = mysqli_query($connect, $minus); 
        }  

              if ($run3) 
              {

              echo "  
                   <script>
                   alert('These items are Ordered Successfully. Please wait for our contact to deliever !'); 
                   window.location = 'Home.php'; 
                   </script>
                   ";

                    foreach($_SESSION["shopping_cart"] as $keys => $values)  
                     {  
                       unset($_SESSION["shopping_cart"][$keys]);  
                       echo '<script>window.location="Home.php"</script>';  
                     } 

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
    <title>Culture | Checkout Form</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">  
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

        .row {
          margin-top: 80px;
          padding: 20px;
           display: -ms-flexbox; /* IE10 */
          display: flex;
          -ms-flex-wrap: wrap; /* IE10 */
          flex-wrap: wrap;  
        }

        input[type=number] 
        { 
          width: 100%;  
          padding: 12px 20px;  
          margin: 8px 0;   
          display: inline-block;    
          border: 1px solid #ccc;    
          box-sizing: border-box; 
          background-color: #e6e6e6;   
        }  
  

        .col-25 {
          -ms-flex: 25%; /* IE10 */
          flex: 25%;
        }

        .col-50 {
          -ms-flex: 50%; /* IE10 */
          flex: 50%;
        }

        .col-75 {
          -ms-flex: 75%; /* IE10 */
          flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
          padding: 0 16px;
        }

        .container {
          background-color: #f2f2f2;
          padding: 5px 20px 15px 20px;
          border: 1px solid lightgrey;
          border-radius: 3px;
        }

        .icon-container {
          margin-bottom: 20px;
          padding: 7px 0;
          font-size: 24px;
        }

        .btn {
          background-color: black;
          color: white;
          padding: 12px;
          margin: 10px 0;
          border: none;
          width: 100%;
          border-radius: 3px;
          cursor: pointer;
          font-size: 17px;
        }

        .btn:hover {
          background-color: #1a1a1a;
          color: white;
        }

        hr {
          border: 1px solid lightgrey;
        }

        span.price {
          float: right;
          color: grey;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
        @media (max-width: 800px) 
        {
          .row {
            flex-direction: column-reverse;
          }
          .col-25 
          {  
            margin-bottom: 20px;
          }
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

        <a href="#" class="navbar-brand"><img src="image/logo.png" width="50px"> </a>
        <ul class="navbar-nav ml-auto w3-black"> 

            <li class="nav-item" > <a class="nav-link" href="Home.php"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME<span class="sr-only">(current)</span></a> 
            </li>  
        </ul>
      </div>     
     </nav>  
  </section>

  <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>  
        <a href="#"><img src="image/logo.png" width="50px;"></a>    
        <a href="Home.php"><i class="fa fa-home"></i>Home</a> 
         <script>
        function openNav() {       
          document.getElementById("mySidenav").style.width = "100%"; 
        }  
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
        }           
        x   
      </script>
  </div>

  <!---------------------- // Navigation Bar------------------->



  <!---------------------- Form  ------------------------------>

  <?php 

  if (isset($_SESSION['email'])) 
 
         {     
          $email  = $_SESSION['email'];    
          $select = "SELECT * FROM `customer` WHERE Email = '$email'"; 
   
          $run = mysqli_query($connect,$select);   
          $row = mysqli_fetch_array($run);    

          $id        = $row[0]; 
          $name      = $row[1];  
          $email     = $row[2];   
          $phone     = $row[3];  
          $address   = $row[4];  
        }
   ?>


<div class="row">


  <div class="col-75">
    <div class="container w3-white">
        <h1><b>CheckOut Form </b></h1>
      <form action="CheckoutForm.php" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="hidden" name="txtid" value="<?php echo($id) ?>">
            <input type="text" id="fname" name="txtName" placeholder="Enter Your Name . . ." value="<?php echo($name) ?>" required>

            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="txtemail" placeholder="Enter Your Email . . ." value="<?php echo($email) ?>" required>

            <label for="city"><i class="fa fa-phone"></i> Phone</label>
            <input type="text" id="city" name="txtphone" placeholder="Enter Your Phone Number . . ." value="<?php echo($phone) ?>" required>

            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="txtaddress" placeholder="Enter Your Address . . ." value="<?php echo($address) ?>" required>

            <label for="adr"><i class="fa fa-lock"></i> Security Code</label>
            <input type="number" id="adr" name="txtsecuritycode" placeholder="Enter Your Security Code . . ." required>


          </div>
   
          <div class="col-50">
            <h3>Payment</h3>

            <label style="font-size: 20px;">
               <input type='radio' name='rdopayment' value='Visa' required>&nbsp;<i class="fa fa-cc-visa" style="color:navy;"> Visa</i>
            </label>

            <label style="margin-left: 10px; font-size: 20px;">
               <input type='radio' name='rdopayment' value='Amex' required>&nbsp;<i class="fa fa-cc-amex" style="color:blue;"> Amex</i>
            </label>

            <label style="margin-left: 10px; font-size: 20px;">
               <input type='radio' name='rdopayment' value='Discover' required>&nbsp;<i class="fa fa-cc-discover" style="color:orange;"> Discover</i>
            </label><br><br><br>  


            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="txtcardnumber" placeholder="example : 1111-2222-3333-4444" required>

    
          </div>
          
        </div>

        
        <input type="submit" name="btnCheckOut" value="Continue to checkout" class="btn">
      </form> 
    </div>
  </div>
    <?php 
        if(!empty($_SESSION["shopping_cart"]))  
         {  
              $total = 0;  
              $itemcount = 0;
              foreach($_SESSION["shopping_cart"] as $keys => $values)  
              {  
               $itemcount = $itemcount + 1;
            }

          }
    ?>

  <div class="col-25">
    <div class="container w3-white">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo "$itemcount"; ?></b></span></h4>

             <?php   
                if(!empty($_SESSION["shopping_cart"]))   
                {  
                      $total = 0;  
                      foreach($_SESSION["shopping_cart"] as $keys => $values)  
                     {  
                        $total = $total + ($values["item_quantity"] * $values["item_price"]); 
                 ?>  
      <p><a href="#"><?php echo $values["item_name"]; ?></a> <span class="price">$ <?php echo $values["item_price"]; ?></span>  </p>

      <?php } }   ?>

      <p><a href="#">DELIVERY FEE</a> <span class="price">$ 3.00</span>  </p>

      <hr>
      <p>Total <span class="price" style="color:black"><b>$ <?php echo number_format($total + 3 + 4, 2); ?> </b></span></p>

      <input type="hidden" name="txtTotalamt" value="<?php echo number_format($total + 3 + 4, 2); ?>" >

     <a href="ShoppingCart.php" class="w3-black w3-button"><i class="fa fa-chevron-left"></i> Back to Cart</a>

    </div>
  </div>
</div>

 
 </body>


 </html>