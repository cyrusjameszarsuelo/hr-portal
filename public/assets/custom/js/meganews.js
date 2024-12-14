$("#contentKey1").keypress(function(e) {
	if (e.keyCode === 13) {
		$(this).val(function(i,v){
            return v + "<br/>";
        });
	}
})

$("#contentKey2").keypress(function(e) {
	if (e.keyCode === 13) {
		$(this).val(function(i,v){
            return v + "<br/>";
        });
	}
})

function deleteMeganews(title, id)
{

    $('#deleteName').html(title);
    $('#deleteForm').attr('action', '/removeMeganews/'+id);

}

function editMeganews(id, title, quote, quote2, image_title, content, content2)
{
	$('#deleteForm').attr('action', '/editMeganews/'+id);
	$('#title').val(title);
	$('#quote').val(quote);
	$('#quote2').val(quote2);
	$('#image_title').val(image_title);
	$('#content').text(content);
	$('#content2').text(content2);
}