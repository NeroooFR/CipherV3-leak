    <div class="sidebar" data-color="purple" data-background-color="black" >
      <div class="logo"><a href="http://www.google.com" class="simple-text logo-normal">
          Cipher Panel
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="servers.php">
              <i class="fas fa-bug"></i>
              <p>Serveurs</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="payloads.php">
              <i class="fas fa-code"></i>
              <p>Payloads</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="members.php">
              <i class="fas fa-users"></i>
              <p>Membres</p>
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a class="nav-link" href="leadboards.php">
              <i class="fas fa-crown"></i>
              <p>Leadboards</p>
            </a>
          </li> -->
          <li class="nav-item ">
            <a class="nav-link" href="steamusers.php">
              <i class="fas fa-user-lock"></i>
              <p>Utilisateurs</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="updates.php">
              <i class="fas fa-newspaper"></i>
              <p>Mise à jour</p>
            </a>
          </li>
          <?php
          $check = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                                    if($resultc = mysqli_query($db, $check)){
                                      if(mysqli_num_rows($resultc) > 0){
                                        while($rowa = mysqli_fetch_array($resultc)){
                                          if ($rowa["rank"] == 2){ ?>
          <li class="nav-item ">
            <a class="nav-link" href="logsadmin.php">
              <i class="fas fa-code-branch"></i>
              <p>Logs Admin</p>
            </a>
          </li>
          <?
        }
      }
    }
  } ?>
          <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
        </ul>
      </div>
    </div>