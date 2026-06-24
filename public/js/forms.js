function show_hide_password(fieldname) {
    $('body').on('click', '#'+fieldname+'-control', function(){
        if ($('#'+fieldname).attr('type') === 'password'){
            $(this).addClass('view');
            $('#'+fieldname).attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#'+fieldname).attr('type', 'password');
        }
        return false;
    });
}

function phoneField(selector) {
  var input = document.querySelector(selector);
  window.intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: callback => {
      fetch("https://ipapi.co/json")
        .then(res => res.json())
        .then(data => callback(data.country_code))
        .catch(() => callback("us"));
    },
    utilsScript: "/js/utils.js"
  });    
}

function toggleChecked(el, select_fields) {
    if ($(el).prop('checked')) {
    //console.log($(select_fields));            
        $(select_fields).prop('checked', true);
    } else {
        //console.log($(select_fields));            
        $(select_fields).prop('checked', false);
    }    
}

function toggleVisible(el) {
    let elem = document.querySelector(el);
    elem.classList.toggle('invisible');    
}

function checkLinked(el, linked) {
    if ($(el).prop('checked')) {
        $(linked).prop('checked', true);
    }
}
