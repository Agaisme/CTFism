<div class="equal width column row" style="padding-bottom: 2em;">
	<div class="main column">

		<div class="ui center aligned grid" style="padding: 1.5em;">
			<button class="ui large inverted yellow button">
			  New Challanges
			</button>
		</div>
    
	</div>
</div>

<!-- Challanges Managr  -->
<div class="equal width column row">
  <?php 
    $userData = $_SESSION["ctfplat_usession"];
    $cat = '';
    $i = 0;
    foreach ($data["challenges"] as $challenges) {
      if ($challenges->category !== $cat) {
        if ($i>0) {
          echo ('      </div>
    </div>');
        }

        echo ('  <h4 class="ui horizontal divider header">'.$challenges->category.'</h4>
    <div class="main column">
      <div class="ui five doubling cards">');
        $i++;
      }
      echo ('      <!-- START CARD CHALLENGES  -->
      <div data-id="'.$challenges->id.'" id="edit-challenge" class="card xcard noselect">
        <div class="content">
          <div class="meta">
            <span class="category challenges">'.$challenges->name.'</span>
          </div>
        </div>
        <div class="extra content">
          <div class="right floated author">
            <i class=" yellow trophy small icon"></i> '.$challenges->value.' pts
          </div>
        </div>
      </div>
      <!-- END CARD CHALLENGES  -->');
      $cat = $challenges->category;
    }
  ?>  
</div>
<!-- Challanges Managr  -->


<!-- Modal Chall Details Edit  -->
<div id="edit-chall" class="ui large modal scrolling">
    <i class="close icon"></i>
    <div class="header">
      Update Challanges
    </div>
    <div class="content">
      <form name ="edit-chall" class="ui form">
        <div class="field">
          <label>Name</label>
          <input type="text" name="name" placeholder="Challanges Name">
        </div>
        <div class="field">
          <label>Category</label>
          <input type="text" name="category" placeholder="Challanges Category">
        </div>
        <div class="field">
          <label>Description</label>
          <textarea class="form-control editor" rows="7" name="description"></textarea>
        </div>
        <div class="field">
          <label>Value</label>
          <input type="text" name="value" placeholder="Challanges Value">
        </div>
      </form>
    </div>
  <div class="actions">
    <div name="delete" class="ui red left floated labeled icon button" data-id="0">
      Delete
      <i class="trash outline icon"></i>
    </div>
    <div class="ui deny button">
      Cancel
    </div>
    <div class="ui positive right labeled icon button">
      Save
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
<!-- End Modal Chall Details Edit  -->

<!-- Modal Delete Chall -->
<div name="delete" class="ui basic modal">
  <div class="ui icon header">
    <i class="trash outline icon"></i>
  </div>
  <div class="content">
    <p>Are you sure want to delete this Challanges?</p>
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
<!-- End Modal Delete Chall  -->

<!-- Dimmer Loading  -->
<div class="ui dimmer loading">
  <div class="ui text loader">Loading</div>
</div>
<!-- End Dimmer Loading  -->


<script type="text/javascript">
	
	$(document)
        .ready(function() {

    // Settings Challanges Action
      function getChallDetails(cid){
          $.ajax({
                url     : '?page=challman&&action=details',
                method  : 'POST',
                cache   : false,
                dataType: 'JSON',
                data    : ({  'id'   : cid
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) {
                      $.each(data, function(index, item) {
                      	$('[name="name"]').val(item.name);
						$('[name="category"]').val(item.category);
						$('textarea[name="description"]').val(item.description);
						$('[name="value"]').val(item.value);
                      });
                  },
                error: function( req, status, err ) {
                    /*$('#chall-name').html('Error, Please try again...');*/
                    console.log( 'Something went wrong ', status, err );
                }
          });
      }
    // Settings Challanges Action
      function updateChallDetails(cid, name, category, description, value){
          $.ajax({
                url     : '?page=challman&&action=update',
                method  : 'POST',
                cache   : false,
                data    : ({  'id'     		: cid,
                              'name'   		: name,
                              'category'	: category,
                              'description' : description,
                              'value' 		: value
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                success: function (data) {
                      dat = JSON.parse(data);
                      console.log(dat.message);
                      if (dat.success == true) {
                        toastr.info(dat.message, 'Success');
                        $("form[name=edit-chall]")[0].reset();
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

      // Delete Challanges Action
      function delChall(id){
        console.log(id);
        $.ajax({
                url     : '?page=challman&&action=delete',
                method  : 'POST',
                cache   : false,
                data    : ({  'id'   : id
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

      $('div[name="delete"].ui.icon.button').click(function(event){
        event.preventDefault(); 
        var cid = $('div[name="delete"].ui.icon.button').data('id');
        console.log(cid);
        console.log("Delete Chall");
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
              delChall(cid);
              $('.ui.dimmer').dimmer('show');
              $('#chall-panel').load('/app/?page=challman');
              setTimeout(function(){ 
                $('.ui.dimmer').dimmer('hide');
                $('#chall-panel').removeClass('loading transition visible');
              }, 1200);
              
            }
          })
          .modal('show')
        ;
      });

	//Challenges Edit Action
      $("#edit-challenge.card.noselect").click(function(event){
        event.preventDefault();  
        $("form[name=edit-chall]")[0].reset();
        var cid = $(this).data('id');
        $('div[name="delete"].ui.button').data('id', cid);
        console.log(cid);

        $('#edit-chall.ui.modal')
          .modal({
            detachable: false,
            autofocus : true,
            onShow: function(callback) {
              getChallDetails(cid);
              console.log('Modal is show');
            },
            onVisible: function() {
              console.log('Modal is visible');
            },
            onDeny    : function(){
              console.log('Edit Cancel');
            },
            onApprove : function() {
        	  var name   		= $('[name="name"]').val();
              var category 		= $('[name="category"]').val();
              var description 	= $('textarea[name="description"]').val();
              var value 		= $('[name="value"]').val();              
              console.log('Approve');
              updateChallDetails(cid, name, category, description, value);
              $('.ui.dimmer').dimmer('show');
              $('#chall-panel').load('/app/?page=challman');
              setTimeout(function(){ 
                $('.ui.dimmer').dimmer('hide');
                $('#chall-panel').removeClass('loading transition visible');
              }, 1200);
            }
          })
          .modal('show')
        ;
      });


      


	})
	;


</script>