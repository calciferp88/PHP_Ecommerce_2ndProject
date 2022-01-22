       

<?php 
    session_start();
    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="image/logo.png"> 
  <title>Culture | Voucher</title>
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

    .btn-print
   {
    border: none;
    background-color: black;
    color: white;
    padding:13px 25px;
   }

    th
    {
      background-color: rgba(0,0,0,0.3);
    }

     .invoice  
     { 	
      padding: 30px;
      background-color: white;  
      width: 50%;         
      text-align: center;
      margin: 100px auto;

     }

     .pinfo
     {
      text-align: left;
     }

     .inv-image
     {
        border-radius: 10%;             
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

    <!----------- Voucher Section ---------> 

 <?php 

    if (isset($_GET['orderid']))
    {

      $oid = $_GET['orderid'];  
      $select = "SELECT * FROM `order` WHERE OrderID = '$oid' ";
      $run = mysqli_query($connect, $select);
      $row = mysqli_fetch_array($run);

      $odate       = $row['OrderDate'];
      $grandtotal  = $row['TotalPrice'];
      $customerid  = $row['CustomerID'];
      $payment  = $row['PaymentType'];    
   
      $select1 = "SELECT * FROM `customer` WHERE CustomerID = '$customerid' ";
      $run1 = mysqli_query($connect, $select1);
      $row1 = mysqli_fetch_array($run1);

      $cusname       = $row1['CustomerName'];

   ?>

   <div class="invoice"> 

     
      <img width="10%;" class="inv-image" src="image/logo.png">

      <h1>Culture Sneaker Shop</h1>
      <hr>

      <div class="pinfo">
      <h6><b>Date         : </b><?php echo "$odate"; ?></h6>
      <h6><b>Total        : </b><?php echo "$ $grandtotal"; ?></h6>
      <h6><b>By           : </b><?php echo "$cusname"; ?></h6>
      <h6><b>Payment Type : </b><?php echo "$payment"; ?></h6>  
      
      </div><hr>

    <div style="overflow-x: auto;">
       <table width="100%" class="tbl" >

          <tr>
             <th><b>Item</b></th>   
             <th><b>Price</b></th>   
             <th><b>Quantity</b></th>  
             <th><b>Total</b></th> 
          </tr> 

      <?php 

      $select3 = "SELECT * FROM `ordersneaker` WHERE OrderID = '$oid' ";
      $run3 = mysqli_query($connect, $select3);
      $count = mysqli_num_rows($run3); 

          for ($i=0; $i < $count; $i++) 
          { 

            $row3   = mysqli_fetch_array($run3);
            $snid   = $row3['SneakerID'];
            $qty    = $row3['Quantity'];

      $select4   = "SELECT * FROM `sneaker` WHERE SneakerID = '$snid' ";
      $run4  = mysqli_query($connect, $select4);
      $row4  = mysqli_fetch_array($run4);

      $snname       = $row4['SneakerName'];
      $price        = $row4['SellStockPrice'];
      $total        = $price*$qty;

      echo "  

          <tr>         
             <td>$snname</td>  
             <td>$ $price</td>
             <td>$qty</td>
             <td>$ $total</td>
          </tr>";

     
            }

            echo "<tr>         
                   <td></td>  
                   <td></td>
                   <td><b>Grandtotal<b></td>
                   <td><b>$ $grandtotal</b></td>
                 </tr>";
          } 

           ?>
          </table><br><br>


          <button class="btn-print"  onclick="window.print()"><i class="fa fa-print"></i>Print</button>

    </div>

   </div>

</body>
</html>