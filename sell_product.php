<?php
session_start();
//check if user loggedin
if(empty($_SESSION['username123']))
{
  header("Location: index.php");
}
else
{
  include("database.php");
  if(isset($_GET['msg']) && $_GET['msg']!="")
    $msg = $_GET['msg'];
  //if deleted massage passed==1 then show success message
  if(isset($msg) == 1)
  {
    $message1 = "Successfully Sold the Item";
    $f=1;
  }
  //if deleted massage passed==2 then show error message
  else if(isset($msg) == 2)
  {
    $message2 = "Failed to Sell. Try Again Later.";
    $f=2;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" /-->
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="dashboard.php">Project</a>
          <?php include('menu.php');?>
        </div>
      </div>
    </div>

    <div class="container">
       <?php
      //show success div
        if(isset($f)==1)
        {
          ?>
          <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $message1; ?></strong> 
        </div>
<?php
        }
        //show error div
        else if(isset($f)==2)
        {
          ?>
          <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $message2; ?></strong> 
        </div>
<?php
        }
      ?>
     <!-- Example row of columns -->
     <div class="row">
        <h1>Search and Sell Product</h1>
         <form action="" method="post">
        <div class="span4">
          <label>Product Category</label>
            <div class="input-group">
            <select class="form-control span4" name="category" id="source">
              <option value="">Select a Category</option>
                  <?php 
                  $res_qual=mysql_query("select * from category");
                      while($row_qual=mysql_fetch_assoc($res_qual))
                      {
                  ?>
                      <option value="<?php echo $row_qual['cat_id'];?>"><?php echo $row_qual['cat_title'];?></option>
                  <?php
                      }
                  ?>
                </select>
            </div>
        </div>
         <div class="span4">
            <label>Product</label>
            <div class="input-group">
                <input type="text" class="span4" name="product" placeholder="Search by...">
                </div>
        </div>
        <div class="span4">
          <div class="input-group" style="margin-top:25px;">
           <button type="submit" class="btn" name="save">Search</button>
         </div>
        </div>
       </form>              
     </div>
          
      <div class="row">
        <!--h1>List Product</h1-->
                <form action="" method="post">
                  
        <div class="span12">
            <table class="table table-bordered table-striped">
              <thead><tr><th width="140">Sl. Number</th><th>Category</th><th>Product</th><th>Price</th><th>Description</th><th width="100">Sell Item</th><tr>
                </thead>
                <tbody>
                <?php
                //works if search button is clicked then match category and product title
                if(isset($_POST['save'])=='Search')
                {
                     include("database.php");
                      $search_category=$_POST['category'];
                      $search_product=$_POST['product'];
                      // query to test if any one field matches the table values.
                      $query = "select * from  product where 
                      case when cat_id like '$search_category%' then 1 else 0 end+
                      case when sold like '0' then 1 else 0 end+
                      case when prod_title like '$search_product%' then 1 else 0 end>=3";
                      $res_port = mysql_query($query);
                      if ($res_port) {
                          $c=1;
                           $totalprice=0;
                         while ($row_port = mysql_fetch_array($res_port)) {
                          //display the table value 
                          $prod_title=$row_port['prod_title'];
                          $price=$row_port['price'];
                          $description=$row_port['description'];
                          $prod_id=$row_port['prod_id'];
                          $cat_id=$row_port['cat_id'];
                          $query1=mysql_query("select * from category where cat_id='$cat_id'");
                          $result1=mysql_fetch_array($query1);
                          $cat_title=$result1['cat_title'];
                          echo '<tr >';
                          echo '<td >'. $c . '</td>';
                          echo '<td class=" ">'. $cat_title. '</td>';
                          echo '<td class=" ">'. $prod_title. '</td>';
                          echo '<td class=" ">'. $price. '</td>';
                          echo '<td class=" ">'. $description. '</td>';
                          echo '<td class=" ">
                          <a href="sold_prod.php?id='.$prod_id.'"><i class="icon-minus-sign"></i></a></td>';
                          echo '</tr>';
                          $c++;
                          $totalprice=$totalprice+$price;
                           }
                         }
                          ?>
                        </tbody>
                   <tfoot><?php
                   //show total item or total price
                   echo "<tr><td colspan='6'>Total Item=".--$c."</td></tr>";
                   echo "<tr><td colspan='6'>Total Price=".$totalprice."</td></tr>";
                   ?>
                 </tfoot>
                 <?php
                } 
                //show all products
                else
                {
                   include("database.php");
                $query = "select * from  product where sold='0'";
                $res_port = mysql_query($query);
                if ($res_port) {
                    $c=1;
                    $totalprice=0;
                   while ($row_port = mysql_fetch_array($res_port)) {
                    $prod_title=$row_port['prod_title'];
                    $price=$row_port['price'];
                    $description=$row_port['description'];
                    $prod_id=$row_port['prod_id'];
                    $cat_id=$row_port['cat_id'];
                    $query1=mysql_query("select * from category where cat_id='$cat_id'");
                    $result1=mysql_fetch_array($query1);
                    $cat_title=$result1['cat_title'];
                    echo '<tr >';
                    echo '<td >'. $c . '</td>';
                    echo '<td class=" ">'. $cat_title. '</td>';
                    echo '<td class=" ">'. $prod_title. '</td>';
                    echo '<td class=" ">'. $price. '</td>';
                    echo '<td class=" ">'. $description. '</td>';
                    echo '<td class=" ">
                    <a href="sold_prod.php?id='.$prod_id.'"><i class="icon-minus-sign"></i></a></td>';
                    echo '</tr>';
                    $c++;
                     $totalprice=$totalprice+$price;
                     }
                   }
                   ?>
                 </tbody>
                   <tfoot><?php
                   //show total price & total item
                   echo "<tr><td colspan='6'>Total Item=".--$c."</td></tr>";
                   echo "<tr><td colspan='6'>Total Price=".$totalprice."</td></tr>";
                   ?>
                 </tfoot>
                 <?php
                }                  
                
                ?>
                              
            </table>       
        
         </form>
      </div>

      <hr>

      <?php include('footer.php');?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script type="text/javascript" src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/moment-2.4.0.js"></script>
   
     <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
     
  </body>
</html>
<?php
}
?>