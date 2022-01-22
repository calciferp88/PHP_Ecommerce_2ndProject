      <?php 

    session_start();
    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");
    

     if(isset($_POST["add_to_cart"]))  
 {  

          if (isset($_SESSION['email'])) 
        {

             if(isset($_SESSION["shopping_cart"]))  
            {  
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  

            if(!in_array($_GET["id"], $item_array_id))  
            {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'             =>     $_GET["id"],  
                     'item_name'           =>     $_POST["hidden_name"],    
                     'item_price'          =>     $_POST["hidden_price"], 
                     'item_image'          =>     $_POST["hidden_image"],  
                     'item_descp'          =>     $_POST["hidden_description"],   
                     'item_quantity'       =>     $_POST["quantity"] 
                );  

                $_SESSION["shopping_cart"][$count] = $item_array;  

           }  
               else  
               {  
                    echo '<script>alert("Item Already Added")</script>'; 
                    echo '<script>window.location="Home.php#Shop"</script>';  
               }  
           }  
        else  
        {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],    
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"], 
                'item_image'          =>     $_POST["hidden_image"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
         }  


        }  

        else

        {
          echo "  
           <script>
           alert('You need to login First');
           window.location = 'Login.php'; 
           </script>
           ";
        }

 }   

   ?>

  <!DOCTYPE html>              
  <html>

  <head> 
      <link rel="shortcut icon" href="image/logo.png">    
    <title>Culture | Home</title> 
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
    <link rel="stylesheet" type="text/css" href="jquery.nice-number.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>   
    <script src="jquery.nice-number.js"></script>
    <script type="text/javascript">
      $(function(){

        $('input[type="number"]').niceNumber();

      });
    </script>


    <style type="text/css">



      .btn-success
      {
        width: 100%;
        border-radius: 0px;
        background-color: black;
      }

      .btn-success:hover
      {   
        background-color: #1a1a1a;
      }

      input[type=number]
      {
        border:none;
        outline: none;
        border-radius: 5px;
        margin: 0px 5px !important;     
        box-shadow: 0 2px 5px  rgba(0,0,0,0.5);      
        width: 100px; 
      }

      button
      {
        background: black;
        color: #fff;
        border:none;
        outline:none;
        padding: 0 10px;
        border-radius: 5px;     
      }


      button:hover
      {
        background-color: #1a1a1a;
      }

      .map-container
      { 
         background-position: center;
          background-size: cover;
          background-image: url("image/stone-bg.jpg");
          color: white;
          background-attachment: fixed;
      }

      .columni h1
      {
        text-shadow: 0px 0px 5px white;
      }

      .columni p
      {
        font-family: arial;
        font-size: 20px;
        text-shadow: 0px 0px 8px black; 
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

            <li class="nav-item" > 
              <a class="nav-link" href="#Shop"><i class="fa fa-home"></i>&nbsp;&nbsp;SHOP<span class="sr-only">(current)</span></a> 
            </li>   

            <li class="nav-item">   
              <a class="nav-link" href="#about"><i class="fa fa-fire"></i>&nbsp;ABOUT US</a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link"  href="#contact"><i class="fa fa-envelope"></i>&nbsp;&nbsp;CONTACT US</a>
            </li>

            <li class="nav-item">
              <a class="nav-link"  href="#map"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;LOCATION</a>
            </li>

          <?php 
      
        if (isset($_SESSION['email'])) 
        {     

        ?>

          <li class='nav-item'> 
             <a class='nav-link' href="Profile.php" style="cursor: pointer;" title='Profile'><i class='fa fa-user'></i>&nbsp; PROFILE</a>
          </li>   
                    
          <li class='nav-item'>   
          <a class='nav-link' title='logout' href='logout.php'><i class='fa fa-sign-out'></i>&nbsp; LOG OUT</a>  
          </li>    
                  
        <?php
          
        }  

        else  
        {  

          ?>  

      
          <li class='nav-item'>
          <a class='nav-link' title='Sign Up' href="Register.php"><i class='fa fa-user-plus'></i>&nbsp; SIGN UP</a>
          </li>

          <li class='nav-item'>
          <a class='nav-link'  href="Login.php"><i class='fa fa-sign-in'></i>&nbsp; LOG IN</a>  
          </li> 
         
        <?php   
        }   
                      

         ?>

     

        </ul>
      </div>     
     </nav> 
  </section>

      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#"><img src="image/logo.png" width="50px;"></a>
        <a href="Home.php"><i class="fa fa-home"></i>Home</a>
        <a href="news.php"><i class="fa fa-fire"></i>News</a>   
        <a href="about.php"><i class="fa fa-users"></i>About</a>           
        <a href="contact.php"><i class="fa fa-envelope"></i>Contact</a>

        <?php 

          if (isset($_SESSION['email'])) 
          {
              
          ?>
            <a href="Profile.php"><i class="fa fa-user"></i>Profile</a>
          <a href="logout.php"><i class="fa fa-sign-out"></i>LOG OUT</a>

          <?php
          }

          else  
          {     

            ?>

            <a href="Register.php"><i class="fa fa-user-plus" onclick="closeNav()"></i>SIGN UP</a>
          <a href="Login.php" ><i class="fa fa-sign-in" ></i>LOG IN</a>
              
          <?php   
          }

           ?>
        </div>

  <script>
    function openNav() {       
      document.getElementById("mySidenav").style.width = "100%";
    }  
    
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>

    <!-----------------Head Banner ---------->

    <header class="bgimg-1 w3-grayscale-min" id="home" style="padding-top: 70px;">

        <div id="particles-js"></div> 
        <script src="../js/particles.js"></script> 
        <script src="../js/app.js"></script>
        <script src="../js/lib/stats.js"></script>

        <div class="w3-display-left w3-text-white" style="padding:48px">
           
        <div class="word">
          <span>C</span>  
          <span>U</span>  
          <span>L</span>
          <span>T</span> 
          <span>U</span>  
          <span>R</span>   
          <span>E</span>
        </div>      

        <script type="text/javascript">
          const spans = document.querySelectorAll('.word span');

          spans.forEach((span, idx) => {
          span.addEventListener('mouseover', (e) => {
            e.target.classList.add('active');
          });
          span.addEventListener('animationend', (e) => {
            e.target.classList.remove('active');
          });  
           
          // Initial animation    
          setTimeout(() =>     
          {               
            span.classList.add('active');    
          }, 750 * (idx+1))  
          });   

        </script>
            <span class="w3-medium">Steps With Your Trusted Sneaker Shop</span>
            <p><a href="Home.php#about" class="w3-button w3-hover-white" id="link-btn">Learn more about CULTURE</a></p>
          </div> 

          <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
            <i class="fa fa-facebook-official w3-hover-opacity"></i> 
            <i class="fa fa-instagram w3-hover-opacity"></i>    
            <i class="fa fa-snapchat w3-hover-opacity"></i>  
            <i class="fa fa-pinterest-p w3-hover-opacity"></i>    
            <i class="fa fa-twitter w3-hover-opacity"></i>  
            <i class="fa fa-linkedin w3-hover-opacity"></i> 
          </div> 
    </header>   

    <!-------------------Shopping Cart --------------------->
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

     <form action="ShoppingCart.php">

    <button name="to_shopping_cart" id="myBtn-scroll" title="Go to top">🛒</i>  
      <?php   

          if(!empty($_SESSION["shopping_cart"]))  
          {  
            echo "<a class='countno'>$itemcount</a>";
          }

          else
          {
            echo "<a class='countno'>0</a>";
          }
       ?>
       
    </button>  

     </form>


    <!--------Product Display  --------> 

    <div class="w3-container w3-white w3-padding-64" style="width: 100%;" id="Shop">
   
        <h3 class="w3-center"><b>Browse Our Sneakers</b></h3>  
        <p class="w3-center w3-large">All Trending Sneakers In Our Website</p>
     
        <form action="Home.php#team" method="POST">   
        <input type="text" id="productsearch" name="txtsearch" placeholder=" Search Sneaker ...  ">
          <input type="submit" name="btnsearch" id="sbtn" value="Search">
          <input type="submit" name="btnshow" id="sbtn" value="Show All">  
        </form> 
          
          <?php 


          // When search btn is click

          if (isset($_POST['btnsearch']))
          {
            $snname = $_POST['txtsearch'];
            $SELECT = " SELECT * FROM sneaker Where SneakerName LIKE '%$snname%'; "; 

            $run = mysqli_query($connect, $SELECT);
            $COUNT = mysqli_num_rows($run);  

            if ($COUNT < 1) 
            {
              echo "  
              <p style='padding-left:30px; margin-top:px; color:red;'>
              <i class='fa fa-times' style='color:red;'> </i> No data found.
              </p>"; 
            } 

            for ($i=0; $i < $COUNT; $i++) 
            { 
                  $row     = mysqli_fetch_array($run);
                  $snid    = $row[0];     
                  $snname  = $row[1];  
                  $desc    = $row[2];  
                  $price   = $row[4];     
                  $image   = $row[6];   
                  $catid   = $row[7]; 
                  $brid    = $row[8];   
                  $qty     = $row['InstockQTY']; 

                   $select1 = "SELECT * FROM `category` WHERE `CategoryID` = '$catid'";   
                   $run1 = mysqli_query($connect, $select1);      
                   $row     = mysqli_fetch_array($run1);
                   $catename      = $row[1];  
           
                   $select2 = "SELECT * FROM `brand` WHERE `BrandID` = '$brid'";   
                   $run2 = mysqli_query($connect, $select2);   
                   $row  = mysqli_fetch_array($run2);   
                   $brandname = $row[1];   
                         
                   echo "   

              <div class='w3-col l3 m6 w3-margin-bottom pd-card w3-white' id='card' style='margin:1%; width:235px; border:1px solid rgba(0, 0, 0, 0.1);'>  
              <div style='height:240px; '>  
                  <a href='SingleItem.php?id=$snid'><img src='$image' title='$snname' class='w3-hover-opacity' style='width:100%; height:100%;'></a>
              </div>  

              <div style='padding:5px;' class='card-desc'> 
                 <form action='Home.php?action=add&id=<?php echo $snid; ?>' method='post'>
                  <h3 style='font-size:19px; height:30px;'>$snname</h3> 
                  <p class='w3-opacity'>$brandname &nbsp; ($catename;)</p>
                  <p class=''>Price    - &nbsp; $ $price</p>
                  <input type='number' max='$qty' name='quantity' class='form-control' value='1' >   

                  <input type='hidden' name='hidden_name' value='$snname' />  
                  <input type='hidden' name='hidden_price' value='$price' /> 
                  <input type='submit' name='add_to_cart' style='margin-top:5px;' class='btn btn-success' value='Add to Cart' />  
                </form>
      
                
              </div>
              
              </div> 
      
              "; 

            }
 
          }
          //  When search btn is click ----------

          //  When show all btn is click 

            else if (isset($_POST['btnshow'])) 
            {
              $select = "SELECT * FROM `sneaker` ";    
          $run    = mysqli_query($connect, $select);  
          $count  = mysqli_num_rows($run);   

                for ($i=0; $i < $count; $i++) 
                { 

                   $row     = mysqli_fetch_array($run);
                  $snid    = $row[0];     
                  $snname  = $row[1];  
                  $desc    = $row[2];  
                  $price   = $row[4];     
                  $image   = $row[6];   
                  $catid   = $row[7]; 
                  $brid    = $row[8]; 
                  $qty     = $row['InstockQTY'];


         $select1 = "SELECT * FROM `category` WHERE `CategoryID` = '$catid'"; 
         $run1 = mysqli_query($connect, $select1);    
         $row     = mysqli_fetch_array($run1); 
         $catename      = $row[1];  
 
         $select2 = "SELECT * FROM `brand` WHERE `BrandID` = '$brid'"; 
         $run2 = mysqli_query($connect, $select2);   
         $row  = mysqli_fetch_array($run2);        
         $brandname = $row[1];    
               
         echo "   
  
    <div class='w3-col l3 m6 w3-margin-bottom pd-card w3-white' id='card' style='margin:1%; width:235px; border:1px solid rgba(0, 0, 0, 0.1);'>
    <div style='height:240px; '>  
      <a href='SingleItem.php?id=$snid'><img src='$image' title='$snname' class='w3-hover-opacity' style='width:100%; height:100%;'></a>
    </div>  

    <div style='padding:5px;' class='card-desc'> 
        <form action='Home.php?action=add&id=<?php echo $snid; ?>' method='post'>
          <h3 style='font-size:19px; height:30px;'>$snname</h3>    
          <p class='w3-opacity'>$brandname &nbsp; ($catename;)</p>  
          <p class=''>Price - &nbsp; $ $price</p>
          <p class=''>Instock  - &nbsp; $qty</p>
          <input type='number' max='$qty' name='quantity' value='1' >   

          <input type='hidden' name='hidden_name' value='$snname' />  
          <input type='submit' name='add_to_cart' style='margin-top:5px;' class='btn btn-success' value='Add to Cart' />       
        </form>
      
    </div>
    
    </div>
      
 "; 
            }}


            else
            {

          $select = "SELECT * FROM `sneaker` ";    
          $run    = mysqli_query($connect, $select); 
          $count  = mysqli_num_rows($run);   

                for ($i=0; $i < $count; $i++) 
                { 

                  $row     = mysqli_fetch_array($run);
                  $snid    = $row[0];     
                  $snname  = $row[1];  
                  $desc    = $row[2];  
                  $price   = $row[4];     
                  $image   = $row[6];   
                  $catid   = $row[7]; 
                  $brid    = $row[8]; 
                  $qty     = $row['InstockQTY'];

         $select1 = "SELECT * FROM `category` WHERE `CategoryID` = '$catid'"; 
         $run1 = mysqli_query($connect, $select1);    
         $row     = mysqli_fetch_array($run1); 
         $catename      = $row[1];   

         $select2 = "SELECT * FROM `brand` WHERE `BrandID` = '$brid'"; 
         $run2 = mysqli_query($connect, $select2); 
         $row  = mysqli_fetch_array($run2);    
         $brandname = $row[1];  
                  
  ?>

    <div class='w3-col l3 m6 w3-margin-bottom pd-card w3-white' id='card' style='margin:1%; width:235px; border:1px solid rgba(0, 0, 0, 0.1);'>
    <div style='height:240px; '>  

      <?php echo "
      <a href='SingleItem.php?id=$snid'><img src='$image' title='$snname' class='w3-hover-opacity' style='width:100%; height:100%;'></a>
      "; ?>   
     
    </div> 

      <div style='padding:5px;' class='card-desc'> 
        <form action='Home.php?action=add&id=<?php echo $snid; ?>' method="post"> 
          <h3 style='font-size:19px; height:30px;'><?php echo "$snname"; ?></h3> 
          <p class='w3-opacity'><?php echo "$brandname"; ?> &nbsp; (<?php echo "$catename"; ?>)</p> 
          <p class=''>Price - &nbsp; $ <?php echo "$price"; ?></p>
          <input type="number" name="quantity" max="<?php echo($qty); ?>" class="form-control" value="1" /> 
          <input type="hidden" name="hidden_name" value="<?php echo $snname; ?>" />  
          <input type="hidden" name="hidden_price" value="<?php echo $price; ?>" />  
          <input type="hidden" name="hidden_image" value="<?php echo $image; ?>" />   
          <input type="hidden" name="hidden_description" value="<?php echo $desc; ?>" />  
          <input type='submit' name='add_to_cart' style='margin-top:5px;' class='btn btn-success' value='Add to Cart' />  
        </form>
        
      </div>

    </div>    
      
 <?php } }  ?>

            

          </div>   


    <!-----------------------Ultra boosts Slider -------------------->

    <div class="w3-container w3-light-grey" id="news" style="padding:26px">
      <div class="w3-row-padding" style="padding-top:60px; ">  
        <div class="w3-col m6">
              <div class="mySlides">
              <div class="numbertext ">1 / 6</div>
                <img src="image/adidas1.jpeg" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">2 / 6</div>
                <img src="image/adidas2.jpeg" style="width:100%">
            </div>
        
            <div class="mySlides">
              <div class="numbertext">3 / 6</div>  
                <img src="image/adidas3.jpeg" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">4 / 6</div>
                <img src="image/adidas4.jpeg" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">5 / 6</div>
                <img src="image/adidas5.jpeg" style="width:100%">
            </div>

            <div class="mySlides">
              <div class="numbertext">6 / 6</div>
                <img src="image/adidas2.jpeg" style="width:100%">
            </div>

            <!-- Image text -->
            <div class="caption-container">
              <p id="caption"></p> 
            </div>
               
            <!-- Thumbnail images -->  
            <div class="row">  
              <div class="column">
                <img class="demo cursor" src="image/adidas1.jpeg" style="width:100%" onclick="currentSlide(1)" alt="Front View">
              </div>

              <div class="column">
                <img class="demo cursor" src="image/adidas2.jpeg" style="width:100%" onclick="currentSlide(2)" alt="Ready For Sport Time">
              </div>
              <div class="column">     
                <img class="demo cursor" src="image/adidas3.jpeg" style="width:100%" onclick="currentSlide(3)" alt="Made Details">
              </div>    
              <div class="column">
                <img class="demo cursor" src="image/adidas4.jpeg" style="width:100%" onclick="currentSlide(4)" alt="Strong and Light">
              </div>
              <div class="column"> 
                <img class="demo cursor" src="image/adidas5.jpeg" style="width:100%" onclick="currentSlide(5)" alt="Super Comfort">
              </div>    
              
              <div class="column">
                <img class="demo cursor" src="image/adidas2.jpeg" style="width:100%" onclick="currentSlide(6)" alt="Ready For Sport Time">
              </div>
            </div>  
            </div> 
     
               <div class="w3-col m6" style="padding-top:60px;">

            <h3><b>ADIDAS Ultra Boost Out Now !</b></h3>

            <p><br><b>Adidas Ultra Boost</b> is Out Now and we are recieving orders. Light, strong, comfortable and awesome color way being most exicitive in ADIDAS history.  Don't Forget to order since it is <b>Limited Addition</b>.</p>
            <p><b>Price : $980</b></p><br>  

            <p><a class="w3-button w3-black"><i class="fa fa-shopping-cart"> </i> Order now!</a></p>

          </div>
               
      </div>
    </div><br><br>  

   

<!-- About Section -->

<div class="w3-container" id="about">
    <h3 class="w3-center">ABOUT Culture Sneaker</h3> 
    <p class="w3-center w3-large">Key features of our company</p>


    <div class="w3-row-padding w3-center col-md-12" id="abo-cnt">

        <div class="w3-quarter">
          <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center col-md-3"></i>
          <p class="w3-large"><b>Responsive</b></p>
          <p>Our service center is 24/7 <b>Ready</b> to answer Customers' Questions and Feedbacks.</p>
        </div> 

        <div class="w3-quarter">
          <i class="fa fa-truck w3-margin-bottom w3-jumbo col-md-3"></i>  
          <p class="w3-large"><b>Delivery</b></p>
          <p>We are delivering our sneakers to customer's home addresses. Delivery charges is <b>Free</b> within <b>Yangon</b>. </p>
        </div>

        <div class="w3-quarter">
          <i class="fa fa-usd w3-margin-bottom w3-jumbo col-md-3"></i>
          <p class="w3-large"><b>Price</b></p> 
          <p>All the items are in the <b>Suitable Price Range</b>. Our customers don't need to worry about the price and quality of our sneakers. </p>
        </div>

        <div class="w3-quarter">  
          <i class="fa fa-thumbs-up w3-margin-bottom w3-jumbo col-md-3"></i>
          <p class="w3-large"><b>Our Goals</b></p>
          <p>Over <b>2000 customers</b> are satisfied with our sneakers and delivery services.</p>
        </div> 

             <a href="#aboutII" id="downarrow"><i class="fa fa-angle-double-down"></i></a>
     </div>
    </div>

    <!-- Skills Section -->

    <div class="w3-container w3-white w3-padding-64" id="aboutII" style="padding:26px"> 

        <div class="w3-row-padding" style="padding-top:30px; ">  
               <div class="w3-col m6">
            <h3><b>Our Actions</b></h3> 
        <p>According to all of customers' feedbacks on our services, we excute our skills on different actions.</p>
        <p>The section beside show percentages of our customers care and services. </p>
        <p>Please give Feedbacks about our service in <a href="contact.php"><b>Contact Us</b></a> section.</p>
          </div>

          <div class="w3-col m6  ">
            <p class="w3-wide"><i class="fa fa-usd w3-margin-right"></i>Pricing</p>
        <div class="w3-grey"> 
          <div class="w3-container w3-black w3-center"
           style="width:90%;">90%</div> 
        </div>   
        <p class="w3-wide"><i class="fa fa-truck w3-margin-right"></i>Delivery</p>
        <div class="w3-grey"> 
          <div class="w3-container w3-black w3-center" style="width:75%;">75%</div>
        </div>

        <p class="w3-wide"><i class="fa fa-handshake-o w3-margin-right"></i>Service</p>
        <div class="w3-grey">
          <div class="w3-container w3-black w3-center" style="width:85%;">85%</div>
        </div>

        <p class="w3-wide"><i class="fa fa-heart w3-margin-right"></i>Good Feedback</p>
        <div class="w3-grey">
          <div class="w3-container w3-black w3-center" style="width:78%;">78%</div>
        </div> 
              </div>       
             </div>


  </div>  


  <!-- Contact Section -->

  <br><br><br>
<div class="container-con w3-container w3-padding-64" id="contact">
  <div style="text-align:center ">
    <h2>Contact Us</h2>
    <p>Swing by for a cup of coffee, or leave us a message:</p>
  </div>

  <div class="row col-md-12">

    <div class="columni col-md-6">
      <img id="world-map" width="95%" src="image/shopimg.jpg">
    </div>

    <div class="columni col-md-6">
      <form action="/action_page.php">

        <input type="text" id="lname" name="lastname" placeholder="Enter Your Full Name..">

        <select id="country" name="country">
          <option value="australia">Australia</option>
          <option value="canada">Canada</option>
          <option value="usa">USA</option>
        </select>

        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
        <button type="submit" value="SUBMIT">Submit</button>

      </form>
    </div>
  </div>
</div>


  

    <!----------------- Full-width images with number text --------->
       <script type="text/javascript">
            var slideIndex = 1;  
            showSlides(slideIndex);

            // Next/previous controls
            function plusSlides(n) {
              showSlides(slideIndex += n);
            }
     
            // Thumbnail image controls  
            function currentSlide(n) 
            {
              showSlides(slideIndex = n);
            }  

            function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("demo");
              var captionText = document.getElementById("caption");
              if (n > slides.length) {slideIndex = 1}  
              if (n < 1) {slideIndex = slides.length}      

              for (i = 0; i < slides.length; i++) 
              {
                slides[i].style.display = "none";   
              }

              for (i = 0; i < dots.length; i++) 
              {
                dots[i].className = dots[i].className.replace(" active", "");
              }    

              slides[slideIndex-1].style.display = "block";
              dots[slideIndex-1].className += " active";
              captionText.innerHTML = dots[slideIndex-1].alt;
            }
       </script>

        <div class="row col-md-12 w3-padding-64 map-container" id="map">

            <div class="columni col-md-6">
              <h1><i class="fa fa-map-marker"> Location</i></h1><br>
              <p>Address : &nbsp;No.331 Pyay Rd, Yangon</p> 
              <p>Phone &nbsp;&nbsp; : &nbsp;959 784698290</p> 


            </div>


            <div class="columni col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.33813767225!2d96.13479863729552!3d16.80957320968125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ebcafe604d07%3A0x26451fa071576c95!2sKMD%20IT%20%26%20Mobile%20Sales%20Center%20(Myaynigone)!5e0!3m2!1sen!2smm!4v1586660810075!5m2!1sen!2smm" width="100%" height="450" ></iframe>
            </div>

        </div>




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
              <a href="#Shop" id="foot-link" >Shop</a> 
            </p>

            <p>
              <a href="#about" id="foot-link">About Us</a>
            </p>  

            <p> 
              <a href="#contact" id="foot-link">Contact Us</a> 
            </p>

            <p>
              <a href="#map" id="foot-link">Location</a>
            </p> 

          </div>

          <!-- Grid column --> 
          <hr class="w-100 clearfix d-md-none"> 

          <!-- Grid column -->    
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3"> 
              <h6 class="text-uppercase mb-4 font-weight-bold" id="foot-head">Contact</h6>
              <p id="foot-link">      
                <i class="fa fa-home mr-3" ></i> Yangon, Myanmar </p>  
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