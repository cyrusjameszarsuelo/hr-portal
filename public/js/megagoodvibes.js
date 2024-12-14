$(document).ready(function(){
   $('#addCommentAjax').click(function(e){
      e.preventDefault();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
      });
      $.ajax({
         url: "/submitCommentMegagoodvibes",
         method: 'POST',
         data: {
            comment: $('#comment').val(),
            megagoodvibes_id: $('#megagoodvibes_id').val()
         },
         success: function(data){
            $("#comment_count").html(parseInt($("#comment_count").html()) + 1);
            $("#comment").val('');
            $("#comment_section").append(

               '<div class="media mb-4">'+
                  '<div class="media-body">'+
                     '<h6><strong>'+data.user+'</strong> - <small><i>'+new Date(data.created_at).toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'})+'</i></small></h6>'+
                        '<br>'+
                     '<p>'+data.comment+'</p>'+
                  '</div>'+
               '</div>'+
               '<hr>'

            );
         }
      });
   });

});

$(document).ready(function(){
   $('#likeAjax').click(function(e){
      if ($("#likeIcon").hasClass('fa-regular')) {
         $("#likeIcon").removeClass('fa-regular');
         $("#likeIcon").addClass('fa-solid');
         $("#likeAjax").attr("id","dislikeAjax");
         e.preventDefault();
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
         });
         $.ajax({
            url: "/submitLikeMegagoodvibes",
            method: 'POST',
            data: {
               megagoodvibes_id: $('#megagoodvibes_id').val()
            },
            success: function(data){
            }
         });
      } else {
         $("#likeIcon").removeClass('fa-solid');
         $("#likeIcon").addClass('fa-regular');
         $("#likeAjax").attr("id","likeAjax");
         e.preventDefault();
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
         });
         $.ajax({
            url: "/submitDislikeMegagoodvibes",
            method: 'POST',
            data: {
               megagoodvibes_id: $('#megagoodvibes_id').val()
            },
            success: function(data){
            }
         });
      }
      
   });

});