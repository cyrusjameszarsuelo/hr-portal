function deleteForum(title, id)
{

    $('#deleteName').html(title);
    $('#deleteFormForum').attr('action', '/removeForum/'+id);

}