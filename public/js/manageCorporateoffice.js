function deleteFunction(id) {
  $("#deleteCorporateOfficeForm").attr("action", "/removeCorporateOffice/" + id);
}