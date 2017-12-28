$(document).ready(function(){
  $.ajax({
    url: "?page=scoreboard&&action=getRank",
    method: "GET",
    success: function(data) {
      var name      = [];
      var value     = [];
      var chall_id  = [];
      var date      = [];

      rest = JSON.parse(data);
      for(var i in rest) {
        name.push(rest[i].name);
        value.push(rest[i].value);
        chall_id.push(rest[i].chall_id);
        date.push(rest[i].date);
      }

      var chartdata = {
        labels: name,
        datasets : [
          {
            label: 'Player Score',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: value
          }
        ]
      };

      var ctx = $("#myChart");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(error) {
      console.log(error);
    }
  });
});