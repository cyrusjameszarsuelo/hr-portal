function deleteSurvey(id)
{
    $('#deleteForm').attr('action', '/removeSurvey/'+id);
}



// $(function () {
//   bsCustomFileInput.init();
//   $("#example1").DataTable({
//     "responsive": true, "lengthChange": false, "autoWidth": false,
//     // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

// });


// $('#end_date').datetimepicker({
//     format: 'Y-M-D'
// });

// $("input[data-bootstrap-switch]").each(function(){
//     $(this).bootstrapSwitch('state', $(this).prop('checked'));
// })

$(function () {
  var ctr = 1;
  $("#addText").click(function(){

      $("#answersSection").append(
        '<div class="row removeRow">'+
          '<div class="col-md-10">'+
            '<input type="text" class="form-control" placeholder="Add Choices" name="answers[]">'+
          '</div>'+
          '<div class="col-md-2">'+
            '<button type="button" class="btn btn-danger btn-sm appended" >x</button>'+
          '</div>'+
        '</div>'+
        '<br>'
      );
      ctr++;


  });

  $(".appended").each(function(){

      console.log($(this));
  });
});


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
        is3D: true,
        width: 400,
        height: 300
      };

      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }

    $('#surveyTitleModal').html('Survey Results for ' + name);

  }

