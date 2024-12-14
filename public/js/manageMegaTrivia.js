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
  $("#deleteMegaTriviaForm").attr("action", "/removeMegatrivia/" + id);
}

