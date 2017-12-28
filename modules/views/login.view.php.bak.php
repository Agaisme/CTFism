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
      background-image: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)), url('./resources/images/background-wall.jpg')!important;;
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
                  <div class="ui <?php if($message["success"] == false) { echo "negative"; }else{ echo "green";} ?> message"><?php echo $message["message"]; ?></div>
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
              buttonSubmit.removeClass('loading');
            },1000);
            $.ajax({
              type: "POST",
              data: $("#form-login").serialize(), // serializes the form's elements.
              success: function(data)
              {
                console.log(data); // show response from the php script.
                setTimeout(function(){
                  buttonSubmit.removeClass('loading');
                },1000);
              }
            });
            console.log('Login valid');
          }else{
            console.log('Login not valid');
          }

      });

      $('.ui.submit.button').click(function(){
          console.log('Click');
      });

    });
  </script>

</body>
</html>