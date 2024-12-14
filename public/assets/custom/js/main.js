
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

// function getCommunityData(title, created_at, content, image) {

//   var isContent = '';

//   if (content !== '') {
//     isContent = 'class="img-modal"';
//   }

//   $("#imageGeneralAnnouncement").html('<img src="'+image+'" width="100%" alt="" '+isContent+'>');
//   $("#titleGeneralAnnouncement").html(title);
//   $("#textGeneralAnnouncement").html(content);

// }

$(document).ready(function(){

  $('#addCommentAjax').click(function(e){
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    $.ajax({
      url: "/submitCommentBlog",
      method: 'POST',
      data: {
        name: $('#name').val(),
        comment: $('#comment').val(),
        blog_id: $('#blog_id').val()
      },
      success: function(data){
      }
    });
  });

});

function deleteCommBoard(id)
{
    $('#deleteForm').attr('action', '/removeCommBoard/'+id);
}


$(document).ready(function () {
    $('.timelineBtn').click(function () {
        const forum = $(this).data('id');
        const comments = $(this).data('text');


        $("#post_image").html('<img src="'+forum.image+'"  height="40" width="40" class="rounded-circle"><div class="d-flex flex-column ms-2" style="margin: 0px 15px"><h6 class="mb-1 text-primary">' +forum.name+'</h6><br><strong><p style="color: black">'+forum.title+'</p></strong><p class="comment-text">' +forum.post+'</p></div>');

        $("#post_date").html(forum.created_date);
        $("#timeline_id").val(forum.id);


        if (comments.length !== 0 ) {
          $("#count_comments").html('All Comments('+comments.length+')');
        } else {
          $("#count_comments").html('All Comments(0)');

        }

        var card_comments = '';
        for(var i = comments.length - 1; i >= 0;  i-- ) {
          var date_test = new Date(comments[i].created_at).toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'});
          card_comments += '<div class="card p-3 mb-2" style="width: 100%"> <div class="d-flex flex-row"> <img src="'+comments[i].image+'"  height="40" width="40" class="rounded-circle"> <div class="d-flex flex-column ms-2" style="margin: 0px 15px"> <h6 class="mb-1 text-primary ">'+comments[i].name+'</h6> <br><p class="comment-text">'+comments[i].post+'</p> </div> </div> <div class="d-flex justify-content-between"> <div class="d-flex flex-row gap-3 align-items-center"> </div><div class="d-flex flex-row"> <span class="text-muted fw-normal fs-10"> <br>'+date_test+'</span> </div> </div> </div>';
        }

        $("#card_comments").html(card_comments);
    })

    $('.communityBtnView').click(function () {

      const forum = $(this).data('id');
      var isContent = '';

      if (forum.content !== '') {
        isContent = 'class="img-modal"';
      }

      $("#imageGeneralAnnouncement").html('<img src="../../img/community_board/'+forum.image+'" width="100%" alt="" '+isContent+'>');
      $("#titleGeneralAnnouncement").html(forum.title);
      $("#textGeneralAnnouncement").html(forum.content);

    });


    $('.communityBtnEdit').click(function() {

      const forum = $(this).data('id');

      $('#manageCommBoardForm').attr('action', '/editCommBoard/'+forum.id);

      $('#title').val(forum.title);
      $('#link').val(forum.link);
      $('#content').val(forum.content);
    });


    $('#addToBoard').click(function() {
      $('#manageCommBoardForm').attr('action', '/storeCommunityBoard');
    });

});
