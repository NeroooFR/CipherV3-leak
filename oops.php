<?
session_start();  
if(!isset($_SESSION["username"]))  
{  
      die(header("location:login.php"));  
} 
include 'includes/eldb.php';

$ifban = "SELECT ban FROM users WHERE username = '".$_SESSION["username"]."'";
if($result = mysqli_query($db, $ifban)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            if ($row["ban"] == 0){
                die(header("location:login.php"));
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
    Cipher - Ban
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <link href="assets/css/ban.css" rel="stylesheet" />
</head>

<body>
<div id="app">
   <div>403</div>
   <div class="txt">
      Vous avez été banni<span class="blink"> :(</span>
   </div>
</div>
</body>
</html>