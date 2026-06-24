function callHelp(id) {
    $(".help-section").hide();
    $("#"+id).show();
    $("#modalHelp").modal('show');    
}
