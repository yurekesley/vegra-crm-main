$(() => {
    var shownDeletePopup = false;
    $(document).on('submit', '.delete-form', function (e) {
        if (shownDeletePopup == false) {
            e.preventDefault();
            shownDeletePopup = true;
            var form = $(this);
            var id = $(this).data('id');
            var description = $(this).data('description');
            var msg = $(this).data('msg');
            return Swal.fire({
                title: `${msg} ${description}?`,
                icon: 'question',
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Sim',
                showCancelButton: true,
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.trigger('submit');
                } else {
                    shownDeletePopup = false;
                }
            });
        }
    });
});
