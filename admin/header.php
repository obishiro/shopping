<?
include("../class/config.php");
include("../class/function.php");
include("../class/display.php");
include("../class/lang.php");
 
$StrDB= new Db_Process();
$StrDisplay = new Web_Display();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=WebName;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="<?php echo WebUrl;?>assets/js/jquery.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-transition.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-alert.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-modal.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-tab.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-popover.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-button.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-collapse.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-carousel.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-typeahead.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo WebUrl;?>assets/js/jscolor/jscolor.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/jquery.validationEngine.js" type="text/javascript"></script>
     <script src="<?php echo WebUrl;?>assets/js/lib.js"></script>
    <script src="<?php echo WebUrl;?>assets/js/bootstrap-datepicker.js"></script>
  <link href="<?php echo WebUrl;?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo WebUrl;?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo WebUrl;?>assets/css/jquery.dataTables.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo WebUrl;?>assets/js/ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" href="<?php echo WebUrl;?>assets/css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
        
    <style type="text/css">
      body {
        padding-top: 0px;
        padding-bottom: 40px;
      }
    </style>
 
 
    
    <script type="text/javascript">
    $(document).ready(function() {
  $('#TableData').dataTable( {

         "sPaginationType" : "full_numbers",
         "iDisplayLength": 25,

          /*"oLanguage": {
                    "sLengthMenu": " _MENU_ /หน้า",
                    "sZeroRecords": "ไม่มีข้อมูล",
                    "sInfo": "จาก _START_ - _END_ ของ _TOTAL_ ",
                    "sInfoEmpty": "จาก 0 - 0 ของ 0 ",
                    "sInfoFiltered": "(ทั้งหมด _MAX_ เร็คคอร์ด)",

                    "sSearch": "ค้นหา :",
                     "oPaginate": {
              "sFirst": "<<",
              "sPrevious": "<",
              "sNext":">",
              "sLast":">>"
            }  }*/} );

    
 
  
  } );
 </script>
  <script>
        $("#slideshow").craftyslide();
      </script> 
  </head>

  <body>
   <div class="header" ></div>
    <div class="navbar navbar-static-top">

      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
             
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?=WebUrl;?>admin"><?//=//WebName;?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="<?=WebUrl;?>"><i class="icon-home"></i><?=home;?></a></li>
                        <?php if(isset($_SESSION['Usr'])) {  ?>
                           <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-wrench"></i><?=ConfigShop;?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <!--<li><a href="<?=WebUrl;?>admin/index.php?action=payment"><i class="icon-envelope"></i> <?=payment;?></a></li>-->
                   <li><a href="<?=WebUrl;?>admin/index.php?action=customer"><i class="icon-user"></i> <?=customer;?></a></li>
                   <li><a href="<?=WebUrl;?>admin/index.php?action=theme"><i class="icon-picture"></i> <?=Theme;?></a></li>
                   <li><a href="<?=WebUrl;?>admin/index.php?action=configshop"><i class="icon-wrench"></i> <?=ConfigOffice;?></a></li>
               <li><a href="<?=WebUrl;?>admin/index.php?action=configweb"><i class="icon-wrench"></i> <?=ConfigWeb;?></a></li>
                </ul>
              </li>
                 <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-qrcode"></i><?=Product;?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=WebUrl;?>admin/index.php?action=category"><i class="icon-th-large"></i> <?=category;?></a></li>
                   <li><a href="<?=WebUrl;?>admin/index.php?action=product"><i class="icon-th-list"></i> <?=Product;?></a></li>
                   
                </ul>
              </li>
                  <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gift"></i><?=sell;?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=WebUrl;?>admin/index.php?action=sell"><i class="icon-shopping-cart"></i> <?=sell;?></a></li>
       
                </ul>
              </li>
              
            <li><a href="<?=WebUrl;?>admin/index.php?action=logout"   onClick="return confirm('<?=TextLogout;?>')"><i class="icon-share"></i><?=logout;?></a></li>
           
              <? } ?>
            </ul>
       
          </div><!--/.nav-collapse -->
        </div>

      </div>

    </div>
    <ul class="breadcrumb">
  <li><a href="<?php echo WebUrl;?>admin"><?=home;?></a> <span class="divider">/</span></li>
  <li>
   <?php 
   if(empty($_GET['action'])) {
 
   }else{
    $StrDisplay->List1Menu($_GET['action']); 
  }?>
   <span class="divider">/</span></li>
  <li class="active"><?php  if(isset($section)) { $StrDisplay->List2Menu($_GET['section']);} ?></li>
</ul>
