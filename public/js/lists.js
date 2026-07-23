// Gets values from input field (e.g. search regions) into one variable
function selectedValuesToURL(varname) {
    var forURL = [];
    $(varname + " option:selected").each(function (index, element) {
        forURL.push($(this).val());
    });
    return forURL;
}
/*
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
          processResults: function (result) {
            return {
              results: result
            };
          },
          cache: true
        }
    });
}
*/
function selectSettlement(district_var, locale = 'ru', placeholder = '', allow_clear = true, selector = '.select-settlement', form = '') {
    var route = '/oikonyms/settlements';
    $(selector).select2({
        allowClear: allow_clear,
        placeholder: placeholder,
        width: '100%',
        ajax: {
            url: '/' + locale + route,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    districts: selectedValuesToURL(form + " #" + district_var),
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

function selectSelsovet1926(district_var, locale = 'ru', placeholder = '', allow_clear = true, selector = '.select-selsovet1926', form = '') {
    var route = '/oikonyms/selsovets1926';
    $(form + ' ' + selector).select2({
        allowClear: allow_clear,
        placeholder: placeholder,
        width: '100%',
        ajax: {
            url: '/' + locale + route,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    districts: selectedValuesToURL(form + " #" + district_var)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

function selectSettlement1926(district_var, selsovet_var, locale = 'ru', placeholder = '', allow_clear = true, selector = '.select-settlement1926', form = '') {
    var route = '/oikonyms/settlements1926'
    $(selector).select2({
        allowClear: allow_clear,
        placeholder: placeholder,
        width: '100%',
        ajax: {
            url: '/' + locale + route,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    districts: selectedValuesToURL(form + " #" + district_var),
                    selsovets: selectedValuesToURL(form + " #" + selsovet_var)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

function selectSource(locale = 'ru', placeholder = '', allow_clear = true, selector = '.select-source', form = '', route = '/oikonyms/sources') {
    $(selector).select2({
        allowClear: allow_clear,
        placeholder: placeholder,
        width: '100%',
        ajax: {
            url: '/' + locale + route,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    year_from: $(form + " #search_year_from").val(),
                    year_to: $(form + " #search_year_to").val()
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}
