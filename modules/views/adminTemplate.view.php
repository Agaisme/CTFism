<?php
  $page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : '';
  $uscore = isset($data["uScore"][0]->score) ? $data["uScore"][0]->score : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Agaisme">
  <title>Dashboard CTFPlatform  <?php if($page){echo" | ".(ucwords($page));} ?></title>
  
  <base href="<?php echo PATH; ?>">
  <!-- CSS  -->
  <link rel="stylesheet" href="<?php echo PATH; ?>dist/semantic.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<body class="site">

  <!-- Header -->
  <header class="site-header">
    <div class="ui main text container">
        <p class="ui header">
          CTFPlatform
        </p>
        <p>
          This platform was made by <i>Subraga Islammada</i> and <i>Detrya Purma</i> to help learning improve the security skills.
        </p>
      </div>

      <!-- Menu -->
    <div class="ui main centered grid">
      <div class="row nobott">
        <div class="center aligned column">
            <div class="ui stackable secondary menu borderless mcenter">
              <div class="header item">
                <img class="logo" src="https://semantic-ui.com/images/logo.png" />
              </div>
              <a href="<?php echo PATH; ?>" class="<?php if($page=="" || $page=="home" || $page=="welcome") echo 'active'; ?> yellow item">Home</a>
            <a  href="<?php echo PATH; ?>?page=scoreboard" class="<?php if($page=="scoreboard") echo 'active'; ?> yellow item">Scoreboard</a>
            <a href="<?php echo PATH; ?>?page=challenges" class="<?php if($page=="challenges") echo 'active'; ?> yellow item">Challenges</a>
            <?php 
              if (($data["login"]->admin)==1) {
            ?>
            <a href="<?php echo PATH; ?>?page=admin" class="<?php if($page=="admin") echo 'active'; ?> yellow item">Admin <i class="bottom right corner yellow star icon"></i></a>
            <?php
              }
            ?>
          </div>        
        </div>
      </div>
      <div class="row nopadd">
        <!-- SIDEBAR MENU MOBILE  -->
        <div class="center aligned tablet mobile only column">
          <div class="ui centered card">
              <div class="content">
                <div class="item">
                  <i class="huge icons">
                    <img src="resources/images/ava.png" class="ui tiny circular image">
                    <?php if ($data["login"]->verified == 1) {
                      echo '<i class="bottom right corner teal check icon"></i>';
                    } ?>
                  </i>
                </div>
                <p>./<?php echo $data["login"]->name; ?></p>
                <a class="ui black label">
                    <i class="inverted yellow trophy small icon"></i>
                    <?= $uscore; ?> pts
                </a>
              <div class="ui text menu mcenter">
                <a href="<?php echo SITE_URL; ?>?page=user&action=detail&id=<?php echo $data["login"]->id; ?>" class="item" >
                  Setting
                </a>
                <a href="<?php echo SITE_URL; ?>?page=user&action=update&id=<?php echo $data["login"]->id; ?>" class="item">
                  Invite
                </a>
                <a href="<?php echo PATH; ?>index.php?page=login&&action=logout" class="item">
                  Logout
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- ENDSIDEBAR MENU MOBILE  -->
      </div>
    </div>
  </header>
  
    <!-- MAIN -->
  <main class="site-content">
    <div class="ui main page grid">
      <div class="row">
        <!-- <div class="ui main grid"> -->
          <div class="three wide computer only column">
            <!-- SIDEBAR MENU COMPUTER-->
            <div class="ui vertical fluid menu mcenter">
              <div class="ui center aligned">
                <div class="item">
                  <i class="huge icons">
                    <img src="resources/images/ava.png" class="ui tiny circular image">
                    <?php if ($data["login"]->verified == 1) {
                      echo '<i class="bottom right corner teal check icon"></i>';
                    } ?>
                  </i>
                  
                </div>
                <p>./<?php echo $data["login"]->name; ?></p>
                <a class="ui black label">
                    <i class="inverted yellow trophy small icon"></i>
                    <?= $uscore; ?> pts
                </a>
              </div>
              <div class="item" style="padding-top: 0;">
                <div class="menu">
                  <a href="<?php echo SITE_URL; ?>?page=user&action=detail&id=<?php echo $data["login"]->id; ?>" class="yellow item">Setting</a>
                  <a href="<?php echo SITE_URL; ?>?page=user&action=update&id=<?php echo $data["login"]->id; ?>" class="yellow item">Invite</a>
                  <a href="<?php echo PATH; ?>index.php?page=login&&action=logout" class="yellow item">Logout</a>
                </div>
              </div>
            </div>
            <!-- END SIDEBAR MENU COMPUTER -->
          </div>
          <div class="sixteen wide mobile tablet only thirteen wide computer only column">
            <div id="main-content" class="ui grid">
            
            <!-- CONTENT MENU  -->
            <?php
                $view = new View($viewName);
                $view->bind('data', $data);
                $view->forceRender();
            ?>
            <!-- END CONTENT MENU  -->
            
            </div>
          </div>
        <!-- </div> -->
      </div>

      <div class="row">
        <div class="sixteen wide column">
          <!-- Segment2 -->
        </div>
      </div>

    </div>
  </main>
  <!-- END MAIN -->

  <!-- Footer -->
  <footer class="site-footer">
  <div class="ui inverted vertical footer segment">
     <div class="ui center aligned container">
        <div class="ui horizontal inverted small link list">
          <span class="item">Crafted and maintained by <a href="https://agais.me"><i class="terminal icon"></i> Agaisme</a>.</span>
        </div>
     </div>
  </div>
  </footer>
  <!-- MODAL  -->

  <style>
    body{
      color: #bbb;
    }
    body::-webkit-scrollbar {
      width: 1em;
    }
    body::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }
    body::-webkit-scrollbar-thumb {
      background-color: darkgrey;
      outline: 1px solid slategrey;
    }
    .ui.blackText.label, .blackText.label{
      color: #282828!important;
    }
    .ui.yellowText.label, .yellowText.label, .yellowText{
      color: #fbbd08!important;
      min-width: 10em;
    }
    .ui.main{
      padding:  1em 0;
    }
    .ui.secondary.menu.mcenter, .ui.text.menu.mcenter, .ui.menu.mcenter{
      display: -webkit-inline-box;
      display: -ms-inline-flexbox;
      display: inline-flex;
      margin: 0;
      vertical-align: middle;
      text-align: center;
    }
    .site {
      display: flex;
      min-height: 100%;
      flex-direction: column;
    }
    .site-content {
        -webkit-box-flex: 1;
        -webkit-flex: 1 0 auto;
        -ms-flex: 1 0 auto;
        flex: 1 0 auto;
        padding: 0;
        width: 100%;
    }
    .site-content::after {
        content: '\00a0'; /* &nbsp; */
        display: block;
        margin-top: var(--space);
        height: 0px;
        visibility: hidden;
    }
    .site-footer, .site-header {
        -webkit-box-flex: 0;
        -webkit-flex: none;
        -ms-flex: none;
        flex: none;
    }
    .ui.grid>.row>.main.column{
      padding: 0.5em;
    }
    p.nameid{
        display: block;
        font-weight: 700;
        padding: 0;
        margin: 0 0 0.4em;
        font-size: 1rem;
        line-height: 1.2em;
    }
    .ui.header>.ui.label {
        margin: 0.2em 0.5em;
    }
    .ui.circular.image, .ui.circular.image>* {
      margin-left: auto !important;
      margin-right: auto !important;
    }
    .ui.four.cards>.card, .ui.five.cards>.card, .ui.six.cards>.card{
      margin: 0.5em;
    }
    .ui.footer.segment {
      margin: 0em;
      padding: 1em 0em;
      width: 100%;
      bottom: 0;
    }
    .ui.cards>.card .meta>.category.challenges{
      font-size: 1.1em;
      font-weight: 400;
      color: #b7b7b7;
    }
    .ui.centered.grid>.row.nopadd{
      padding: 0;
    }
    .ui.centered.grid>.row.nobott{
      padding-bottom: 0;
    }
    .ui.cards>.card.xcard.disabled{
      cursor: not-allowed;
      opacity: .1!important;
      background-image: none!important;
      box-shadow: none!important;
      pointer-events: none;
    }
    .ui.cards>.card.xcard:not(.disabled){
      cursor: pointer;
    }
    .ui.cards>.card.xcard.solved:not(.disabled){
      color: #ababab;
      background-color: #037171;
      border: 1px solid #037171;
    }
    .ui.cards>.card.xcard:not(.disabled):active{
      opacity: .75!important;
    }
    .noselect{
      -webkit-touch-callout: none; /* iOS Safari */
      -webkit-user-select: none; /* Safari */
      -khtml-user-select: none; /* Konqueror HTML */
      -moz-user-select: none; /* Firefox */
      -ms-user-select: none; /* Internet Explorer/Edge */
      user-select: none; /* Non-prefixed version, currently */
    }
  </style>
  <script src="<?php echo PATH; ?>dist/jquery3.2.1.min.js"></script>
  <script src="<?php echo PATH; ?>dist/semantic.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.semanticui.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
    <script type="text/javascript">
      $(document)
        .ready(function() {
        
        $('.secondary.pointing.menu .item')
          .tab({
            cache: false,
            // Request
            apiSettings: {
              url: '/?page={tab}',
              loadingDuration : 300
            }
          })
        ;

      <?php if($page=="challenges"){?>

        $('#input-keys')
          .form({
            fields: {
              keys: {
                identifier : 'keys',
                rules: [
                  {
                    type    : 'empty',
                    prompt  : 'Please enter valid flag'
                  },
                  {
                    type   : 'regExp[/^(CTF{([a-zA-Z0-9_-])*})$/]',
                    prompt : 'Not Valid Flag Format CTF{[a-zA-Z0-9_-]}'
                  }
                ]
              }
            }
          })
        ;

      $(".ui.form#input-keys").submit(function(){

        if ( $('.ui.form#input-keys').form('is valid') ) {
          var keys = $("#keys").val();
          var uid = <?=$data["login"]->id?>;
          /*var dataString = 'keys='+ keys + '&uid='+ uid;*/

          $.ajax({
                url     : '?page=challenges&&action=checkKeys',
                method  : 'POST',
                cache   : false,
                data    : ({  'keys' : keys,
                              'uid'  : uid
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) { 
                      dat = JSON.parse(data);
                      console.log(dat.message);
                      if (dat.success == true) {
                        toastr.success(dat.message, 'Success');
                        $('div[data-id="'+dat.chall_id+'"]').addClass('solved');
                      }else{
                        toastr.error(dat.message, 'Error');
                      }
                  },
                error: function( req, status, err ) {
                    /*$('#chall-name').html('Error, Please try again...');*/
                    console.log( 'Something went wrong ', status, err );
                }

          });
        } 

      });
      <?php }?>

      <?php if($page=="user" || $page=="scoreboard" || $page=="statistics") echo '$("#list-user").DataTable({
            "language": {
                "emptyTable": "Tidak ada data"
            }
        });'; ?>
      
      // lazy load images
      $('.image').visibility({
        type: 'image',
        transition: 'fade in',
        duration: 1500
      });

      $("#challenge.card.noselect").click(function(e){
        e.preventDefault();  
        var challid = $(this).data('id');  
        console.log(challid);
        $('#detail-chall.ui.modal')
          .modal({
            detachable:false,
            duration : 300, 
            autofocus : true,
            onShow: function(callback) {
              console.log('Modal is show');
              $.ajax({
                  url: '?page=challenges&&action=getJson&&id='+challid,
                  type: 'POST',
                  dataType: 'json',
                  cache: false,
                  success: function (data) { 
                      $.each(data, function(index, item) {
                          console.log(item.name);
                          $('#chall-name').html(item.name+'  <div class="ui yellow label blackText">'+item.value+'</div>');
                          $('#chall-desc').html(item.description);
                      });
                  },
                  error: function( req, status, err ) {
                      $('#chall-name').html('Error, Please try again...');
                      console.log( 'something went wrong', status, err );
                  }

               });


            },
            onVisible: function() {
              console.log('Modal is visible');
            },
            onApprove: function() {
              alert('Modal is approved');
            }
          })
          
          .modal('show')
        ;
      });




        })
      ;



    </script>
</body>
</html>