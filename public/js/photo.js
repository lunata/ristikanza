function openBigPhoto(photo_block) {
   $(photo_block).on("click", function() {
        var bigPhoto = $(this).data('big');
        var title = $(this).data('title');
        
        $('#modalOpenBigPhoto .modal-title').text(title || '');

        $('#modalOpenBigPhoto .modal-body').html(
            '<div class="photo-in-modal">' +
                '<img src="' + bigPhoto + '" alt="">' +
            '</div>'
        );

        $('#modalOpenBigPhoto').modal('show');
    });
    
    $("#modalOpenBigPhoto .close, #modalOpenBigPhoto .cancel").on('click', function() {
        $('#modalOpenBigPhoto').modal('hide');
    });
}