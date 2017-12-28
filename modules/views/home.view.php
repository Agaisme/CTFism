<?php
  $page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : '';
?>
<div class="equal width column row">
    <h4 class="ui horizontal divider header">
    Dashboard
    </h4>
    <div class="main column">
      <div class="ui text center container">
        <?php 
          if (($data["userData"]->admin)==1) {
        ?>

        
          <div class="ui segment">
            <div class="ui three statistics">
              <div class="statistic">
                <div class="value"><i class="edit grey tiny icon"></i>
                  <?= $data["total"]["challenges"]; ?>
                </div>
                <div class="label">
                  Challenges Create
                </div>
              </div>
              <div class="statistic">
                <div class="value">
                  <i class="flag checkered grey tiny icon"></i> <?= $data["total"]["solves"]; ?>
                </div>
                <div class="label">
                  Challenges Solved
                </div>
              </div>
              <div class="statistic">
                <div class="value">
                  <i class="user grey tiny icon"></i>
                  <?= $data["total"]["user"]; ?>
                </div>
                <div class="label">
                  Users Registered
                </div>
              </div>
            </div>
          </div>
        
        <?php }else{ ?>

        <div class="ui message">
          <div class="header">
            Selamat Datang !
          </div>
          <p>Mohon maaf atas ketidak nyamanan nya karena kami masih sedang tahap pengembangan.</p>
        </div>

        <?php } ?>

        <div class="ui segment">
            
            <div class="ui middle aligned divided list">
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">Nama</div><?=$data["userData"]->name;?>
                </div>
              </div>
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">Email</div><?=$data["userData"]->email;?>
                </div>
              </div>
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">Website</div><?=$data["userData"]->website;?>
                </div>
              </div>
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">Country</div><?=$data["userData"]->country;?>
                </div>
              </div>
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">Join Date</div><?=$data["userData"]->joined;?>
                </div>
              </div>
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">IP Address</div><?=$_SERVER["REMOTE_ADDR"];?>
                </div>
              </div>
              <div class="item">
                <div class="content">
                  <div class="ui black horizontal label yellowText">Server Address</div><?=$_SERVER['SERVER_NAME'];?>
                </div>
              </div>
            </div>

          </div>
      </div>
    </div>
</div>