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

$rank = "SELECT rank FROM users WHERE username = '".$_SESSION["username"]."'";
if($result = mysqli_query($db, $rank)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if ($row["rank"] != 2){
                setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                $stmt = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $comment, $heure, $rank, $status);
                $comment = $_SESSION["username"]." a tenté d'accéder à la page user-edit.";
                $heure = strftime('%d %B %Y à %H:%M',strtotime("+6 hours")); 
                $rank = "2";
                $status = "error";
                $stmt->execute();
                $stmt->close();
                die("Accès non autorisé. Les administrateurs ont été averti de votre présence sur une page dont vous ne disposez pas l'accès.");
            }
         }
    }
}


if(!isset($_GET["userid"])){
	die(header("location:dashboard.php"));
}

$iduser = $_GET["userid"];

if(isset($_POST["confirmedit"])){
  if (!empty($_POST["usernamec"] and $_POST["ipv"] and $_POST["ranke"])){
  if ($_POST["ranke"] == "Administrateur") {
    $rankchange = 2;
  }elseif ($_POST["ranke"] == "Membre") {
    $rankchange = 1;
  }else{
    $rankchange = 1;
    $_POST['error'] = 'Grade inéxistant. Grade membre attribué par défaut.';
  }
  if ($_POST["steamlink"] == "") {
    $steamll = "no";
  }else{
    $steamll = $_POST["steamlink"];
  }
    $stmt = $db->prepare("UPDATE users SET username = ?, steam = ?, ipvalidate = ?, rank = ?, token = ?, backdoor = ? WHERE id = '". $iduser ."'");
    $stmt->bind_param("ssssss", $username, $steam, $ipvalidate, $rank, $token, $backdoor);
    $username = htmlspecialchars($_POST["usernamec"]);
    $steam = htmlspecialchars($steamll);
    $ipvalidate = htmlspecialchars($_POST["ipv"]);
    $token = htmlspecialchars($_POST["token"]);
    $backdoor = htmlspecialchars($_POST["backdoor"]);
    $rank = $rankchange;
  if(mysqli_stmt_execute($stmt)){

  $stmt->close();
  setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
  $stmtl = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
  $stmtl->bind_param("ssss", $comment, $heure, $rank, $status);
  $comment = "Utilisateur édité : ".$_POST["usernamec"]." par ".$_SESSION["username"].".";
  $heure = strftime('%d %B %Y à %H:%M',strtotime("+6 hours")); 
  $rank = "2";
  $status = "warning";
  $stmtl->execute();
  $stmtl->close();
  $_POST['success'] = 'Utilisateur édité avec succès.';
  }else{
  $_POST['error'] = 'Une erreur est survenue. Contactez un administrateur.';
  }
  }else{
  $_POST['error'] = 'Un des champs est manquant.';
  }
}

if(isset($_POST["ban"])){
   $stmt = $db->prepare("UPDATE users SET ban = ? WHERE id = '". $iduser ."'");
   $stmt->bind_param("s", $ban);
    $ban = '1';
  if(mysqli_stmt_execute($stmt)){
    
  $_POST['success'] = 'Utilisateur banni avec succès.';
  $stmt->close();
  }else{
  $_POST['error'] = 'Une erreur est survenue. Contactez un administrateur.';
  }
}

if(isset($_POST["deban"])){
 $stmt = $db->prepare("UPDATE users SET ban = ? WHERE id = '". $iduser ."'");
   $stmt->bind_param("s", $ban);
    $ban = '0';
  if(mysqli_stmt_execute($stmt)){
    
  $_POST['success'] = 'Utilisateur dé-banni avec succès.';
  $stmt->close();
  }else{
  $_POST['error'] = 'Une erreur est survenue. Contactez un administrateur.';
  }
}

$sql = "SELECT * FROM users WHERE id = $iduser";
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
    Administration utilisateur
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
  <?php
  if(isset($_POST["mdpchange"])){
  $passwordc = mysqli_real_escape_string($db, $_POST["mdpchange"]);  
  $passwordc = password_hash($passwordc, PASSWORD_DEFAULT);  
  $mdpsql = "UPDATE users SET password='". $passwordc ."' WHERE id = '". $_GET['userid'] ."'";
  if (mysqli_query($db, $mdpsql)) {
    $_POST['success'] = 'Mot de passe édité avec succès.';
} else {
    echo "Error : " . $db->error;
}
} ?>
  <div class="wrapper ">
<?php include "includes/side.php"; ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include "includes/nav.php"; ?>
      <!-- End Navbar -->
       <div class="content">
        <div class="container-fluid">
<!-- MODAL -->
<div class="modal fade center" id="mdpmodif" tabindex="-1" role="dialog" aria-labelledby="modal"
  aria-hidden="true">

      <!--Body-->


<div class="col-md-5">
  <form method="POST">
              <div class="card card-profile modal-body">
                <div class="card-body">
                  <h4 class="card-title">Modification du mot de passe</h4>
                  <p class="card-description">
                  </p>
                  <div class="col-md-13">
                        <div class="form-group">
                          <label class="bmd-label-floating"></label>
                          <input name="mdpchange" type="password" class="form-control">
                        </div>
                      </div>
                  <a href="user-edit.php?userid=<?php echo $row['id']; ?>" class="btn btn-danger btn-round">Annuler</a>
                  <button type="submit" class="btn btn-success btn-round">Sauvegarder</button>
                </div>
              </div>
</form>
      </div>

      <!--Footer-->
</div>
                    <!-- FIN MODAL -->
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Contrôle utilisateur</h4>
                  <p class="card-category">Editer le profil</p>
                </div>
                <div class="card-body">
                  <form method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom d'utilisateur</label>
                          <input type="text" name="usernamec" class="form-control" value="<?php echo $row["username"]; ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Lien steam</label>
                          <input class="form-control" name="steamlink" value="<?php echo $row["steam"]; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Rang</label>
                          <input type="text" class="form-control" name="ranke" value="<?php if ($row['rank'] == 1){
                                      echo "Membre";
                                    }
                                    if ($row["rank"] == 2){
                                      echo "Administrateur";
                                    } ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Adresse IP validée</label>
                          <input type="text" class="form-control" name="ipv" value="<?php echo $row["ipvalidate"]; ?>">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Server Token</label>
                          <input type="text" class="form-control" name="token" value="<?php echo $row["token"]; ?>">
                        </div>
                      </div>
                       <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom de la backdoor (.zip) - 0 = désactivation</label>
                          <input type="text" class="form-control" name="backdoor" value="<?php echo $row["backdoor"]; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Rang disponible : Administrateur - Membre</label>
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="confirmedit" class="btn btn-success pull-right"><i class="fas fa-check"></i>  Sauvegarder</button>
                    <button type="button"  data-toggle="modal" data-target="#mdpmodif" class="btn btn-warning pull-right"><i class="fas fa-key"></i>  Modifier le mot de passe</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <form method="POST">
              <div class="card card-profile">
                <div class="card-avatar">
                    <img class="img" src="<?php echo $row["img"]; ?>" />
                </div>
                <div class="card-body">
                  <h6 class="card-category"><?php if ($row['rank'] == 1){
                                      echo "Membre";
                                    }
                                    if ($row["rank"] == 2){
                                      echo "Administrateur";
                                    } ?></h6>

                  <h4 class="card-title"><?php echo $row["username"]; ?></h4>
                  <p class="card-description">
                    Adresse IP validée : <?php echo $row["ipvalidate"]; ?>
                  </p>
                  <?php if ($row['steam'] == "no"){
                                      ?>
                                      <button class="btn btn-dark btn-round" disabled><i class="fab fa-steam"></i>  Steam</button>
                                    <?
                                    }else{
                                      ?> <button onClick="window.open('<?php echo $row['steam']; ?>');" class="btn btn-dark btn-round"><i class="fab fa-steam"></i>  Steam</button>
                                    <? }?>
                  <?php if ($row['ban'] == 1){
                                      ?>
                                      <button type="submit" name="deban" class="btn btn-warning btn-round"><i class="fas fa-ban"></i>  Dé-bannir</button>
                                    <?
                                    }else{
                                      ?> <button type="submit" name="ban" class="btn btn-danger btn-round"><i class="fas fa-ban"></i>  Bannir</button>
                                    <? }?>
                </div>
              </form>
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