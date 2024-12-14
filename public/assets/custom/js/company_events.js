function deleteEvent(id)
{
   $('#deleteForm').attr('action', '/removeEvent/'+id);
}

function editCompanyEvents(id, event, description, event_date)
{
   $('#editForm').attr('action', '/updateCompanyEvents/'+id);
   $('#events').val(event);
   $('#event_date').val(event_date);
   $('#description').text(description);
}

$("#addCompanyEvents").click(function(){
   $('#editForm').attr('action', '/storeCompanyEvents');
});