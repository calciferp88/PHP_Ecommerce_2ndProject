  <?php 

    session_start();
    $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");

    if (isset($_GET['id'])) 
    {
    	$snid = $_GET['id'];

		$SELECT = " SELECT * FROM sneaker Where SneakerID = '$snid' "; 
		$run    = mysqli_query($connect, $SELECT); 
        $count  = mysqli_num_rows($run);

            for ($i=0; $i < $count; $i++) 
               { 

	                  $row     = mysqli_fetch_array($run);
	                  $snid    = $row[0];     
	                  $snname  = $row[1];  
	                  $desc    = $row[2];    
	                  $price   = $row['SellStockPrice'];
	                  $image   = $row['Image'];   
	                  $catid   = $row['CategoryID']; 
	                  $brid    = $row['BrandID'];

			         $select1 = "SELECT * FROM `category` WHERE `CategoryID` = '$catid'"; 
			         $run1 = mysqli_query($connect, $select1);    
			         $row     = mysqli_fetch_array($run1); 
			         $catename      = $row[1];  
			 
			         $select2 = "SELECT * FROM `brand` WHERE `BrandID` = '$brid'"; 
			         $run2 = mysqli_query($connect, $select2);     
			         $row  = mysqli_fetch_array($run2);   
			         $brandname = $row[1];  
			               
                }

    }

    // Adding to Shopping Cart  ------------------------------------------  

     if(isset($_POST["add_to_cart"]))  
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
                echo '<script>window.location="Home.php"</script>';  
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

   ?>





<!DOCTYPE html>             
  <html>

  <head> 
      <link rel="shortcut icon" href="image/logo.png">  
    <title>Culture | Home</title> 
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
    	.center 
		{
		  display: block;
		  margin-left: 5px;
		  width: 50%;
		  box-shadow: 0px 0px 10px black;
		}

		.center:hover
		{
		  box-shadow: 0px 0px 20px black;
		}

		h1
		{
			font-size: 50px;
		}

		.conti p
		{
			font-size: 20px;
		}


		p a
		{
			text-decoration: none;
			font-size: 
		}

		p a:hover
		{
			color: red;
			text-decoration: none;
		}


    span.psw 
    {
      float: right;
      padding-top: 16px;  
    }


      input[type=number]
      {
        border:none;
        outline: none;
        border-radius: 5px;
        margin: 0px 5px !important; 
        box-shadow: 0 2px 5px  rgba(0,0,0,0.5); 
        width: 100px; 
        background-color: white;
        color: black;
        text-align: center;
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

            <li class="nav-item" > <a class="nav-link" href="Home.php"><i class="fa fa-home"></i>&nbsp;&nbsp;HOME<span class="sr-only">(current)</span></a> 
            </li>   
      
        </ul>
      </div>     
     </nav> 
    </section>

    <form action="" method="POST" enctype="multipart/form-data" style="padding-top: 70px;">  

	    <div class="w3-container w3-light-grey conti" id="news" style="padding:26px;"> 

	        <div class="w3-row-padding" style="padding-top:30px; ">  

	            <div class="w3-col m6">
	              <?php echo "<img src='$image' class='center'>"?>     
	            </div>      

	            <div class="w3-col m6"> 
	               	<b><h1><?php echo "$snname"; ?></h1></b><br>
	               	<p>Brand    - <b><?php echo "$brandname"; ?></b></p> 
	               	<p>Category - <b><?php echo "$catename"; ?></b></p>
	               	<p>Price - <b style="color: red;"> $ <?php echo "$price"; ?></b></p>   
                  <p>Quantity -<input type="number" name="quantity" value="1" max="5"></p>  
	            </div>  
      <form action='SingleItem.php?action=add&id=<?php echo $snid; ?>' method="post">
          <input type="hidden" name="hidden_name" value="<?php echo $snname; ?>" />  
          <input type="hidden" name="hidden_price" value="<?php echo $price; ?>" />  
          <input type="hidden" name="hidden_image" value="<?php echo $image; ?>" /> 
          <input type="hidden" name="hidden_description" value="<?php echo $desc; ?>" /> 
   
             <?php 
      
        if (isset($_SESSION['email'])) 
        {
          echo "<button class='w3-button button w3-black' name='add_to_cart'>Add To Cart</button></form>";

          $email  = $_SESSION['email'];    

          $select = "SELECT * FROM `customer` WHERE Email = '$email'"; 
   
          $run = mysqli_query($connect,$select);   
          $row = mysqli_fetch_array($run);    

          $name      = $row[1];  
          $email     = $row[2];   
          $phone     = $row[3]; 


        }

        else
        {
          echo "<a class='w3-button button' href='Login.php' style='background-color: black; color: white;'> Log In to Buy </a> ";
        }



        ?>
        

	        </div>  

                <div class="w3-col m6" >
                  <h3 style="padding-bottom: 0px;" class="w3-padding"><b>Description</b></h3> 
                  <p style="font-size: 17px; border-left: black 2px solid; font-family: arial;" class="w3-padding"><?php echo "$desc"; ?></p>
                </div> 
	    </div> 

    </form>
    

    <div id="modal-container">
      <div class="modal-background">
        <div class="modal">
            <div>
              <span onclick="document.getElementById('modal-container').style.display='none'" class="close">&times;</span>
            </div>


          <form class=" animate" action="/action_page.php" method="post" style="text-align: left; border:none;">


            <div class="container w3-row-padding">

              <div class="w3-col m6">
                <?php echo "<img src='$image' class='center' style='width:50%;'>"; ?>
              </div>

              <div class="w3-col m6">
                <b><h2><?php echo "$snname"; ?></h2></b><br>   
                <p>Total Price - <b style="color: red;"> $ <?php echo "$price"; ?></b></p>  

              </div>

            </div><br>


              <label for="Address"><b>Full Address :</b></label>
              <input type="text" placeholder="Enter Your Full Address . . ." name="txtaddress" required>

              <label for="City"><b>City :</b></label>
                <input type="text" placeholder="Enter Your City . . ." name="txtcity" required><!-- 

                <label for="City"><b>Phone Number :</b></label>
                <input type="text" placeholder="Enter Your Phone Number . . . " value="<?php echo($phone) ?>" name="txtcity" required><br> -->

              <label>Choose Size : </label>
                <select>
                  <option>38</option>
                  <option>39</option>
                  <option>40</option>
                  <option>41</option>
                  <option>42</option>
                  <option>43</option>
                </select>

              <label for="Code"><b>Enter security Code :</b></label>
              <input type="text" placeholder="Enter Your Security Code . . ." name="txtcity" required>
                
              <button type="submit">Comfirm</button>

            </div>

    
          </form>


        </div>
      </div>
    </div>


<style type="text/css">


    

    input[type=text], input[type=password], input[type=email] , textarea, select
    { 
      width: 100%;  
      padding: 12px 20px;  
      margin: 8px 0;   
      display: inline-block;    
      border: 1px solid rgba(0,0,0,0.3);    
      box-sizing: border-box; 
      background-color: #e6e6e6;   
      color: black;
      font-family: arial;
    }  
      
    input[type=text]:focus, textarea:focus 
    {
      background-color: #d9d9d9;
    }




    #modal-container {

      position: fixed;
      display: table;
      height: 100%;
      width: 100%;
      top: 0;
      left: 0;
      transform: scale(0);
      z-index: 1;
    }

    #modal-container.two {
      transform: scale(1);
    }
    #modal-container.two .modal-background {
      background: rgba(0, 0, 0, 0);
      animation: fadeIn 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }
    #modal-container.two .modal-background .modal {
      opacity: 0;
      animation: scaleUp 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }
    #modal-container.two + .content {
      animation: scaleBack 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }
    #modal-container.two.out {
      animation: quickScaleDown 0s .5s linear forwards;
    }
    #modal-container.two.out .modal-background {
      animation: fadeOut 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }
    #modal-container.two.out .modal-background .modal {
      animation: scaleDown 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }
    #modal-container.two.out + .content {
      animation: scaleForward 0.5s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
    }


    #modal-container .modal-background {
      display: table-cell;
      background: rgba(0, 0, 0, 0.8);
      text-align: center;
      vertical-align: middle;
    }
    #modal-container .modal-background .modal {
      background: white;
      padding: 50px;
      display: inline-block;
      border-radius: 3px;
      font-weight: 300;
      position: relative;
      width: 50%;
      height: 90%;
    }
    #modal-container .modal-background .modal h2 {
      font-size: 25px;
      line-height: 25px;
      margin-bottom: 15px;
    }
    #modal-container .modal-background .modal p {
      font-size: 18px;
      line-height: 22px;
    }
    #modal-container .modal-background .modal .modal-svg {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      border-radius: 3px;
    }
    #modal-container .modal-background .modal .modal-svg rect {
      stroke: #fff;
      stroke-width: 2px;
      stroke-dasharray: 778;
      stroke-dashoffset: 778;
    }

    .content {
      min-height: 100%;
      height: 100%;
      background: white;
      position: relative;
      z-index: 0;
    }
    .content h1 {
      padding: 75px 0 30px 0;
      text-align: center;
      font-size: 30px;
      line-height: 30px;
    }
    .content .buttons {
      max-width: 800px;
      margin: 0 auto;
      padding: 0;
      text-align: center;
    }
    .content .buttons .button {
      display: inline-block;
      text-align: center;
      padding: 10px 15px;
      margin: 10px;
      background: red;
      font-size: 18px;
      background-color: #efefef;
      border-radius: 3px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
      cursor: pointer;
    }
    .content .buttons .button:hover {
      color: white;
      background: #009bd5;
    }

    @keyframes unfoldIn {
      0% {
        transform: scaleY(0.005) scaleX(0);
      }
      50% {
        transform: scaleY(0.005) scaleX(1);
      }
      100% {
        transform: scaleY(1) scaleX(1);
      }
    }
    @keyframes unfoldOut {
      0% {
        transform: scaleY(1) scaleX(1);
      }
      50% {
        transform: scaleY(0.005) scaleX(1);
      }
      100% {
        transform: scaleY(0.005) scaleX(0);
      }
    }
    @keyframes zoomIn {
      0% {
        transform: scale(0);
      }
      100% {
        transform: scale(1);
      }
    }
    @keyframes zoomOut {
      0% {
        transform: scale(1);
      }
      100% {
        transform: scale(0);
      }
    }
    @keyframes fadeIn {
      0% {
        background: rgba(0, 0, 0, 0);
      }
      100% {
        background: rgba(0, 0, 0, 0.7);
      }
    }
    @keyframes fadeOut {
      0% {
        background: rgba(0, 0, 0, 0.7);
      }
      100% {
        background: rgba(0, 0, 0, 0);
      }
    }
    @keyframes scaleUp {
      0% {
        transform: scale(0.8) translateY(1000px);
        opacity: 0;
      }
      100% {
        transform: scale(1) translateY(0px);
        opacity: 1;
      }
    }
    @keyframes scaleDown {
      0% {
        transform: scale(1) translateY(0px);
        opacity: 1;
      }
      100% {
        transform: scale(0.8) translateY(1000px);
        opacity: 0;
      }
    }
    @keyframes scaleBack {
      0% {
        transform: scale(1);
      }
      100% {
        transform: scale(0.85);
      }
    }
    @keyframes scaleForward {
      0% {
        transform: scale(0.85);
      }
      100% {
        transform: scale(1);
      }
    }
    @keyframes quickScaleDown {
      0% {
        transform: scale(1);
      }
      99.9% {
        transform: scale(1);
      }
      100% {
        transform: scale(0);
      }
    }
    @keyframes slideUpLarge {
      0% {
        transform: translateY(0%);
      }
      100% {
        transform: translateY(-100%);
      }
    }
    @keyframes slideDownLarge {
      0% {
        transform: translateY(-100%);
      }
      100% {
        transform: translateY(0%);
      }
    }
    @keyframes moveUp {
      0% {
        transform: translateY(150px);
      }
      100% {
        transform: translateY(0);
      }
    }
    @keyframes moveDown {
      0% {
        transform: translateY(0px);
      }
      100% {
        transform: translateY(150px);
      }
    }
    @keyframes blowUpContent {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      99.9% {
        transform: scale(2);
        opacity: 0;
      }
      100% {
        transform: scale(0);
      }
    }
    @keyframes blowUpContentTwo {
      0% {
        transform: scale(2);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }
    @keyframes blowUpModal {
      0% {
        transform: scale(0);
      }
      100% {
        transform: scale(1);
      }
    }
    @keyframes blowUpModalTwo {
      0% {
        transform: scale(1);
        opacity: 1;
      }
      100% {
        transform: scale(0);
        opacity: 0;
      }
    }
    @keyframes roadRunnerIn {
      0% {
        transform: translateX(-1500px) skewX(30deg) scaleX(1.3);
      }
      70% {
        transform: translateX(30px) skewX(0deg) scaleX(0.9);
      }
      100% {
        transform: translateX(0px) skewX(0deg) scaleX(1);
      }
    }
    @keyframes roadRunnerOut {
      0% {
        transform: translateX(0px) skewX(0deg) scaleX(1);
      }
      30% {
        transform: translateX(-30px) skewX(-5deg) scaleX(0.9);
      }
      100% {
        transform: translateX(1500px) skewX(30deg) scaleX(1.3);
      }
    }
    @keyframes sketchIn {
      0% {
        stroke-dashoffset: 778;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }
    @keyframes sketchOut {
      0% {
        stroke-dashoffset: 0;
      }
      100% {
        stroke-dashoffset: 778;
      }
    }
    @keyframes modalFadeIn {
      0% {
        background-color: transparent;
      }
      100% {
        background-color: white;
      }
    }
    @keyframes modalFadeOut {
      0% {
        background-color: white;
      }
      100% {
        background-color: transparent;
      }
    }
    @keyframes modalContentFadeIn {
      0% {
        opacity: 0;
        top: -20px;
      }
      100% {
        opacity: 1;
        top: 0;
      }
    }
    @keyframes modalContentFadeOut {
      0% {
        opacity: 1;
        top: 0px;
      }
      100% {
        opacity: 0;
        top: -20px;
      }
    }
    @keyframes bondJamesBond {
      0% {
        transform: translateX(1000px);
      }
      80% {
        transform: translateX(0px);
        border-radius: 75px;
        height: 75px;
        width: 75px;
      }
      90% {
        border-radius: 3px;
        height: 182px;
        width: 247px;
      }
      100% {
        border-radius: 3px;
        height: 162px;
        width: 227px;
      }
    }
    @keyframes killShot {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
      }
      100% {
        transform: translateY(300px) rotate(45deg);
        opacity: 0;
      }
    }
    @keyframes fadeToRed {
      0% {
        background-color: rgba(0, 0, 0, 0.6);
      }
      100% {
        background-color: rgba(255, 0, 0, 0.8);
      }
    }
    @keyframes slowFade {
      0% {
        opacity: 1;
      }
      99.9% {
        opacity: 0;
        transform: scale(1);
      }
      100% {
        transform: scale(0);
      }
    }

</style>



    <script>
      $('.button').click(function(){
      var buttonId = $(this).attr('id');
      $('#modal-container').removeAttr('class').addClass(buttonId);
      $('body').addClass('modal-active');
    })
       $('#modal-container').click(function(){
      $('body').removeClass('modal-active');
    });
    </script>


    <script type="text/javascript">
    var modal = document.getElementById('modal-container');
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    } 
    </script>


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
              <a href="#" id="foot-link" class="this">Home</a>
            </p>
            <p>
              <a href="News.php" id="foot-link">News</a>
            </p>
            <p>
              <a href="Contact.php" id="foot-link">Contact Us</a>
            </p>
            <p>
              <a href="about.php" id="foot-link">About Us</a>
            </p>

          </div>

          <!-- Grid column --> 
          <hr class="w-100 clearfix d-md-none">

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold" id="foot-head">Contact</h6>
            <p id="foot-link">   
              <i class="fa fa-home mr-3" ></i> Yangon, Myanmar</p>
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