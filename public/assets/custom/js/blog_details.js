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
            console.log(data);
            $("#comment_section").append(

               '<div class="fables-comments">'+
                  '<p><span class="fables-fifth-text-color font-14">Posted By</span>'+
                     '<a href="" class="fables-forth-text-color fables-second-hover-color font-15 bold-font ml-1">'+data.name+'</a>'+
                     '<span class="fables-forth-text-color float-right font-14">'+new Date(data.created_at).toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'})+'</span>'+
                  '</p>'+
                  '<p class="font-14 fables-fifth-text-color">'+data.comment+'</p>'+
                  '</div>'+
               '<hr>'

            );
         }
      });
   });

   var blog_id = $('#blog_id').val()

   $.ajax({
      type: 'GET', 
      url: '/getCommentBlog/'+blog_id,
      dataType: 'json',
      success: function (data) {

         console.log(data);
         $.each(data, function (key, item) {

            $("#comment_section").append(

               '<div class="fables-comments">'+
                  '<p><span class="fables-fifth-text-color font-14">Posted By</span>'+
                     '<a href="" class="fables-forth-text-color fables-second-hover-color font-15 bold-font ml-1">'+item.name+'</a>'+
                     '<span class="fables-forth-text-color float-right font-14">'+new Date(item.created_at).toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'})+'</span>'+
                  '</p>'+
                  '<p class="font-14 fables-fifth-text-color">'+item.comment+'</p>'+
                  '</div>'+
               '<hr>'

            );

         });

      },
      error: function(e) { 
         console.log(e);
      }
   });


   $('#searchBlog').click(function(e){
      e.preventDefault();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
      });
      $.ajax({
         type: 'POST', 
         url: '/blogFilter',
         data: {
            search: $('#searchInput').val()
         },
         dataType: 'json',
         success: function (data) {

            console.log(data);
            $.each(data, function (key, item) {

               // $("#blogsFilter").append(

               //    '<div class="fables-comments">'+
               //       '<p><span class="fables-fifth-text-color font-14">Posted By</span>'+
               //          '<a href="" class="fables-forth-text-color fables-second-hover-color font-15 bold-font ml-1">'+item.name+'</a>'+
               //          '<span class="fables-forth-text-color float-right font-14">'+new Date(item.created_at).toLocaleString(undefined, {year: 'numeric', month: '2-digit', day: '2-digit', weekday:"long", hour: '2-digit', hour12: false, minute:'2-digit', second:'2-digit'})+'</span>'+
               //       '</p>'+
               //       '<p class="font-14 fables-fifth-text-color">'+item.comment+'</p>'+
               //       '</div>'+
               //    '<hr>'

               // );
               // $("#blogsFilter").html(
               //    item.blog_title
               // );

            });

         },
         error: function(e) { 
            console.log(e);
         }
      });
   });


});

function deleteBlog(title, id)
{

   $('#deleteName').html(title);
   $('#deleteForm').attr('action', '/removeBlog/'+id);

}