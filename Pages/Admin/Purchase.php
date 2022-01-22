<?php 

    session_start();
    include('function.php');
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


  // Add Process -------------------------------------------------------

     if(isset($_POST["add-to-sec"]))  
     {
        if(isset($_SESSION["purchase_cart"])) 
        {  
            $sn_array_id = array_column($_SESSION["purchase_cart"], "sn_id");  

            if(!in_array($_GET["snid"], $sn_array_id))  
            {  
                $count = count($_SESSION["purchase_cart"]);  
                $sn_array = array(  
                     'sn_id'               =>     $_GET["snid"],  
                     'sn_name'             =>     $_POST["hidden_name"],    
                     'sn_price'            =>     $_POST["hidden_price"], 
                     'sn_quantity'         =>     $_POST["txtqty"] 
                );  

                $_SESSION["purchase_cart"][$count] = $sn_array;  

            }  

            else  
            {  
                echo '<script>alert("Item Already Added")</script>'; 
                echo '<script>window.location="Purchase.php"</script>';  
            }  

        }  

        else  
        {  
           $sn_array = array(  
            'sn_id'               =>     $_GET["snid"],  
            'sn_name'             =>     $_POST["hidden_name"],    
            'sn_price'            =>     $_POST["hidden_price"], 
            'sn_quantity'       =>       $_POST["txtqty"]   
           );  

           $_SESSION["purchase_cart"][0] = $sn_array;  
         }    
     }

      if(isset($_GET["action"]))  
       {  
            if($_GET["action"] == "delete")  
            {  
                 foreach($_SESSION["purchase_cart"] as $keys => $values)  
                 {  
                      if($values["sn_id"] == $_GET["id"])  
                      {  
                           unset($_SESSION["purchase_cart"][$keys]);  
                           echo 
                           '
                           <script>
                           window.location="Purchase.php";  
                           </script>';  
                      }  
                 }      
            }  
       } 

   // ---------------- Purchase Processs
         
       if (isset($_POST ['btn-putchase']))  
    {

       if (isset($_SESSION['staffemail']))
         {
            $email  = $_SESSION['staffemail'];    
            $select = "SELECT * FROM `staff` WHERE staffemail = '$email'"; 
     
            $run = mysqli_query($connect,$select);   
            $row = mysqli_fetch_array($run);     
    
            $staffid      = $row[0];  
        }

        $total = 0;  
                                
        foreach($_SESSION["purchase_cart"] as $keys => $values)  
        {  
          $total = $total + ($values["sn_quantity"] * $values["sn_price"]); 
        }

        $PurchaseID     = AutoID('purchase', 'PurchaseID', 'PurID_', 6);  
        $date           = date('Y-m-d');    
        $supl           = $_POST ['sel-cat'];   

        $select1 = "SELECT * FROM `supplier` WHERE `SupplierName` = '$supl'";    
        $run1 = mysqli_query($connect, $select1); 
        $row     = mysqli_fetch_array($run1); 
        $splID      = $row[0];  


        $Insert = "INSERT INTO `purchase`(`PurchaseID`, `PurchaseDate`, `TotalPrice`, `StaffID`, `SupplierID`) 
                   VALUES ('$PurchaseID', '$date', '$total', '$staffid',  '$splID')";

        $run = mysqli_query($connect, $Insert); 


         foreach($_SESSION["purchase_cart"] as $keys => $values) 
        {

          $snID        = $values["sn_id"]; 
          $Quantity    = $values["sn_quantity"]; 
          $totalprice  = $values["sn_quantity"] * $values["sn_price"];

          $Insert2 = "INSERT INTO `purchasesneaker` VALUES ('$PurchaseID', '$snID', '$Quantity', '$totalprice')";
          $run2 = mysqli_query($connect, $Insert2); 


          $Update = "UPDATE `sneaker`  
                     SET `InstockQTY` = `InstockQTY`+'$Quantity' 
                     WHERE `SneakerID` = '$snID'  ";   
          


          $run3 = mysqli_query($connect, $Update); 
        } 

          if ($run3) 
          {

          foreach($_SESSION["purchase_cart"] as $keys => $values)  
            {  
              unset($_SESSION["purchase_cart"][$keys]);
            } 

          echo "      
               <script>   
               alert('Successfully Purchase These Items !');   
               window.location = 'Purchase.php' 
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
  <title>Culture Admins | Purchase    </title>

  <meta charset="UTF-8">
  <meta name="viewport"  content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">
  <link rel="stylesheet" type="text/css" href="../css/styel.css">
  <link rel="stylesheet" type="text/css" href="make.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

  <style type="text/css">'


    input[type=text] 
      {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
      }

      label 
      {
        margin-bottom: 10px;
        display: block;
        text-align: left;
      }

      .column {
        float: left;
        width: 25%;
        padding: 0 10px;
      }

      .row {margin: 0 -5px;}

      .row:after {
        content: "";
        display: table;
        clear: both;
      }

      @media screen and (max-width: 600px) {
        .column {
          width: 100%;
          display: block;
          margin-bottom: 20px;
        }
      }

      .card {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        text-align: center;
        background-color: #f1f1f1;
      }

       .card:hover {
        box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2);
        transition: 0.5s;
      }

      th
      {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
      }

      tr:nth-child(odd) {
       background-color: rgba(0, 0, 0, 0.1);
      }

      #purchase
      {
        float: right;
        background-color: black; 
        border: none; color: white; 
        padding:10px;
      }

      #purchase:hover
      {
        box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2);
        transition: 0.5s;
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
      <li>      </li>
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
        <li><a id='this' href="Purchase.php">Purchase</a></li>
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

       <h2>Sneaker Purchase Form</h2>

           <div class="row">

          <?php 

              $select = "SELECT * FROM `sneaker`"; 
              $run = mysqli_query($connect, $select); 
              $COUNT = mysqli_num_rows($run);     
   
              for ($i=0; $i < $COUNT; $i++) 
              { 
                 $row     = mysqli_fetch_array($run); 
                 $id      = $row[0];                  
                 $name    = $row[1]; 
                 $price    = $row['BuyPrice'];         
                 $instock  = $row['InstockQTY'];   

                $sn_array_id = array_column($_SESSION["purchase_cart"], "sn_id");  

                if(!in_array($id, $sn_array_id))  
              {

           ?>

          <form action='Purchase.php?action=add&snid=<?php echo $id; ?>' method='POST' id="ProductInput" enctype="multipart/form-data"> 
            <div class="column">
              <div class="card">
                <h4><?php echo "$name"; ?></h4>   

                <p>Instock : <?php echo "$instock"; ?></p>

                <p>Price : <?php echo "$ $price"; ?></p>

                <p><input type="number" name="txtqty" placeholder="Enter Quantity . . . " required></p>
                <input type="hidden" name="txtdate" value="<?php echo date('Y-M-D');?>">
                <input type="hidden" name="hidden_name" value="<?php echo($name);?>">
                <input type="hidden" name="hidden_price" value="<?php echo($price);?>">

                <button class='w3-button w3-black' type='submit' name='add-to-sec'>
                  <i class='fa fa-paper-plane'></i> Add 
                </button>

              </div>
            </div>
          </form>

          <?php } }?>
        </div><br><hr>


        <!-- Display -->

    <?php 
      if(!empty($_SESSION["purchase_cart"]))   
          {  
                $count = 0;  
                              
                foreach($_SESSION["purchase_cart"] as $keys => $values)  
                {  

                  $count = $count + 1;
                }

                if ($count>0) {


       
     ?>


       <h2>Item To be Purchased</h2> 
      <hr>
  
      <div style="overflow-x: auto;">
        <table width="100%" class="tbl" >

          <tr>
             <th><b>Name</b></th>   
             <th><b>Price</b></th>   
             <th><b>Quantity</b></th> 
             <th><b>Total</b></th>  
             <th><b>Action</b></th> 
          </tr> 

          <?php   
          if(!empty($_SESSION["purchase_cart"]))   
          {  
                $total = 0;  
                              
                foreach($_SESSION["purchase_cart"] as $keys => $values)  
                {  
          ?>  

          <tr>
            <td><?php echo $values["sn_name"]; ?></td>
            <td><?php echo $values["sn_price"]; ?></td>
            <td><?php echo $values["sn_quantity"]; ?></td>
            <td> $ <?php echo number_format($values["sn_quantity"] * $values["sn_price"], 2); ?></td>
            <td><a class="button" href="Purchase.php?action=delete&id=<?php echo $values["sn_id"]; ?>" >Remove <i class="fa fa-trash"></i></a></td>
          </tr>
 
        <?php   $total = $total + ($values["sn_quantity"] * $values["sn_price"]);   }?>

   
        
          <tr>
            <td></td>
            <td></td>
            <td>SubTotal</td>
            <td>$ <?php echo "$total"; ?></td>
            <td></td>
          </tr>
        
        </table>

        <form action="Purchase.php" method='POST' enctype="multipart/form-data"> 

          <br><label style="width: 30%; float: right; font-weight: bold;">Choose Supplier</label><br>

          <p><select class='w3-input w3-border' name="sel-cat" style="width: 30%; float: right; background-color: rgba(0,0,0,0.1);"> 

            <?php
            
            $select = "SELECT * FROM `supplier`"; 
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
            </select></p><br>

          <br><input type="submit" id="purchase" name="btn-putchase" value="Purchase Now !"> 

        </form>

      </div><br><hr>
    <?php }  
                } }

     ?>

    <!------------ Display Form  -------------->

    <h3>Purchase History</h3>

       <table  width="100%" style="text-align: center;" class="tbl">

          <tr>
             <th><b>Purchase ID</b></th>   
             <th><b>Purchase Date</b></th>   
             <th><b>Total Price</b></th>  
             <th><b>Supplier</b></th> 
             <th><b>Action</b></th> 

          </tr> 
     
          <?php   

          $select = "SELECT * FROM `purchase`";   
          $run = mysqli_query($connect, $select); 
          $count = mysqli_num_rows($run); 

          for ($i=0; $i < $count; $i++) 
          { 
            
            $row = mysqli_fetch_array($run);
            $pid   = $row[0]; 
            $pdate = $row[1]; 
            $total = $row[2];   
            $sid   = $row[4];

           $select1 = "SELECT * FROM `supplier` WHERE `SupplierID` = '$sid'"; 
           $run1 = mysqli_query($connect, $select1);
           $row     = mysqli_fetch_array($run1); 
           $supname      = $row[1]; 

            echo "   
             <tr>         
             <td>$pid</td>  
             <td>$pdate</td>
             <td>$total</td>
             <td>$supname</td>
             <td>
             <a href='StaffEdit.php?purchaseid=$pid' class='w3-black w3-button'>Show Invoice </a>
             </td>
          </tr>";   
          } 
           ?>
          </table><br><br>


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