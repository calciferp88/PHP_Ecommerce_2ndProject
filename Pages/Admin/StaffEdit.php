<?php 

  session_start();
  $connect = mysqli_connect("localhost", "root","", "culturesneakerdb");


// -------- Brand Update
  if (isset($_POST ['btn-br-update'])) 
{
    $brid    = $_POST ['txtbrid'];
    $brname    = $_POST ['txtbrName'];

  $update = "UPDATE `brand` SET BrandName='$brname' WHERE BrandID='$brid'"; 

  $run = mysqli_query($connect, $update);   

  if ($run) 
  { 
          echo "    
           <script>   
           alert('The Brand is Updated Successfully !'); 
           window.location = 'EditBrand.php'     
           </script>        
           ";   
     } 
 
      else
     {    
        echo mysqli_error($connect);
     }
      
}




// -------- Staff Update
  if (isset($_POST ['btn-stf-update'])) 
{
    $sid    = $_POST ['txtsid'];
    $sname    = $_POST ['txtsname'];
    $semail    = $_POST ['txtsemail'];
    $sphone    = $_POST ['txtsphone'];

  $update = "UPDATE `staff` SET staffname='$sname', staffemail = '$semail', staffphone ='$sphone' WHERE StaffID='$sid'"; 

  $run = mysqli_query($connect, $update);   

  if ($run) 
  { 
          echo "    
           <script>   
           alert('The Staff is Updated Successfully !'); 
           window.location = 'EditStaff.php'     
           </script>        
           ";   
     } 
 
      else
     {    
        echo mysqli_error($connect);
     }
      
}


// -------- Category Update
  if (isset($_POST ['btn-cate-update'])) 
{ 
    $cid    = $_POST ['txtcateid'];             
    $cname    = $_POST ['txtcateName'];  

  $update = "UPDATE `category` SET Category ='$cname' WHERE CategoryID='$cid'"; 
      
  $run = mysqli_query($connect, $update);   

  if ($run) 
  {    
          echo "    
           <script> 
           alert('The Category is Updated Successfully !');  
           window.location = 'EditCategory.php'  
           </script>      
           ";  
     } 
  
      else
     { 
        echo mysqli_error($connect);
     }

}

// --------------------- Sneaker Update

if (isset($_POST ['btn-sneak-update'])) 
{
  $snid = $_POST ['txtsnid'];
  $snname = $_POST ['txtsnname']; 
  $desc = $_POST ['txtdescp'];
  $buyprice = $_POST ['txtbuyprice'];
  $sellprice = $_POST ['txtsellprice'];
  $cate = $_POST ['sel-cat'];
  $brand = $_POST ['sel-brand'];

 $select1 = "SELECT * FROM `category` WHERE `Category` = '$cate'"; 
 $run1 = mysqli_query($connect, $select1); 
 $row     = mysqli_fetch_array($run1); 
 $cateid      = $row[0];

 $select2 = "SELECT * FROM `brand` WHERE `BrandName` =  '$brand'"; 
 $run2 = mysqli_query($connect, $select2);     

 $row     = mysqli_fetch_array($run2); 
 $brandid      = $row[0]; 

$Update = " UPDATE `sneaker` SET SneakerName=' $snname' ,Description='$desc' ,BuyPrice='$buyprice' ,SellStockPrice='$sellprice' , CategoryID=' $cateid' ,BrandID=' $brandid'  WHERE SneakerID = '$snid'";

      $run = mysqli_query($connect, $Update);   

      if ($run) 
      {
      echo "      
           <script>   
           alert('This Sneaker is updated Successfully !');
           window.location = 'EditProduct.php'
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
<link rel="shortcut icon" href="../Customer/image/logo.png">  
<title>Culture | Edit</title>  
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">   
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../Customer/Style.css">
<link rel="stylesheet" type="text/css" href="make.css">  
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<style type="text/css">
  
 input[type=text], input[type=number], select
  {
     width: 100%;
     margin-bottom: 30px;
     height: 60px;
     border: 1px solid #ccc;
     border-radius: 3px;
  }

.center 
{
  display: block;
  margin-left: 5px;
  width: 20%;
  box-shadow: 0px 0px 10px black;
}

.center:hover
{
  box-shadow: 0px 0px 20px black;
}

/* Style the Image Used to Trigger the Modal */
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}


/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}

.text-lab
{
 padding-top: 30px;
 font-weight: bold;
}

</style>

</head>

<!--------------------------------------------Header------------------------------------------>

<body> 

 <!-- Navbar (sit on top) -->  
  <header>
    
    <div class="logo">
      <h1 class="logo-text"><span>CULTURE</span>Sneaker</h1>
    </div>
    <i class="fa fa-bars menu-toggle" onclick="openNav()"></i>
  

  </header>

<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="StaffMainForm.php" onclick="w3_close()" class="w3-bar-item w3-button">Home</a>  
</nav>  
  

<?php 

// ----------------BrandEdit-----

if (isset($_GET['brandid']))
{

  $brandid = $_GET['brandid'];  
  $select = "SELECT * FROM `brand` WHERE BrandID = '$brandid' ";
  $run = mysqli_query($connect, $select);
  $row = mysqli_fetch_array($run);
  $brid = $row[0];
  $brname = $row[1];
   
  echo 
  "
  <div id='BrandInput'>
    <div class='w3-container w3-center w3-light-grey' style='padding:128px 16px' id='half-form'><br><br>
   <h2>Edit Brand</h2>
   <form action='StaffEdit.php' method='POST'  enctype='multipart/form-data'>

      <p><input class='w3-padding w3-input w3-border' type='text' value='$brid' required name='txtbrid' readonly></p>

      <p><input class=' w3-padding w3-container w3-input w3-border' type='text' placeholder='Entet Brand Name' value='$brname' required name='txtbrName'></p>

      <br><br> 

      <p>
        <button class='w3-button w3-black' type='submit' name='btn-br-update'>
          <i class='fa fa-paper-plane'></i>  Update Brand  
        </button>
      </p>  
    </form> </div> </div> 
  ";
}

?>



<?php 


// ----------------CategoryEdit-------------
if (isset($_GET['categoryid']))
{

  $cateid = $_GET['categoryid'];  
  $select = "SELECT * FROM `category` WHERE CategoryID = '$cateid' ";
  $run = mysqli_query($connect, $select);
  $row = mysqli_fetch_array($run);
  $categoryid = $row[0];
  $categoryname = $row[1];  

  echo 
  "
  <div id='BrandInput'>
    <div class='w3-container w3-center w3-light-grey' style='padding:128px 16px' id='half-form'><br><br>
   <h2>Edit Category</h2>
   <form action='StaffEdit.php' method='POST'  enctype='multipart/form-data'>

      <p><input class='w3-padding w3-input w3-border' type='text' value='$categoryid' required name='txtcateid' readonly></p>

      <p><input class='w3-padding w3-input w3-border' type='text' placeholder='Entet Category' value='$categoryname' required name='txtcateName'></p>

      <br><br> 

      <p>
        <button class='w3-button w3-black' type='submit' name='btn-cate-update'>
          <i class='fa fa-paper-plane'></i>  Update Category  
        </button>
      </p>  
    </form> </div> </div> 
  ";
}
?>

<?php 


// ----------------StaffEdit-------------
if (isset($_GET['staffid']))
{

  $sid = $_GET['staffid'];  
  $select = "SELECT * FROM `staff` WHERE StaffID = '$sid' ";
  $run = mysqli_query($connect, $select);
  $row = mysqli_fetch_array($run);
  $stfid = $row[0];
  $stfname = $row[1];  
  $stfemail = $row[2];
  $stfphone = $row[3];
  $role = $row[4];
  $password = $row[5];    

  echo 
  "
  <div id='BrandInput'>
    <div class='w3-container w3-center w3-light-grey' style='padding:18px 16px' id='half-form'>
   <h2>Edit Staff</h2>
   <form action='StaffEdit.php' method='POST'  enctype='multipart/form-data'>


      <p><input class='w3-padding w3-input w3-border' type='hidden' value='$stfid' name='txtsid'></p>

      <p><input class='w3-padding w3-input w3-border' type='text' value='$stfname' required name='txtsname' ></p>

      <p><input class='w3-padding w3-input w3-border' type='email' value='$stfemail' required name='txtsemail' ></p>

      <p><input class='w3-padding w3-input w3-border' type='text' value='$stfphone' required name='txtsphone' ></p>

      <p><input class='w3-padding w3-input w3-border' type='text' value='$role' required name='txtrole' ></p>

      <p>
        <button class='w3-button w3-black' type='submit' name='btn-stf-update'>
          <i class='fa fa-paper-plane'></i>  Update Staff Info  
        </button>
      </p>  
    </form> </div> </div> 
  ";
}
?>




<!------------------------ Sneaker Edit --------------------->
<?php  
if (isset($_GET['sneakerid']))
{

  $snid = $_GET['sneakerid'];  
  $select = "SELECT * FROM `sneaker` WHERE SneakerID = '$snid' ";
  $run = mysqli_query($connect, $select);
  $row = mysqli_fetch_array($run);

  $snid   = $row[0];
  $snname = $row[1];  
  $descp  = $row[2];
  $buyprice  = $row[3]; 
  $sellprice = $row[4]; 
  $instock   = $row[5];  
  $image     = $row[6];
  $categoryid = $row[7];  
  $brandid    = $row[8];

 $select1 = "SELECT * FROM `category` WHERE `CategoryID` = '$categoryid'"; 
 $run1 = mysqli_query($connect, $select1);
 $row     = mysqli_fetch_array($run1); 
 $categNameSn      = $row[1];

 $select2 = "SELECT * FROM `brand` WHERE `BrandID` =  '$brandid'"; 
 $run2 = mysqli_query($connect, $select2);   
 $row     = mysqli_fetch_array($run2); 
 $brandNameSn      = $row[1]; 
  ?>
  
  <div id='BrandInput'>
    
   <div class='w3-container w3-light-grey' style='padding:0px 16px' id='half-form'><br><br>
   <h2 style="border-left: solid 3px black; padding-left: 20px; width: 280px;">Edit Sneaker</h2><br><br>
   <form action='StaffEdit.php' method='POST'  enctype='multipart/form-data'>



<img src="<?php echo($image )?>" class="center" id="myImg">     

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">   
    
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div><br>

  <label class="text-lab">Sneaker ID </label>
  <p><input class='w3-padding w3-input w3-border' type='text' value='<?php echo($snid) ?>' required name='txtsnid' readonly></p>

  <label class="text-lab">Sneaker Name</label>
  <p><input class='w3-padding w3-input w3-border' type='text' placeholder='Entet Sneaker Name' value='<?php echo($snname) ?>' required name='txtsnname'></p>

      <label class="text-lab">Description</label>
      <p><textarea class='w3-padding w3-input w3-border' required name='txtdescp' placeholder='Enter Sneaker Description'><?php echo "$descp"; ?></textarea></p>

          <script type="text/javascript">     
              CKEDITOR.replace( 'txtdescp' );
              $(document).ready(function(){
              $(document).on('mousemove',function(e){
              $("#cords").html("Cords: Y: "+e.clientY);
              })
              });
          </script>


      <label class="text-lab">Buy Price</label>
      <p><input class='w3-padding w3-input w3-border ' type='number' placeholder='Entet Buy Price' value='<?php echo($buyprice) ?>' required name='txtbuyprice'></p>

      <label class="text-lab">Sell Stock Price</label>
      <p><input class='w3-padding w3-input w3-border ' type='number' placeholder='Entet Sell Stock Price' value='<?php echo($sellprice) ?>' required name='txtsellprice'></p>

      <label class="text-lab">Instock Quantity</label>
      <p><input class='w3-padding w3-input w3-border ' type='number' value='<?php echo($instock) ?>' required readonly></p>

      <label class="text-lab">Select Brand</label>
      <p><select class='w3-padding w3-input w3-border' name="sel-brand">   
      <option><?php echo($brandNameSn) ?></option>
  
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

      <label class="text-lab">Select category</label>
      <p><select class='w3-input w3-border' name="sel-cat"> 
      <option><?php echo($categNameSn) ?></option>
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
      </select></p><br><br> 

      <p>
        <button class='w3-button w3-black' type='submit' name='btn-sneak-update'>
          <i class='fa fa-paper-plane'></i>  Update Sneaker  
        </button>
      </p>  
    </form> </div> </div> 


<?php } ?>

<!------------------------ SInvoice --------------------->
  <?php 

    if (isset($_GET['purchaseid']))
    {

      $pid = $_GET['purchaseid'];  
      $select = "SELECT * FROM `purchase` WHERE PurchaseID = '$pid' ";
      $run = mysqli_query($connect, $select);
      $row = mysqli_fetch_array($run);

      $pdate       = $row['PurchaseDate'];
      $grandtotal  = $row['TotalPrice'];
      $staffid     = $row['StaffID'];
      $supplierid  = $row['SupplierID'];  

      $select1 = "SELECT * FROM `supplier` WHERE SupplierID = '$supplierid' ";
      $run1 = mysqli_query($connect, $select1);
      $row1 = mysqli_fetch_array($run1);

      $supname       = $row1['SupplierName'];

      $select2 = "SELECT * FROM `staff` WHERE StaffID = '$staffid' ";
      $run2 = mysqli_query($connect, $select2);
      $row2 = mysqli_fetch_array($run2);
      
      $staffname       = $row2['staffname'];

   ?>

   <div class="invoice"> 

     
      <img width="10%;" class="inv-image" src="logo.png">

      <h1>Culture Sneaker Shop</h1>
      <hr>

      <div class="pinfo">
      <h6><b>Date : </b><?php echo "$pdate"; ?></h6>
      <h6><b>From : </b><?php echo "$supname"; ?></h6>
      <h6><b>By   : </b><?php echo "$staffname"; ?></h6>
      
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

      $select3 = "SELECT * FROM `purchasesneaker` WHERE PurchaseID = '$pid' ";
      $run3 = mysqli_query($connect, $select3);
      $count = mysqli_num_rows($run3); 

          for ($i=0; $i < $count; $i++) 
          { 

            $row3   = mysqli_fetch_array($run3);
            $snid   = $row3['SneakerID'];
            $qty    = $row3['Quantity'];
            $total  = $row3['TotalPrice'];

      $select4   = "SELECT * FROM `sneaker` WHERE SneakerID = '$snid' ";
      $run4  = mysqli_query($connect, $select4);
      $row4  = mysqli_fetch_array($run4);

      $snname       = $row4['SneakerName'];
      $price        = $row4['SellStockPrice'];

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
                 </tr> </table><br><br>


          <button class='btn-print'  onclick='window.print()'><i class='fa fa-print'></i>Print</button>
                 ";
          


            } 

           ?>



    </div>

   </div>


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
      margin: 30px auto;
     }

     .pinfo
     {
      text-align: left;
     }

     .inv-image
     {
        border-radius: 10%;             
     }


   </style>


<script type="text/javascript">
  var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>

</body>
</html>   


