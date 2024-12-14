<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  // alert();
  var getResultsData = $('#getResultsData').val();
  var data = google.visualization.arrayToDataTable(JSON.parse(getResultsData));

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Survey'};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}

function getCommunityData(title, created_at, content, image) {

  console.log(title);
  var isContent = '';

  if (content !== '') {
    isContent = 'class="img-modal"';
  }

  $("#imageGeneralAnnouncement").html('<img src="'+image+'" width="100%" alt="" '+isContent+'>');
  $("#titleGeneralAnnouncement").html(title);
  $("#textGeneralAnnouncement").html(content);

}

function timelineFunction(image, name, post_type, post, created_date, title, id, timeline_comments) {
  $("#post_image").html('<img src="'+image+'"  height="40" width="40" class="rounded-circle"><div class="d-flex flex-column ms-2" style="margin: 0px 15px"><h6 class="mb-1 text-primary">' +name+'</h6><br><strong><p style="color: black">'+title+'</p></strong><p class="comment-text">' +post+'</p></div>');

  $("#post_date").html(created_date);
  $("#timeline_id").val(id);

  var parse_timeline_comments = JSON.parse(timeline_comments);
  if (parse_timeline_comments.length !== 0) {
    $("#count_comments").html('All Comments('+parse_timeline_comments.length+')');
  }

  var card_comments = '';
  for(var i = 0; i < parse_timeline_comments.length; i++ ) {
    var date_test = new Date(parse_timeline_comments[i].created_at).toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'});
    card_comments += '<div class="card p-3 mb-2" style="width: 100%"> <div class="d-flex flex-row"> <img src="'+parse_timeline_comments[i].image+'"  height="40" width="40" class="rounded-circle"> <div class="d-flex flex-column ms-2" style="margin: 0px 15px"> <h6 class="mb-1 text-primary ">'+parse_timeline_comments[i].name+'</h6> <br><p class="comment-text">'+parse_timeline_comments[i].post+'</p> </div> </div> <div class="d-flex justify-content-between"> <div class="d-flex flex-row gap-3 align-items-center"> </div><div class="d-flex flex-row"> <span class="text-muted fw-normal fs-10"> <br>'+date_test+'</span> </div> </div> </div>';
  }

  $("#card_comments").html(card_comments);

}
</script>