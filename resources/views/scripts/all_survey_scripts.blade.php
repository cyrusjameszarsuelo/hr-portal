<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  function surveyResultsFunction(dataResults, question, name) {

    // Load google charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw the chart and set the chart values
    function drawChart() {
      var data = google.visualization.arrayToDataTable(JSON.parse(dataResults));

      // Optional; add a title and set the width and height of the chart
      var options = {
        'title':question,
        is3D: true
      };

      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

    $('#surveyTitleModal').html('Survey Results for ' + name);

  }
</script>