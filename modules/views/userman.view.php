<div class="equal width column row" style="padding-bottom: 2em;">
	<div class="main column">

    <div class="ui center aligned grid" style="padding: 1.5em;">
      <button class="ui large inverted yellow button">
        Add User
      </button>
    </div>
    
	</div>
</div>


<div class="equal width column row">
    <div class="main column">

    	<!-- USERMAN  -->
          <table id="list-user" class="ui striped table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Website</th>
                <th>Country</th>
                <th>Admin</th>
                <th>Verified</th>
                <th>Settings</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($data["user"] as $user) {
              ?>
              <tr name="<?php echo $user->id; ?>">
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->website; ?></td>
                <td><?php echo $user->country; ?></td>
                <td>
					<div class="ui toggle checkbox <?php if($user->admin == 1) echo 'checked'; ?>">
					  <input type="checkbox" name="admin" data-id="<?php echo $user->id; ?>" <?php if($user->admin == 1) echo 'checked'; ?>>
					</div>
            	</td>
                <td>
        	<div class="ui toggle checkbox <?php if($user->verified == 1) echo 'checked'; ?>">
					  <input type="checkbox" name="verified" data-id="<?php echo $user->id; ?>" <?php if($user->verified == 1) echo 'checked'; ?>>
					</div>
                </td>
                <td>
                  <button data-id="<?php echo $user->id; ?>" name="settings" class="circular basic ui icon button">
                    <i class="yellow inverted icon settings"></i>
                  </button>
                  <button data-id="<?php echo $user->id; ?>" name="delete" class="circular basic ui icon button">
                    <i class="red inverted icon trash"></i>
                  </button>
                </td>
              </tr>
            <?php
                }
            ?>
            </tbody>
          </table>
    	<!-- END USERMAN  -->

    </div>
</div>


<!-- Dimmer Loading  -->
<div class="ui dimmer loading">
  <div class="ui text loader">Loading</div>
</div>
<!-- End Dimmer Loading  -->

<!-- Modal Delete User -->
<div name="delete" class="ui basic modal">
  <div class="ui icon header">
    <i class="trash outline icon"></i>
  </div>
  <div class="content">
    <p>Are you sure want to delete this user?</p>
  </div>
  <div class="actions">
    <div class="ui red cancel inverted button">
      <i class="inverted remove icon"></i>
      No
    </div>
    <div class="ui green ok inverted button">
      <i class="inverted checkmark icon"></i>
      Yes
    </div>
  </div>
</div>
<!-- End Modal Delete User  -->

<!-- Modal Settings User -->
<div name="settings" class="ui small modal">
  <i class="close icon"></i>
  <div class="header">
    Edit User
  </div>
  <div class="content">
      <form name ="edit-user" class="ui form">
        <div class="field">
          <label>User Name</label>
          <input type="text" name="username" placeholder="Username" disabled="">
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" name="email" placeholder="Email">
        </div>
        <div class="field">
          <label>Password</label>
          <input type="Password" name="password" placeholder="Password">
        </div>
        <div class="field">
          <label>Website</label>
          <input type="text" name="website" placeholder="Website">
        </div>
        <div class="field">
          <label>Country</label>
          <input type="text" name="country" placeholder="Country">
        </div>
      </form>
  </div>
  <div class="actions">
    <div class="ui deny button">
      Cancel
    </div>
    <div class="ui positive right labeled icon button">
      Save
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
<!-- End Modal Settings User -->

<script type="text/javascript">
    $(document)
        .ready(function() {

    // Settings Checkbox User Action 
		$('#list-user tr td .ui.checkbox')
            .checkbox().checkbox({
              onChecked: function() {
              	var vals 	= 1,
              		user    = $(this).data('id'),
              		state   = $(this).attr('name');
              		calladmver(vals, state, user);
              },
              onUnchecked: function() {
              	var vals 	= 0,
              		user    = $(this).data('id'),
              		state   = $(this).attr('name');
              		calladmver(vals, state, user)
              }
            })
  		;
      // Settings Checkbox User Action 
  		function calladmver(val, state, user){
        console.log(user);
  			$.ajax({
                url     : '?page=userman&&action=editUser',
                method  : 'POST',
                cache   : false,
                data    : ({  'val' 	: val,
                              'state'	: state,
                              'uid'		: user
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) { 
                      dat = JSON.parse(data);
                      console.log(dat.message);
                      if (dat.success == true) {
                        toastr.info(dat.message, 'Success');
                      }else{
                        toastr.warning(dat.message, 'Error');
                      }
                  },
                error: function( req, status, err ) {
                    /*$('#chall-name').html('Error, Please try again...');*/
                    console.log( 'Something went wrong ', status, err );
                }
          });
  		}

      // Settings User Action
      function getUserDetails(uid){
          $.ajax({
                url     : '?page=userman&&action=details',
                method  : 'POST',
                cache   : false,
                dataType: 'JSON',
                data    : ({  'uid'   : uid
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) {
                      $.each(data, function(index, item) {
                          $('[name="username"]').val(item.name);
                          $('[name="email"]').val(item.email);
                          $('[name="website"]').val(item.website);
                          $('[name="country"]').val(item.country);
                      });
                  },
                error: function( req, status, err ) {
                    /*$('#chall-name').html('Error, Please try again...');*/
                    console.log( 'Something went wrong ', status, err );
                }
          });
      }
      function updateUserDetails(uid, email, password, website, country){
          $.ajax({
                url     : '?page=userman&&action=update',
                method  : 'POST',
                cache   : false,
                data    : ({  'uid'     : uid,
                              'email'   : email,
                              'password': password,
                              'website' : website,
                              'country' : country
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) {
                      dat = JSON.parse(data);
                      console.log(dat.message);
                      if (dat.success == true) {
                        toastr.info(dat.message, 'Success');
                        $("form[name=edit-user]")[0].reset();
                      }else{
                        toastr.warning(dat.message, 'Error');
                      }
                  },
                error: function( req, status, err ) {
                    /*$('#chall-name').html('Error, Please try again...');*/
                    console.log( 'Something went wrong ', status, err );
                }
          });
      }
      //Settings User Action
      $("[name=settings].ui.icon.button").click(function(event){
        event.preventDefault();  
        $("form[name=edit-user]")[0].reset();
        var uid = $(this).data('id');

        $('[name=settings].ui.modal')
          .modal({
            detachable: false,
            autofocus : true,
            onShow: function(callback) {
              getUserDetails(uid);
              console.log('Modal is show');
            },
            onVisible: function() {
              console.log('Modal is visible');
            },
            onDeny    : function(){
              console.log('Edit Cancel');
            },
            onApprove : function() {
              var email   = $('[name="email"]').val();
              var password= $('[name="password"]').val();
              var website = $('[name="website"]').val();
              var country = $('[name="country"]').val();
              console.log('Approve');
              updateUserDetails(uid, email, password, website, country);
              $('.ui.dimmer').dimmer('show');
              $('#user-panel').load('/app/?page=userman');
              setTimeout(function(){ 
                $('.ui.dimmer').dimmer('hide');
                $('#user-panel').removeClass('loading transition visible');
              }, 1200);
              
            }
          })
          .modal('show')
        ;

      });

      // Delete User Action
      function delUser(id){
        console.log(id);
        $.ajax({
                url     : '?page=userman&&action=delete',
                method  : 'POST',
                cache   : false,
                data    : ({  'uid'   : id
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) { 
                      dat = JSON.parse(data);
                      console.log(dat.message);
                      if (dat.success == true) {
                        toastr.info(dat.message, 'Success');
                      }else{
                        toastr.warning(dat.message, 'Error');
                      }
                  },
                error: function( req, status, err ) {
                    /*$('#chall-name').html('Error, Please try again...');*/
                    console.log( 'Something went wrong ', status, err );
                }
          });
      }
      
      // Delete User Action
      $("[name=delete].ui.icon.button").click(function(event){
        event.preventDefault();  
        var uid = $(this).data('id');  
        console.log(uid);
        $('[name=delete].ui.basic.modal')
          .modal({
            duration : 500, 
            detachable: false,
            closable  : false,
            autofocus : true,
            onShow: function(callback) {
              console.log('Modal is show');
            },
            onVisible: function() {
              console.log('Modal is visible');
            },
            onDeny    : function(){
            },
            onApprove : function() {
              console.log('Approve');
              delUser(uid);
              $('.ui.dimmer').dimmer('show');
              $('#user-panel').load('/app/?page=userman');
              setTimeout(function(){
                $('.ui.dimmer').dimmer('hide');
                $('#user-panel').removeClass('loading transition visible');
              }, 1200);
              
            }
          })
          .modal('show')
        ;
      });


      //Datatables User
      $("#list-user").DataTable({
            "language": {
                "emptyTable": "Tidak ada data"
            }
        }); 

	});
</script>