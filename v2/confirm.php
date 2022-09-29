<?php
include 'inc/eldb.php';
if (isset($_GET["to"]) and ($_GET["usr"]) or ($_GET["confirm"])){
    $getusr = $db->real_escape_string($_GET["to"]);
      $checksuc = "SELECT * FROM users WHERE token = '$getusr'";
        if($result = mysqli_query($db, $checksuc)){
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                if ($row['confirm'] == 0){
                }elseif ($row['confirm'] == 2){
                  die(header('location: confirm.php?confirm=false'));
                }else{
                   die(header('location: login.php'));
                }
              }
            }else{
            }
        }else{
            die('Erreur dans la matrice.');
        }
      }else{
        die(header('location:login.php'));
      } 
?>

<!DOCTYPE html>
<html lang="en">


<!-- Cipher Panel - Author : exit - Free Access Version -->
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Confirmation
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="assets/css/material-dashboard.minf066.css?v=2.1.0" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<?php if (isset($_GET["confirm"]) == 'false'){
   $getusr = $db->real_escape_string($_GET["to"]);
      $checksuc = "SELECT * FROM users WHERE token = '$getusr'";
        if($result = mysqli_query($db, $checksuc)){
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                if ($row['confirm'] == 0){
                  die(header('location: login.php'));
                }
              }
            }
        } ?>

        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
              <div class="page-categories">
                <h3 class="title text-center">Refusé</h3>
                <br />
                <ul class="nav nav-pills nav-pills-danger nav-pills-icons justify-content-center" role="tablist">
                  
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" role="tablist">
                      <i class="material-icons">cancel</i>
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
                        Votre compte a été refusé.
                        <br>
                        <br> Les double compte ou donner de fausses informations entraîne le refus du compte.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <?
    }else{
?>
  <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
              <div class="page-categories">
                <h3 class="title text-center">En attente d'activation</h3>
                <br />
                <ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
                  
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" role="tablist">
                      <i class="material-icons">error</i>
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
</head>
</html>
<? } ?>