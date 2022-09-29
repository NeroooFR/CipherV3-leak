<?php
session_start();  
if(!isset($_SESSION["username"]))  
{  
      die(header("location:../login.php"));  
}   
include 'eldb.php';
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

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}  
$idserv = $_GET["serv"];
$chat = "SELECT * FROM serverchat WHERE serverid = $idserv ORDER BY id DESC";
  if($resultc = mysqli_query($db, $chat)){
    if(mysqli_num_rows($resultc) > 0){
      while($rowc = mysqli_fetch_array($resultc)){ ?>

                    <div class="card">
                         <div class="card-body">
                         	<?php
                         	if(startsWith($rowc['content'],"///" )){ ?>
                             <h6 class="card-subtitle mb-2 text-muted text-left"><a target="_blank" href="https://steamcommunity.com/profiles/'<?php echo $rowc["steamid"]; ?>'"><? echo $rowc['user']; ?></a> - <i><? echo $rowc['plyip']; ?> </i> - <i> <? echo $rowc['plyrank']; ?> </i> - CHAT ADMIN</h6>  <p class="card-text float-left"><? echo substr($rowc['content'], 3); ?></p>

							<? }elseif(startsWith($rowc['content'],"/ooc" )){ ?>
                             <h6 class="card-subtitle mb-2 text-muted text-left"><a target="_blank" href="https://steamcommunity.com/profiles/'<?php echo $rowc["steamid"]; ?>'"><? echo $rowc['user']; ?></a> - <i><? echo $rowc['plyip']; ?> </i> - <i> <? echo $rowc['plyrank']; ?> </i> - MODE OOC</h6>  <p class="card-text float-left"><? echo substr($rowc['content'], 4); ?></p> 

                         	<? }elseif(startsWith($rowc['content'],"//" )){ ?>
							    <h6 class="card-subtitle mb-2 text-muted text-left"><a target="_blank" href="https://steamcommunity.com/profiles/'<?php echo $rowc["steamid"]; ?>'"><? echo $rowc['user']; ?></a> - <i><? echo $rowc['plyip']; ?> </i> - <i> <? echo $rowc['plyrank']; ?></i> - MODE OOC</h6>  <p class="card-text float-left"><? echo substr($rowc['content'], 2); ?></p> 

                             <? }elseif(startsWith($rowc['content'],"/name")){ ?>
                             <h6 class="card-subtitle mb-2 text-muted text-left"><a target="_blank" href="https://steamcommunity.com/profiles/'<?php echo $rowc["steamid"]; ?>'"><? echo $rowc['user']; ?></a> - <i><? echo $rowc['plyip']; ?> </i> - <i> <? echo $rowc['plyrank']; ?> </i> - CHANGEMENT DE NOM</h6>  <p class="card-text float-left"><? echo 'Changement de nom en' .substr($rowc['content'], 5); ?></p>

                         <? }elseif(startsWith($rowc['content'],"/rpname")){ ?>
                             <h6 class="card-subtitle mb-2 text-muted text-left"><a target="_blank" href="https://steamcommunity.com/profiles/'<?php echo $rowc["steamid"]; ?>'"><? echo $rowc['user']; ?></a> - <i><? echo $rowc['plyip']; ?> </i> - <i> <? echo $rowc['plyrank']; ?> </i> - CHANGEMENT DE NOM</h6>  <p class="card-text float-left"><? echo 'Changement de nom en :'.substr($rowc['content'], 7); ?></p>

                              <? }else{ ?>
                             <h6 class="card-subtitle mb-2 text-muted text-left"><a target="_blank" href="https://steamcommunity.com/profiles/'<?php echo $rowc["steamid"]; ?>'"><? echo $rowc['user']; ?></a> - <i><? echo $rowc['plyip']; ?> </i> - <i> <? echo $rowc['plyrank']; ?> </i> - CHAT</h6>  <p class="card-text float-left"><? echo $rowc['content']; ?></p> <? } ?>
                         </div>
                    </div>  
                    <?php } }else{
                    	echo "Aucune donnée n'est disponible. Cela signifie sûrement qu'aucune information n'a été envoyé du serveur au panel.";
                    } } ?>   