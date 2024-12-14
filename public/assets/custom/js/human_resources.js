  
  function getSubData(data) {

    var isContent = '';
    if (data.content !== null) {

      isContent = 'class="img-modal"';
    }

    $("#imageGeneralAnnouncement").html('');
    $("#textGeneralAnnouncement").html('');

    if(data.announcements_images.length == 0){
      $("#imageGeneralAnnouncement").html('');
    } else if (data.announcements_images.length >= 2) {
      $.each(data.announcements_images, function (key, image) {
        $("#imageGeneralAnnouncement").append('<img src="'+image.image+'" width="100%" alt="" '+isContent+'>');
      });
    } else if (data.announcements_images.length < 2) {

      $.each(data.announcements_images, function (key, image) {
        $("#imageGeneralAnnouncement").html('<img src="'+image.image+'" width="100%" alt="" '+isContent+'>');
      });

    }
    $("#titleGeneralAnnouncement").html(data.title);
    if (data.content != null) {
      $("#textGeneralAnnouncement").html(data.content.replace(/\r\n/g,"<br/>"));
    }


  }

  function getSubData2(data) {

    $("#titleHrWebsite").html(data.name);
    if (data.image.indexOf('mp4') > -1) {
        $("#imageHrWebsite").html('<video width="520" height="340" controls>'+
          '<source src="'+data.image+'" type="video/mp4">'+
          '</video>');
      } else {
        $("#imageHrWebsite").html('<img src="'+data.image+'" width="100%" alt="">');
      }


  }

  function deleteAnnouncement(id){

    // $('#deleteName').html(title);
    $('#deleteForm').attr('action', '/removeAnnouncement/'+id);

  }

  function deleteHrWebsite(title, id){

    $('#deleteNameHR').html(title);
    $('#deleteFormHR').attr('action', '/removeHrWebsite/'+id);

  }

  function editAnnouncement(data) {


    $("#title").val(data.title);
    $("#contentType").val(data.content_type_id);
    $("#content").val(data.content);

    $('#manageAnnouncementForm').attr('action', '/editAnnouncement/'+data.id);

  }

  $('#manageAnnouncementForm').click(function() {
      $('#deleteForm').attr('action', '/addAnnouncement');
  })


  $(".card-org").each(function(i, obj) {
    $(this).click(function() {

      $('#modalTree').modal('toggle');
      
      $('#imageTree').html($(".card-org div.circular").eq(i).html());
      $('#nameTree').html($(".card-org h5.card-title").eq(i).html());
      $('#positionTree').html($(".card-org p.card-text").eq(i).html());
      $('#responsibilities').html($(".card-org div.responsibilities").eq(i).html());

    });
  });

  $(".howToName").each(function(i, data){
    $(this).click(function(){

    var imgFile = $(this).attr('data-src');

    // console.log($(this).attr('data-src'));

    $('#aImageView').attr('href', imgFile);
    $('#imageView').html('<img src="'+imgFile+'" alt="" class="w-100">');

    });

  });


  $(".MuName").each(function(i, data){
    $(this).click(function(){

    var imgFile = $(this).attr('data-src');


    $('#embedFile').html(' <embed src="'+imgFile+'" width="100%" style="height: 35vw;" /> <br> <br> <a href="'+imgFile+'" target="_blank" class="text-white"><button class="btn btn-primary btn-block fables-btn-rounded">View in New Tab</button></a> ');

    });

  });

  
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var getResultsData = $('#getResultsData').val();
  if (getResultsData != '') {
    var data = google.visualization.arrayToDataTable(JSON.parse(getResultsData));

    // Optional; add a title and set the width and height of the chart
    var options = {'title':'Survey'};

    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
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

      if (forum.content !== null) {
        isContent = 'class="img-modal"';
      }

      if (forum.image.indexOf('mp4') > -1) {
        $("#imageCommunityBoard").html('<video width="520" height="340" controls>'+
          '<source src="'+forum.image+'" type="video/mp4">'+
          '</video>');
      } else {
        $("#imageCommunityBoard").html('<img src="'+forum.image+'" width="100%" alt="" '+isContent+'>');
      }

      $("#titleCommunityBoard").html(forum.title);
      $("#textCommunityBoard").html(forum.content);

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
