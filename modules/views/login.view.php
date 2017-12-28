<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login CTFPlatform</title>
  <base href="<?php echo PATH; ?>../">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
  <style>
    body {
        background-color: black;
      }
      label{
        color: #fbbd08!important;
      }
    .content-login{
        width:100%;
        min-height:100%;
        background-size: cover !important;
        background-repeat: no-repeat;
        background-attachment:fixed;
        padding: 200px 0px; 
      }
    .column {
        max-width: 500px;
      }
  </style>
</head>
<body>
  
  <div class="content-login">
    <div class="ui page-login fluid">
      <div class="ui centered grid container">
        <div class="nine wide column">
          <h2 style="color: #fff;">CTFPlatform</h2>
        <form id="form-login" class="ui inverted form" method="post">
          <div class="field">
            <label>Username</label>
            <input placeholder="Username" name="username" type="text" autofocus>
          </div>
          <div class="field">
            <label>Password</label>
            <input placeholder="Password" type="password" name="password">
          </div>
          <div class="ui fluid large inverted yellow submit button" id="login">Login</div>

          <!-- LoginMessage  -->
          <?php
            if(count($message)) {
          ?>
                  <div id="notice-login" class="ui <?php if($message["success"] == false) { echo "negative"; }else{ echo "positive";} ?> message"><?php echo $message["message"]; ?></div>
          <?php
            }
          ?>

          <div class="ui error message"></div>

        </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
  <script>
    $(document).ready(function() {

      $('.ui.form').form({
            fields: {
              username: {
                identifier  : 'username',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Masukkan username dengan benar !'
                  }
                ]
              },
              password: {
                identifier  : 'password',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Masukkan kata sandi dengan benar !'
                  },
                  {
                    type   : 'length[5]',
                    prompt : 'Kata sandi harus lebih dari {ruleValue} karakter'
                  }
                ]
              }
            }
          })
        ;   

      $("form").submit(function(){
          if ( $('.ui.form').form('is valid') ) {
            var buttonSubmit = $('.ui.submit.button').addClass('loading');
            setTimeout(function(){
              $.ajax({
                type: "POST",
                data: $(this).serialize(),
                success: function(data)
                {
                  console.log('Validation login');
                }
              });
              buttonSubmit.removeClass('loading');
            },1500);
            }else{
              console.log('Login not valid');
            }
      });
      

    });
  </script>

</body>
</html>