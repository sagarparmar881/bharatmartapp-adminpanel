<?php 
  require 'include/header.php';
  ?>
  <body data-col="2-columns" class=" 2-columns ">
       <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
     <?php include('main.php'); ?>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->

<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Shops List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                    <th>Shop Name</th>
                                    <th>Owner Name</th>
                                    <th>Owner Phone</th>
                                    <th>Owner Email</th>
					   		<th>Total Categories</th>
                <th>Total Products</th>
                  <th>Total Sales INR</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sel = $con->query("select * from category");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $i= $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['catname'];?></td>
                                    <td><?php echo $row['owner_name'];?></td>
                                    <td><?php echo $row['owner_phone'];?></td>
                                    <td><?php echo $row['owner_email'];?></td>


                                    
                                    <td><?php echo $con->query("select * from subcategory where cat_id=".$row['id']."")->num_rows;?></td>
                                    <td><?php echo $con->query("select * from product where cid=".$row['id']."")->num_rows;?></td>
									<td>
                    <?php
                  
                    $result = $con->query("select * from rider where shop_id=".$row['id']."");
                  if (!$result) {
    //echo "Could not successfully run query ($sql) from DB: ";
}

if (mysqli_num_rows($result) == 0) {
    //echo "No rows found, nothing to print so am exiting";
}
$full_total = 0;
while ($rowx = mysqli_fetch_assoc($result)) {
  $temp = $rowx['id'];

    $sales  =  $con->query("select round(sum(total)) as full_total from orders where rid=$temp")->fetch_assoc();
      $full_total = $full_total + (int)$sales['full_total'];
}
echo $full_total;

?></td>
                  <td>
									<a class="primary"  href="category.php?edit=<?php echo $row['id'];?>" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>
										
									<a class="danger" href="?dele=<?php echo $row['id'];?>" data-original-title="" title="">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>
										
										</td>

                                   
                                </tr>
                               <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
if(isset($_GET['dele']))
{
$con->query("delete from category where id=".$_GET['dele']."");
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('Shop Delete successfully.');
    setTimeout(function()
	{
		window.location.href="categorylist.php";
	},1500);
  });
  </script>
  <?php
}
?>
          </div>
        </div>

      

      </div>
    </div>
    
    <?php 
  require 'include/js.php';
  ?>
    
  </body>


</html>