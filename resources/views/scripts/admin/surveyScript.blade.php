$('#end_date').datetimepicker({
    format: 'Y-M-D'
});

$("input[data-bootstrap-switch]").each(function(){
  	$(this).bootstrapSwitch('state', $(this).prop('checked'));
})

$("#addText").click(function(){

    $("#answersSection").append('<input type="text" class="form-control" placeholder="Enter Answer" name="answers[]" value=""><br>');

});

