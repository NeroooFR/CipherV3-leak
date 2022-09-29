<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

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


if(!isset($_GET["payload"])){
	die(header("location:dashboard.php"));
}


$idpay = $_GET["payload"];

if(isset($_POST["editpayload"])){
  if (!empty($_POST["nompay"] and $_POST["cate"] and $_POST["contenup"])){
    $sqld = "SELECT * FROM payloadscate WHERE name = '".$_POST["cate"]."'";
    if($resultd = mysqli_query($db, $sqld)){
      if(mysqli_num_rows($resultd) > 0){
        $stmt = $db->prepare("UPDATE payloads SET name = ?, category = ?, content = ? WHERE id = '". $idpay ."'");
        $stmt->bind_param("sss", $name, $category, $content);
        $name = htmlspecialchars($_POST["nompay"]);
        $category = htmlspecialchars($_POST["cate"]);
        $content = $_POST["contenup"];

  if(mysqli_stmt_execute($stmt)){
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
        $stmtl = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
        $stmtl->bind_param("ssss", $comment, $heure, $rank, $status);
        $comment = "Payload édité : ".$_POST["cate"]." par : ".$_SESSION["username"].".";
        $heure = strftime('%d %B %Y à %H:%M',strtotime("+6 hours")); 
        $rank = "1";
        $status = "warning";
        $stmtl->execute();
        $stmtl->close();
  $_POST['success'] = 'Payload édité avec succès.';
  $stmt->close();
  }else{
  $_POST['error'] = 'Une erreur est survenue. Contactez un administrateur.';
  }
  }else{
  $_POST['error'] = 'Catégorie inéxistante.';
  }
  }else{
  $_POST['error'] = 'Une erreur est survenue. Contactez un administrateur.';
  }
  }else{
  $_POST['error'] = 'Un des champs est manquant.';
  }
}

if(isset($_POST["deletepayload"])){
  $stmt = $db->prepare("DELETE FROM payloads WHERE id = ?");
  $stmt->bind_param("s", $id);
  $id = $idpay;
  if(mysqli_stmt_execute($stmt)){
  $stmt->close();
  header("Location: payloads.php"); 
  }else{
  $_POST['error'] = 'Une erreur est survenue. Contactez un administrateur.';
  }
}

$getaccess = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."'";
if($result = mysqli_query($db, $getaccess)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          if ($row["rank"] == 2){
          }else{
            $ifaccess = "SELECT token FROM payloads WHERE token = '".$row["token"]."' AND  id = $idpay";
              if($resultd = mysqli_query($db, $ifaccess)){
                 if(mysqli_num_rows($resultd) > 0){
              }else{
                setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                $stmt = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $comment, $heure, $rank, $status);
                $comment = $_SESSION["username"]." a tenté d'accéder à un payload dont il ne disposait pas l'accès.";
                $heure = strftime('%d %B %Y à %H:%M',strtotime("+6 hours")); 
                $rank = "2";
                $status = "error";
                $stmt->execute();
                $stmt->close();
                die("Bien essayé, les administrateurs ont été prévenu de votre présence sur une page dont vous ne disposez pas l'accès.");
              }
            }
          }
        }
    }
}

$idp = $db->real_escape_string($idpay);

$check = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."'";
if($resultc = mysqli_query($db, $check)){
 if(mysqli_num_rows($resultc) > 0){
  while($rowa = mysqli_fetch_array($resultc)){
    if($rowa["rank"] == 1){
      $sql = "SELECT * FROM payloads WHERE id = $idp AND token = '".$rowa["token"]."'";
    }else{
      $sql = "SELECT * FROM payloads WHERE id = $idp";
    }
  if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Modification payload
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
      <?php include "includes/nav.php"; ?>
      <!-- End Navbar -->
       <div class="content">
        <div class="container-fluid">
                    <!-- FIN MODAL -->

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Payload</h4>
                  <p class="card-category">Editer le payload</p>
                </div>
                <div class="card-body">
                  <form method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom du payload</label>
                          <input type="text" class="form-control" name="nompay" value="<? echo $row["name"]; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Catégorie</label>
                          <input type="text" class="form-control" name="cate" value="<? echo $row["category"]; ?>">
                        </div>
                      </div>
                      </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="form-group">
                            <label class="bmd-label-floating">Contenu</label>
                            <textarea class="form-control" rows="20" name="contenup"><? echo $row["content"]; ?></textarea>
                          </div>
                        </div>
                        <label>Catégorie disponible : <?php
                        $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                          if($resultc = mysqli_query($db, $check)){
                              if(mysqli_num_rows($resultc) > 0){
                                while($rowa = mysqli_fetch_array($resultc)){
                        if ($rowa["rank"] == 1){
                          $catall = "SELECT * FROM payloadscate WHERE token = '".$rowa["token"]."'";
                        }else{
                          $catall = "SELECT * FROM payloadscate";
                        }
                        if($resultcat = mysqli_query($db, $catall)){
                                if(mysqli_num_rows($resultcat) > 0){
                                    while($row = mysqli_fetch_array($resultcat)){ 
                               echo " - ".$row["name"]; 
                           }
                       }else{
                        echo "Aucune catégorie n'a été crée";
                       }
                   }else{
                    $_POST["error"] =  "Erreur lors du chargement de la page";
                   }
                   }
                   }
                   } ?></label>
                      </div>
                    </div>
                    <button type="submit" name="editpayload" class="btn btn-success pull-right"><i class="fas fa-check"></i>  Sauvegarder</button>
                    <button type="submit" name="deletepayload" class="btn btn-danger pull-right"><i class="fas fa-trash"></i>  Supprimer</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
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
}
}else{
  echo"Une erreur est survenue";
}
}else{
  echo"Une erreur est survenue";
}
}
}
}