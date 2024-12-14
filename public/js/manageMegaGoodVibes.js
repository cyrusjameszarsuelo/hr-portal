$(function () {
  // Summernote
  $('#summernote').summernote({
        fontSize: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Gotham', 'Impact', 'Magistral', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'hr']],
          ['view', ['fullscreen', 'codeview']],
          ['help', ['help']]
        ],
  });

  $('#example1').dataTable();

  bsCustomFileInput.init();

});

function deleteFunction(id) {
  $("#deleteMegaGoodVibesForm").attr("action", "/removeMegaGoodVibes/" + id);
}

$("#aFile_upload").on("change", function (e) {

    var count=1;
    var files = e.currentTarget.files; // puts all files into an array

    
      var filesize = ((files[0].size/1024)/1024).toFixed(4); // MB
  
      if (filesize >= 40) { 

        alert('Your limit video size is atleast 40MB max');
        $("#approvedFiles").val('');
      }

});