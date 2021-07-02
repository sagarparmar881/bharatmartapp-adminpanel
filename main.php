<?php
if(!empty($_SESSION['username']))
{

}
else 
{
?>
<script>
    window.location.href="/";
</script>
<?php 
}
?>
<script src="https://kit.fontawesome.com/d7881ffc37.js" crossorigin="anonymous"></script>
<div data-active-color="white" data-background-color="purple-bliss" data-image="" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="dashboard.php" class="logo-text float-left">
              <div class="logo-img"><img src="<?php echo $fset['logo'];?>" style="width:100%;"/></div><span class="text align-middle" style="font-size: 16px;
    padding: 7px;"></span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
  <li><a href="dashboard.php"><i class="fas fa-desktop"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
              </li>
              
<li class="has-sub nav-item"><a href="#"><i class="fas fa-store"></i><span data-i18n="" class="menu-title">Shops </span></a>
                <ul class="menu-content">
                  <li><a href="category.php" class="menu-item active">Add Shop</a>
                  </li>
                  <li><a href="categorylist.php" class="menu-item">Shops List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
        
        <li class="has-sub nav-item"><a href="#"><i class="fas fa-list"></i><span data-i18n="" class="menu-title">Categories</span></a>
                <ul class="menu-content">
                  <li><a href="subcategory.php" class="menu-item active">Add Category</a>
                  </li>
                  <li><a href="subcategorylist.php" class="menu-item">Category List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
              <li class="has-sub nav-item"><a href="#"><i class="fas fa-cube"></i><span data-i18n="" class="menu-title">Products</span></a>
                <ul class="menu-content">
                  <li><a href="product.php" class="menu-item">Add Product</a>
                  </li>
                  <li><a href="productlist.php" class="menu-item">Product List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
              
               <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-gift"></i><span data-i18n="" class="menu-title">Coupon</span></a>
                <ul class="menu-content">
                  <li><a href="coupon.php" class="menu-item">Add Coupon</a>
                  </li>
                  <li><a href="couponlist.php" class="menu-item">Coupon List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
              
               <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-location-arrow"></i><span data-i18n="" class="menu-title">Area</span></a>
                <ul class="menu-content">
                  <li><a href="area.php" class="menu-item">Add Area</a>
                  </li>
                  <li><a href="alist.php" class="menu-item">Area List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
        
        
        <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-clock"></i><span data-i18n="" class="menu-title">Timeslot</span></a>
                <ul class="menu-content">
                  <li><a href="timesloat.php" class="menu-item">Add Timeslot</a>
                  </li>
                  <li><a href="tlist.php" class="menu-item">Timeslot List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
              
        
               <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-motorcycle"></i><span data-i18n="" class="menu-title">Delivery Boy</span></a>
                <ul class="menu-content">
                  <li><a href="add_rider.php" class="menu-item active">Add Delivery Boy</a>
                  </li>
                  <li><a href="riderlist.php" class="menu-item">Delivery Boy List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
			  
			  
			  
			 
         <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-image"></i><span data-i18n="" class="menu-title">Banner</span></a>
                <ul class="menu-content">
                  <li><a href="banner.php" class="menu-item">Add Banner</a>
                  </li>
                  <li><a href="bannerlist.php" class="menu-item">Banner List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
 
              
              
              <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-copy"></i><span data-i18n="" class="menu-title">Home Section</span></a>
                <ul class="menu-content">
                  <li><a href="home_section.php" class="menu-item">Add Section</a>
                  </li>
                  <li><a href="home_section_list.php" class="menu-item">Section List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>
              
              
             
       
        
         <li class="has-sub nav-item" id="hide-x"><a href="#"><i class="fas fa-bell"></i><span data-i18n="" class="menu-title">Notification</span></a>
                <ul class="menu-content">
                  <li><a href="template.php" class="menu-item">Add Notification</a>
                  </li>
                  <li><a href="templatelist.php" class="menu-item">Notification List</a>
                  </li>
                 
                    </ul>
                  
                
              </li>

             
         
        <li><a href="user.php"><i class="fas fa-users"></i><span data-i18n="" class="menu-title"> Customer</span></a> </li>
        <li><a href="order.php"><i class="fas fa-shopping-cart"></i><span data-i18n="" class="menu-title"> Pending Order</span></a></li>
        <li><a href="orders.php"><i class="fas fa-check-circle"></i><span data-i18n="" class="menu-title"> Complete Order</span></a></li>
        <li id="hide-x"><a href="orderrate.php"><i class="fas fa-flag"></i><span data-i18n="" class="menu-title"> Customer Rating</span></a></li>
              <li id="hide-x"><a href="feed.php"><i class="fas fa-star"></i><span data-i18n="" class="menu-title" > Feedback</span></a>
              </li>
               
                
             
              
			   <li id="hide-x"><a href="payment_list.php"><i class="fas fa-money"></i><span data-i18n="" class="menu-title">Payment  List</span></a></li>
			  <li><a href="profile.php"><i class="fas fa-user"></i><span data-i18n="" class="menu-title">Profile</span></a></li>
        <li><a href="setting.php"><i class="fas fa-cogs"></i><span data-i18n="" class="menu-title">Settings</span></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      </div>
      <!-- / main menu-->
      <script src="app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script type="text/javascript">
    var id_count = $('[id=hide-x]');
            if (id_count .length > 0){
                //$('[id=hide-x]').remove();
            }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

      <!-- Navbar (Header) Starts-->
      <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>
            
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">fullscreen</p></a></li>

               
                <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right"><a href="logout.php" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                  </div>
                </li>
              
              </ul>
            </div>
          </div>
        </div>
      </nav>