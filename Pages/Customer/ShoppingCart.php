<?php 

    session_start();
    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");


 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {    
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo 
                     '
                     <script>
                     window.location="ShoppingCart.php";  
                     </script>';  
                }  
           }      
      }  


      if($_GET["action"] == "deleteall")  
      {  
          
             foreach($_SESSION["shopping_cart"] as $keys => $values)    
           {  
              
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>window.location="ShoppingCart.php"</script>';  
           }  

      }  
   
 }  
 
 ?>
 
  
 <!DOCTYPE html> 
 <html>  
 <head>
 	  <link rel="shortcut icon" href="image/logo.png">  
    <title>Culture | Shopping Cart</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css ">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/ libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/  4.3.1/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">     
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <meta name="description" content="particles.js">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="style.css"> 


 	<style type="text/css"> 

      form
      {
        background-color: white;
      } 

      table {  
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border:none; 
      }   

      td 
      {
        text-align: left;  
        padding: 16px;   
        border-bottom: 1px solid #ddd;
      }

      th 
      {   
        border-bottom: 1px solid #ddd; 
      }


      .button   
      { 
        text-decoration: none;
        color: red;  
        font-size:17px;  

      }

      .button:hover 
      {
        text-decoration: none; 
        padding-left: 5px; 
        color: red; 
        transition: 0.3s;
      }

      .Product_img
      {    
        width: 200px;  
        height: 200px; 
      } 
 
      .cf:before, .cf:after {
        content: " "; 
        display: table;
      }

      .cf:after {
        clear: both;
      }

      .cf {
        *zoom: 1;
      }

      /* TOTAL AND CHECKOUT  */
      .subtotal {
        float: right;
        width: 35%;
        margin-right: 30px;
      }
      .subtotal .totalRow {
        padding: .5em;
        text-align: right;
      }
      .subtotal .totalRow.final {
        font-size: 1.25em;
        font-weight: bold;
      }
      .subtotal .totalRow span {
        display: inline-block;
        padding: 0 0 0 1em;
        text-align: right;
      }
      .subtotal .totalRow .label {
        font-family: "Montserrat", sans-serif;
        font-size: .85em;
        text-transform: uppercase;
        color: #777;
      }
      .subtotal .totalRow .value {
        letter-spacing: -.025em;
        width: 35%;
      }

      tr:nth-child(even) {
          background-color: #f1f1f1;
        }

      ol, ul
      {
        list-style: none;
      }

      h1  
      {
        font-size: 25px;
        font-weight: bold;
        text-align: center;
      }

      a:hover
      {
        text-decoration: none;
      }

      .top-button
      {
        float: right;
      }

    input[type=text], input[type=password], input[type=email], input[type=number] , textarea, select
    { 
      width: 100%;    
      padding: 12px 20px;  
      margin: 8px 0;   
      display: inline-block;    
      border: none;  
      box-sizing: border-box; 
      background-color: #e6e6e6;   
      color: black;
      font-family: arial;
    }  
      
    input[type=text]:focus, textarea:focus 
    {
      background-color: #d9d9d9;
    }

    .modal
    {
      overflow: auto;
      height: 750px;
    }

    #rd3
    {
      margin: 10px;
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

            <li class="nav-item" > <a class="nav-link" id="this"  href="Home.php"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME<span class="sr-only">(current)</span></a> 
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



  <!---------------------- // Navigation Bar------------------->

 	 <form action="ShoppingCart.php" method="POST" style="margin-top: 70px;">

    <h1>Shopping Cart</h1>

    <div class="top-button">
      <a href="ShoppingCart.php?action=deleteall" class="w3-button w3-red w3-hover-opacity w3-margin" id="btn">Clear Cart</a>
      <a href="Home.php" class="w3-button w3-black w3-hover-opacity w3-margin" id="btn">Continue Shopping</a>
    </div>


                <div class="table-responsive">  
                     <table >  
                          <tr>  
                               <th width="20%"></th> 
                               <th width="20%"></th>  
                               <th width="10%"></th>  
                               <th width="20%"></th>    
                               <th width="11%"></th>   
                               <th width="9%"></th>  
                          </tr>  

                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))   
                          {  
                               $total = 0;  
                              
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>   
                               <td><img class="Product_img" src="<?php echo $values['item_image']; ?>"></td>

                               <td>
                                   <h1><?php echo $values["item_name"]; ?></h1>

                                  
                                </td>     
                              

                               <td><?php echo $values["item_quantity"]; ?> x</td>  
                               <td>$ <?php echo $values["item_price"]; ?></td> 
                               <td>Total : $ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a class="button" href="ShoppingCart.php?action=delete&id=<?php echo $values["item_id"]; ?>" >Remove <i class="fa fa-trash"></i></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
  
                          <?php  
                          }  

                          else 
                          {
                              echo "  
                                 <script>
                                 alert('Your Cart Is Empty !'); 
                                 window.location = 'Home.php'; 
                                 </script>
                                 "; 
                          }
                          ?>  
                     </table>   
                </div>    

  </form>


         <div class="subtotal cf">
          <ul>
            <li class="totalRow"><span class="label">Subtotal</span><span class="value">$ <?php echo number_format($total, 2); ?></span></li>
            
              <li class="totalRow"><span class="label">Delivery Fee</span><span class="value">$3.00</span></li>
              <li class="totalRow"><span class="label">Service Charges</span><span class="value">$4.00</span></li>
              <li class="totalRow final"><span class="label">Grand Total</span><span class="value">$ <?php echo number_format($total + 3 + 4, 2); ?></span></li>
            <li class="totalRow"><a href="CheckoutForm.php" class="w3-button w3-black w3-hover-black">Checkout</a></li>
          </ul>
        </div>
      </div>

   



 
 </body>


 </html>