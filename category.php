<?php 
  require 'include/header.php';
  ?>
<?php 
function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    $background = imagecolorallocate($imageLayer , 0, 0, 0);
        // removing the black from the placeholder
        imagecolortransparent($imageLayer, $background);

        // turning off alpha blending (to ensure alpha channel information
        // is preserved, rather than removed (blending with the rest of the
        // image in the form of black))
        imagealphablending($imageLayer, false);

        // turning on alpha channel information saving (to ensure the full range
        // of transparency is preserved)
        imagesavealpha($imageLayer, true);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
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
<?php if(isset($_GET['edit'])) {
$sels = $con->query("select * from category where id=".$_GET['edit']."");
$sels = $sels->fetch_assoc();
?>
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Edit Shop</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="form-group">
									<label for="cname">Shop Name</label>
									<input type="text" id="cname" value="<?php echo $sels['catname'];?>" class="form-control"  name="cname" required >
								</div>

                 <div class="form-group">
                  <label for="o_name">Owner Name</label>
                  <input type="text" id="o_name" value="<?php echo $sels['owner_name'];?>" class="form-control" placeholder="Ex. Manoj Soni"  name="o_name" maxlength="20" required >
                </div>

                <div class="form-group">
                  <label for="o_phone">Owner Phone (10 Digits)</label>
                  <input type="tel" id="o_phone" value="<?php echo $sels['owner_phone'];?>" class="form-control"  placeholder="0123456789" name="o_phone" pattern="[0-9]{10}" required >
                </div>

                <div class="form-group">
                  <label for="o_email">Owner Email</label>
                  <input type="email" id="o_email" value="<?php echo $sels['owner_email'];?>" class="form-control" placeholder="example@email.com"  name="o_email" maxlength="20" required >
                </div>

								

								<div class="form-group">
									<label>Shop Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8">
								</div>
								
								<div class="form-group">
								    <img src="<?php echo $sels['catimg'];?>" class="media-object round-media"  style="height: 75px;"/>
								    </div>

								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="up_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>
							
							<?php 
							if(isset($_POST['up_cat'])){
							$cname = mysqli_real_escape_string($con,$_POST['cname']);
              $o_name = mysqli_real_escape_string($con,$_POST['o_name']);
              $o_phone = mysqli_real_escape_string($con,$_POST['o_phone']);
              $o_email = mysqli_real_escape_string($con,$_POST['o_email']);
							
							
							if(!empty($_FILES["f_up"]["name"]))
							{
							

        $fileName = $_FILES['f_up']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "cat/";
        $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
		$new_width = $sourceImageWidth;
        $new_height = $sourceImageHeight;
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_PNG:
                
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            default:
                $imageProcess = 0;
                break;
        }
        
       $url = $uploadPath."thump_".$resizeFileName.".". $fileExt;
  $con->query("update category set catname='".$cname."',catimg='".$url."' where id=".$_GET['edit']."");
 
}
else 
{
    $con->query("update category set catname='".$cname."',owner_name='".$o_name."',owner_phone='".$o_phone."',owner_email='".$o_email."' where id=".$_GET['edit']."");
}
?>
						
							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Category Update Successfully!!');
	setTimeout(function()
	{
		window.location.href="categorylist.php";
	},1500);
    
  });
  </script>
  
  <?php 
							}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</div>
<?php } else { ?>
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Add New Shop</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="form-group">
									<label for="cname">Shop Name</label>
									<input type="text" id="cname" class="form-control" placeholder="Ex. Central Super Market" name="cname" maxlength="20" required >
								</div>

                <div class="form-group">
                  <label for="o_name">Owner Name</label>
                  <input type="text" id="o_name" class="form-control" placeholder="Ex. Manoj Soni"  name="o_name" maxlength="20" required >
                </div>

                <div class="form-group">
                  <label for="o_phone">Owner Phone (10 Digits)</label>
                  <input type="tel" id="o_phone" class="form-control"  placeholder="0123456789" name="o_phone" pattern="[0-9]{10}" required >
                </div>

                <div class="form-group">
                  <label for="o_email">Owner Email</label>
                  <input type="email" id="o_email" class="form-control" placeholder="example@email.com"  name="o_email" maxlength="20" required >
                </div>

								

								<div class="form-group">
									<label>Shop Image / Logo</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8">
								</div>

								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>
							
							<?php 
							if(isset($_POST['sub_cat'])){
							$cname = mysqli_real_escape_string($con,$_POST['cname']);
              $o_name = mysqli_real_escape_string($con,$_POST['o_name']);
              $o_phone = mysqli_real_escape_string($con,$_POST['o_phone']);
              $o_email = mysqli_real_escape_string($con,$_POST['o_email']);
							
        $fileName = $_FILES['f_up']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "product/";
        $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
		$new_width = $sourceImageWidth;
        $new_height = $sourceImageHeight;
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            default:
                $imageProcess = 0;
                break;
        }
        
        $url = $uploadPath."thump_".$resizeFileName.".". $fileExt;
$con->query("insert into category(`owner_name`,`owner_phone`,`owner_email`,`catname`,`catimg`)
            values('".$o_name."','$o_phone','".$o_email."','".$cname."','".$url."')");
?>
						
							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s
    
    toastr.info('Insert Category Successfully!!!');
    
  });
  </script>
  <?php 
							}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</div>
	<?php } ?>





          </div>
        </div>

        

      </div>
    </div>
    
    <?php 
  require 'include/js.php';
  ?>
    
 
  </body>


</html>