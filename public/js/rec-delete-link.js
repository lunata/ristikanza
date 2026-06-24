// listens for click events on elements which have a data-delete attribute
function recDelete(confirm_message, ev_text='delete') {
    $('[data-'+ev_text+']').click(function(e){
//console.log('Нажата кнопка удаления');        
        e.preventDefault();
        // If the user confirm the delete
        if (confirm(confirm_message)) {
            // Get the route URL
            var url = $(this).prop('href');
            // Get the token
            var token = $(this).data(ev_text);
            // Create a form element
            var form = $('<form/>', {action: url, method: 'post'});
            // Add the DELETE hidden input method
            var inputMethod = $('<input/>', {type: 'hidden', name: '_method', value: 'delete'});
            // Add the token hidden input
            var inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
            
            // Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT !
            form.append(inputMethod, inputToken).hide().appendTo('body').submit();
        }
    });
}

function recRestore(confirm_message, ev_text='[data-restore]') {
    $(ev_text).click(function(e){
        e.preventDefault();
        if (confirm(confirm_message)) {
            var url = $(this).prop('href');
            var token = $(this).data('restore');
            var form = $('<form/>', {action: url, method: 'post'});
            var inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
            form.append('post', inputToken).hide().appendTo('body').submit();
        }
    });
}

function recEffect(confirm_message, ev_text='[data-effect]') {
    $(ev_text).click(function(e){
        e.preventDefault();
        if (confirm(confirm_message)) {
            var url = $(this).prop('href');
            var token = $(this).data('effect');
            var form = $('<form/>', {action: url, method: 'post'});
            var inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
            form.append('post', inputToken).hide().appendTo('body').submit();
        }
    });
}
