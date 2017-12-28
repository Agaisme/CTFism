  <!-- INPUT FLAG  -->
  <div class="equal width column row">
    <div class="main column">

      <div class="ui form segment" id="input-keys">
        <div class="ui action fluid input focus">
          <input id="keys" name="keys" type="text" placeholder="Flag...">
          <div class="ui yellow labeled icon submit button"><i class="send outline icon"></i>Submit Flag</div>
        </div>
        <div class="ui error message"></div>
      </div>

    </div>
  </div>
  <!-- END INPUT FLAG  -->
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
      $solved = 0;
      foreach ($data["solves"] as $solves) {
        /*check soal solved*/
        if ($solves->chall_id == $challenges->id && $solves->uid == $userData->id && $challenges->hidden == 0) {
          $solved = 1;
        }
      }
      if ($solved == 1 && $challenges->hidden == 0) {
        $call_act = "solved";
      }elseif ($solved == 0 && $challenges->hidden == 0) {
        $call_act = "actived";
      }
      echo ('      <!-- START CARD CHALLENGES  -->
      <div data-id="'.$challenges->id.'" id="challenge" class="card '.$call_act.' xcard noselect">
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

  <div id="detail-chall" class="ui inverted modal">
    <i class="close icon"></i>
    <div id="chall-name" class="header"></div>
    <div class="scrolling content">
      <div class="ui segment">
      <div class="description">
        <p id="chall-desc"></p>
      </div>
      </div>
    </div>
  </div>