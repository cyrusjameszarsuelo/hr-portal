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
  $("#deleteMeganewsForm").attr("action", "/removeMeganews/" + id);
}

$(function(){
    $("#fileInputChange").change(function(){
        var fileUpload = $("input[type='file']");
        if (parseInt(fileUpload.get(0).files.length) > 5){
          alert("You can only upload a maximum of 5 files");
        }
    });    
});