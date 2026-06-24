// Gets values from input field (e.g. search regions) into one variable
function selectedValuesToQuery(varname) {
    var forURL = [];
    $( varname + " option:selected" ).each(function( index, element ){
        forURL.push($(this).val());
    });
    return forURL;
}

function selectedValuesToURL(fieldname, varname) {
    var forURL = [];
    $( fieldname + " option:selected" ).each(function( index, element ){
        forURL.push(varname + '=' + $(this).val());
    });
    return forURL.join('&');
}

function selectAjax(route, data, placeholder, allow_clear, selector){
    $(selector).select2({
        allowClear: allow_clear,
        placeholder: placeholder,
        width: '100%',
        ajax: {
          url: route,
          dataType: 'json',
          delay: 250,
          data: data,
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          processResults: function (result) {
            return {
              results: result
            };
          },          
          cache: true
        }
    });   
}

function selectOclass(placeholder='', otype_var='search_otype', ogroup_var='', selector=".select-oclass", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              otype_id: selectedValuesToQuery("#" + otype_var),
              ogroup_id: selectedValuesToQuery("#" + ogroup_var),
            };
          };
    selectAjax("/oclasses/list", data, placeholder, allow_clear, selector);
}

function selectSignatory(placeholder='', oclass_var='oclass_id', ogroup_var='', selector=".select-signatory", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              oclass_id: selectedValuesToQuery("#" + oclass_var),
            };
          };
    selectAjax("/signatories/list", data, placeholder, allow_clear, selector);
}

function selectPattern(placeholder='', pgroup_id, type_var='search_ptype', selector=".select-pattern", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              pgroup_id: pgroup_id,
              ptype_id: selectedValuesToQuery("#" + type_var),
            };
          };
    selectAjax("/patterns/list", data, placeholder, allow_clear, selector);
}

function selectAllFields(button_id, select_fields) {
    $('#'+button_id).on('change', function(){
        if ($('#'+button_id).prop('checked')){
//console.log($(select_fields));            
            $(select_fields).prop('checked', true);
        } else {
//console.log($(select_fields));            
            $(select_fields).prop('checked', false);
        }
    });
}

function selectProspeciality(placeholder='', selector=".select-speciality", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              progr: $("input[name='progr']:checked").val(),
            };
          };
    selectAjax("/groups/prospeciality_list", data, placeholder, allow_clear, selector);
}

function selectDiscipline(placeholder='', dclass_var='dclass_id', speciality_var='speciality_id', selector=".select-discipline", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              dclass_id: $("input[name='" + dclass_var + "']:checked").val(),
              speciality_id: $("#" + speciality_var + ' option:selected').val(),
              progr: $("input[name='progr']:checked").val(),
            };
          };
    selectAjax("/disciplines/list", data, placeholder, allow_clear, selector);
}

function selectLecturer(placeholder='', discipline_var='discipline_id', selector=".select-lecturer", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              discipline_id: $("#" + discipline_var + ' option:selected').val(),
            };
          };
    selectAjax("/disciplines/lecturer_list", data, placeholder, allow_clear, selector);
}

function selectAdvicer(placeholder='', selector=".select-advicer", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
            };
          };
    selectAjax("/employees/advicer_list", data, placeholder, allow_clear, selector);
}

function selectGroup(placeholder='', discipline_var='discipline_id', employee_var='employees', selector=".select-group", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              discipline_id: $("#" + discipline_var + ' option:selected').val(),
              employees: selectedValuesToQuery("#" + employee_var),
            };
          };
    selectAjax("/groups/list", data, placeholder, allow_clear, selector);
}

function selectStudent(role_id='', placeholder='', speciality_var='speciality_id', selector=".select-student", allow_clear=false, url='/students/list'){
    var data = function (params) {
            return {
              q: params.term, // search term
              course: $("#course option:selected").val(),
              speciality_id: $("#" + speciality_var + ' option:selected').val(),
              progr: $("input[name='progr']:checked").val(),
              role_id: role_id
            };
          };
    selectAjax(url, data, placeholder, allow_clear, selector);
}

function selectSubdivisionForSpeciality(placeholder='', speciality_var='speciality_id', selector=".select-subdivision", allow_clear=false){
    var data = function (params) {
            return {
              q: params.term, // search term
              speciality_id: $("#" + speciality_var + ' option:selected').val(),
            };
          };
    selectAjax("/subdivisions/list", data, placeholder, allow_clear, selector);
}



