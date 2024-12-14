function deleteJobVacancies(title, id){

    $('#deleteName').html(title);
    $('#deleteForm').attr('action', '/removeJobVacancies/'+id);

}