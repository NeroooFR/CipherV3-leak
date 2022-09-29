 <?php  
$errorpost = false;
$errmessage = false;
$errorpwd = false;
include "inc/eldb.php";
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
      header("location:dashboard/dashboard.php");  
 }   

$secret = "6LfPQbYUAAAAAMGQ38VunyUleDINuvupeIQ9bvLP";
$response = $_POST['g-recaptcha-response'];
$remoteip = $_SERVER['REMOTE_ADDR'];

$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
    . $secret
    . "&response=" . $response
    . "&remoteip=" . $remoteip ;
  
$decode = json_decode(file_get_contents($api_url), true);

 if(isset($_POST["login"]))  
 {  
    if ($decode['success'] == true) {
      if(empty($_POST["usern"]) || empty($_POST["motdp"]))  
      {  
           $errorpost = true;
      }  
      else  
      {  
           $username = mysqli_real_escape_string($db, $_POST["usern"]);  
           $password = mysqli_real_escape_string($db, $_POST["motdp"]);  
           $query = "SELECT * FROM users WHERE uname = '$username'";  
           $result = mysqli_query($db, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                while($row = mysqli_fetch_array($result))  
                {  
                     if(password_verify($password, $row["password"]))  
                     {  
                          //return true;  
                          $_SESSION["username"] = $username;  
                          header("location: dashboard/dashboard.php");  
                          setlocale (LC_TIME, 'fr_FR.utf8','fra');
                          $date = strftime('%d %B %Y à %H:%M',strtotime("+6 hours"));
                          $stmt = $db->prepare("UPDATE users SET lastcon = ?, lastip = ? WHERE uname = ? ");
                          $stmt->bind_param("sss", $lastcon, $lastip, $uname);
                          $uname = $username;
                          $lastcon = $date;
                          $lastip = $_SERVER['REMOTE_ADDR'];
                          $stmt->execute();
                          $stmt->close();
                     }  
                     else  
                     {  /*setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                        $stmtl = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
                        $stmtl->bind_param("ssss", $comment, $heure, $rank, $status);
                        $comment = "Tentative de connexion échouée avec un bon utilisateur : ".$_POST["usern"].".";
                        $heure = strftime('%d %B %Y à %H:%M',strtotime("+6 hours")); 
                        $rank = "2";
                        $status = "error";
                        $stmtl->execute();
                        $stmtl->close();*/
                          $errorpwd = true;
                     }  
                }  
           }  
           else  
           {  
            /*setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                        $stmtl = $db->prepare("INSERT INTO logs (comment, heure, rank, status) VALUES (?, ?, ?, ?)");
                        $stmtl->bind_param("ssss", $comment, $heure, $rank, $status);
                        $comment = "Tentative de connexion échouée : ".$_POST["usern"].".";
                        $heure = strftime('%d %B %Y à %H:%M',strtotime("+6 hours")); 
                        $rank = "2";
                        $status = "warning";
                        $stmtl->execute();
                        $stmtl->close();*/
              $errorusr = true;
           }  
      }  
 }else{
  $errmessage = true;
}
}?> 

<!DOCTYPE html>
<html lang="en">


<!-- Cipher Panel - Author : exit - Free Access Version -->
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Connexion
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.minf066.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="off-canvas-sidebar">
 <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="#pablo">Connexion</a>
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
          <li class="nav-item ">
            <a href="register.php" class="nav-link">
              <i class="material-icons">person_add</i> Inscription
            </a>
          </li>
          <li class="nav-item  active">
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
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('assets/img/wplog.png'); background-size: cover; background-position: top center;">
      <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="POST">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-danger text-center">
                  <h4 class="card-title">Connexion</h4>
                </div>
                <div class="card-body ">
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">face</i>
                        </span>
                      </div>
                      <input type="text" name="usern" class="form-control" placeholder="Nom d'utilisateur">
                    </div>
                  </span>
                  <span class="bmd-form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" name="motdp" class="form-control" placeholder="Mot de passe">
                    </div>
                  </span>
                </div>
                 <div class="card-footer justify-content-center">
                <? if ($errorpost == true){ ?>
                      <label class="text-danger">Tous les champs sont requis.</label> <?
                    } ?>
                    <? if ($errmessage == true){ ?>
                      <label class="text-danger">Le captcha n'a pas été complété.</label> <?
                    } ?>
                    <? if ($errorpwd == true){ ?>
                      <label class="text-danger">Mot de passe invalide.</label> <?
                    } ?>
                    <? if ($errorusr == true){ ?>
                      <label class="text-danger">Utilisateur introuvable.</label> <?
                    } ?>
                              </div>
                <div class="card-footer justify-content-center">
                  <div class="g-recaptcha" 
                data-sitekey="6LfPQbYUAAAAABmiOr45MQxrnryBAuyBsYu5RVJw">
                </div>
              </div>
              <div class="card-footer justify-content-center">
                  <button type="submit" name="login" class="btn btn-success btn-link btn-lg"><i class="material-icons">check</i></button>
                </div>
              </div>
            </form>
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
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.minf066.js?v=2.1.0" type="text/javascript"></script>
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
  <!-- Sharrre libray -->
  <script src="assets/demo/jquery.sharrre.js"></script>
  <script>
    $(document).ready(function() {


      $('#facebook').sharrre({
        share: {
          facebook: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('facebook');
        },
        template: '<i class="fab fa-facebook-f"></i> Facebook',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      $('#google').sharrre({
        share: {
          googlePlus: true
        },
        enableCounter: false,
        enableHover: false,
        enableTracking: true,
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('googlePlus');
        },
        template: '<i class="fab fa-google-plus"></i> Google',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      $('#twitter').sharrre({
        share: {
          twitter: true
        },
        enableHover: false,
        enableTracking: false,
        enableCounter: false,
        buttons: {
          twitter: {
            via: 'CreativeTim'
          }
        },
        click: function(api, options) {
          api.simulateClick();
          api.openPopup('twitter');
        },
        template: '<i class="fab fa-twitter"></i> Twitter',
        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
      });

      // Facebook Pixel Code Don't Delete
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', 'connect.facebook.net/en_US/fbevents.js');

      try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");

      } catch (err) {
        console.log('Facebook Track Error:', err);
      }

    });
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1" />
  </noscript>
  <script>
    $(document).ready(function() {
      md.checkFullPageBackgroundImage();
      setTimeout(function() {
        // after 1000 ms we add the class animated to the login/register card
        $('.card').removeClass('card-hidden');
      }, 700);
    });
  </script>
</body>


<!-- Cipher Panel - Author : exit - Free Access Version -->
</html>
