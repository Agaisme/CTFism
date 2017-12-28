    <div class="equal width column row">
    <h4 class="ui horizontal divider header">
      Scoreboard
    </h4>
      <div class="main column">
          
          <!-- USER  -->
          <table id="list-user" class="ui striped table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Country</th>
                <th>Join Date</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 1;
                foreach($data["scoreboard"] as $score) {
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $score->name; ?></td>
                <td><i class="ID flag"></i><?php echo $score->country; ?></td>
                <td><?php echo $score->date; ?></td>
                <td><?php echo $score->score; ?></td>
              </tr>
            <?php
                $no++;
                }
            ?>
            </tbody>
          </table>
          <!-- END USER  -->
        
      </div>
    </div>