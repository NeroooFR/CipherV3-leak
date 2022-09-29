<?php 
$errormess = false;
$errorpseudo = false;

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include 'inc/eldb.php';
    	
	$secret = "6LfPQbYUAAAAAMGQ38VunyUleDINuvupeIQ9bvLP";
	$response = $_POST['g-recaptcha-response'];
	$remoteip = $_SERVER['REMOTE_ADDR'];

	$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
	    . $secret
	    . "&response=" . $response
	    . "&remoteip=" . $remoteip ;
	
	$decode = json_decode(file_get_contents($api_url), true);
if (isset($_POST["usern"]) and ($_POST["pwd"]) and ($_POST["email"]) and ($_POST["steamid"])){
	if ($decode['success'] == true) {
			$noxploit = $db->real_escape_string($_POST["usern"]);
			 $sqls = "SELECT * FROM users WHERE uname = '$noxploit'";
				if($results = mysqli_query($db, $sqls)){
    				if(mysqli_num_rows($results) > 0){
    					$errorpseudo = true;
    				}else{
		$to = generateRandomString(5);
		$passwordrl = mysqli_real_escape_string($db, $_POST["pwd"]);  
	    $passwordrl = password_hash($passwordrl, PASSWORD_DEFAULT);
	    $stmt = $db->prepare("INSERT INTO users (uname, password, email, steamid, token, ip) VALUES (?, ?, ?, ?, ?, ?)");
	    $stmt->bind_param("ssssss", $uname, $password, $email, $steamid, $token, $ip);
	    $uname = htmlspecialchars($_POST["usern"]);
	    $password = $passwordrl;
	    $steamid = htmlspecialchars($_POST["steamid"]);
	    $email = htmlspecialchars($_POST["email"]);
	    $token = $to;
      $ip = $_SERVER['REMOTE_ADDR'];
	    if(mysqli_stmt_execute($stmt)){
	    	header("location: register.php?success=true&usr=".htmlentities($_POST["usern"])."&to=".htmlentities($to));
    		$stmt->close();
    	  }else{
    		echo "Echec lors de l'exécution : (" . $stmt->errno . ") " . $stmt->error;
 		 }
 	}
	}else{echo("Error description: " . mysqli_error($db)); }
	}
	else {
		$errormess = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- Cipher Panel - Author : exit - Free Access Version -->
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Inscription
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.minf066.css?v=2.1.0" rel="stylesheet" />
  <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.minf066.js" type="text/javascript"></script>
</head> <?
if (isset($_GET["success"]) and ($_GET["to"]) and ($_GET["usr"])){
		$getusr = $db->real_escape_string($_GET["to"]);
			$checksuc = "SELECT uname FROM users WHERE token = '$getusr'";
				if($result = mysqli_query($db, $checksuc)){
				    if(mysqli_num_rows($result) > 0){
				        while($row = mysqli_fetch_array($result)){
				            if ($row["ipvalidate"] != $ip){
				                die(header("location:oh!.php"));
				            }
				        }
				    }else{
				    	die('Erreur dans la matrice.');
				    }
				}else{
				   	die('Erreur dans la matrice.');
				} 
?>
	       <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
              <div class="page-categories">
                <h3 class="title text-center">Votre compte a été crée avec succès</h3>
                <br />
                <ul class="nav nav-pills nav-pills-success nav-pills-icons justify-content-center" role="tablist">
                  
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" role="tablist">
                      <i class="material-icons">check</i>
                    </a>
                  </li>
                </ul>
                <div class="tab-content tab-space tab-subcategories">
                  <div class="tab-pane active" id="link8">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Attention</h4>
                      </div>
                      <div class="card-body">
                        Votre compte est en attente d'activation par un administrateur.
                        <br>
                        <br> Les double compte ne sont pas autorisés et entraîneront un refus immédiat.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<? }else{ ?>
<body class="off-canvas-sidebar">
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo">Inscription</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="shop.php" class="nav-link">
              <i class="material-icons">shopping_cart</i> Boutique
            </a>
          </li>
          <li class="nav-item  active ">
            <a href="register.php" class="nav-link">
              <i class="material-icons">person_add</i> Inscription
            </a>
          </li>
          <li class="nav-item ">
            <a href="login.php" class="nav-link">
              <i class="material-icons">fingerprint</i> Connexion
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper wrapper-full-page">
    <div class="page-header register-page header-filter" filter-color="black" style="background-image: url('assets/img/register.png')">
      <div class="container">
        <div class="row">
          <div class="col-md-10 ml-auto mr-auto">
            <div class="card card-signup">
              <h2 class="card-title text-center">Inscription</h2>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5 ml-auto">
                    <div class="info info-horizontal">
                      <div class="icon icon-danger">
                        <i class="material-icons">bug_report</i>
                      </div>
                      <div class="description">
                        <h4 class="info-title">Infection</h4>
                        <p class="description">
                          L'infection des serveurs est optimisé au maximum. Vous pourrez contrôler les serveurs comme si vous en étiez le propriétaire.
                        </p>
                      </div>
                    </div>
                    <div class="info info-horizontal">
                      <div class="icon icon-danger">
                        <i class="material-icons">code</i>
                      </div>
                      <div class="description">
                        <h4 class="info-title">Payloads</h4>
                        <p class="description">
                          Créez vos payloads personnalisé pour les injecter sur un serveur de votre choix.
                        </p>
                      </div>
                    </div>
                    <div class="info info-horizontal">
                      <div class="icon icon-warning">
                        <i class="material-icons">star</i>
                      </div>
                      <div class="description">
                        <h4 class="info-title">Premium</h4>
                        <p class="description">
                          Profitez d'une expérience en illimitée grâce à notre formule premium qui vous permettra d'accéder à une base de donnée d'utilisateurs, à un chat en direct et bien d'autres.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 mr-auto">
                    <form class="form" method="POST">
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">person</i>
                            </span>
                          </div>
                          <input name="usern" type="text" class="form-control" placeholder="Nom d'utilisateur" required>
                        </div>
                      </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">mail</i>
                            </span>
                          </div>
                          <input type="email" class="form-control" name="email" placeholder="Adresse mail" required>
                        </div>
                      </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">vpn_key</i>
                            </span>
                          </div>
                          <input type="number" class="form-control" name="steamid" placeholder="SteamID64*" required>
                        </div>
                      </div>
                      <div class="form-group has-default">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="material-icons">lock_outline</i>
                            </span>
                          </div>
                          <input type="password" name="pwd" placeholder="Mot de passe" class="form-control" required>
                        </div>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" name="elreglos" type="checkbox" value="" required>
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                          Je suis d'accord avec
                          <a href="#something">les règles d'utilisation</a>.
                        </label>
                        <div class="g-recaptcha" 
          			data-sitekey="6LfPQbYUAAAAABmiOr45MQxrnryBAuyBsYu5RVJw">
          			  </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-round mt-4">S'inscrire</button>
                      </div>
                    </form>
                    <i>*Le SteamID64 peut ce trouver<a target="_blank" href="https://steamid.xyz"> ici</a></i>
                    <? if ($errormess == true){ ?>
                    	<label class="text-danger">Le captcha n'a pas été complété.</label> <?
                    } ?>
                    <? if ($errorpseudo == true){ ?>
                    	<label class="text-danger">Le nom d'utilisateur est déjà pris.</label> <?
                    } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, <i>Cipher Panel™</i> by
            <a href="https://discord.gg/sSxUDnP" target="_blank">exit#9775</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="buttons.github.io/buttons.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
    <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>

  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

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
<!-- Cipher Panel - Author : exit - Free Access Version -->
</html>
<? } ?>